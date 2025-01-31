
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/jquery/ui-lightness/admin/jquery-ui.css" />
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery/jquery.ui.js"></script>
<?php echo $javascript->link('price_slider/slides.min.jquery1') ?>
<style type="text/css">
.active {color:#FFFFFF;}
</style>

<style type="text/css">
#ui-datepicker-div {z-index:999999;}
</style>
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<div id="li-id" style="display:none;"></div>
<div id="CurrOpen" style="display:none;"></div>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_dr_module_banner.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
<div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread">Find a Doctor</div>
        </div>
        
      </div>
      <h1>Find a <span class="green">Doctor</span></h1>
	  <div class="boxDiv">
        <div class="textBox"><?php echo $html->image('frontend/my-account.jpg',array('alt'=>'My Account'))?></div>

            <div class="textBox-1"><a href="<?php echo SITE_URL?>pages/appoint_doctor_login"><?php echo $this->Html->image('frontend/for-doctors.jpg',array('alt'=>'For Doctor'))?></a></div>
			<a href="<?php echo SITE_URL?>pages/appoint_customer_login"><?php echo $this->Html->image('frontend/for-patients.jpg',array('alt'=>'For Patient','style'=>'margin-top:6px;'))?></a></div>

      <div class="findDoctorDiv">
	  	</form>
	  	<?php echo $form->create(null,array('url'=>'/pages/filter_doctor','style'=>'width:10%;'));?>
		<?php echo $form->hidden('Filter.user_temp_id',array('value'=>$user_temp_id));?>
		<div id="DayAvail" style="display:none;"></div>
        <div class="leftPanel">
          <div class="blockDiv marTopNone">
            <div class="heading">
              <h2>Niramaya Panel</h2>
            </div>
            <ul>
              <li>
                <input name="data[Filter][doctor_feature]" type="checkbox" value="1" />
                <span>Only Featured Doctors</span></li>
            </ul>
          </div>
          <div class="blockDiv">
            <div class="heading">
              <h2>Availability</h2>
            </div>
            <div class="dateDiv">
              <div class="any">Select</div>
              <ul>
              	<li id="Li1"><a href="javascript:void(0);" onclick="day_avail(1);" id="ach1">M</a></li>
                <li id="Li2"><a href="javascript:void(0);" onclick="day_avail(2);" id="ach2">T</a></li>
                <li id="Li3"><a href="javascript:void(0);" onclick="day_avail(3);" id="ach3">W</a></li>
                <li id="Li4"><a href="javascript:void(0);" onclick="day_avail(4);" id="ach4">T</a></li>
                <li id="Li5"><a href="javascript:void(0);" onclick="day_avail(5);" id="ach5">F</a></li>
                <li id="Li6"><a href="javascript:void(0);" onclick="day_avail(6);" id="ach6">S</a></li>
                <li id="Li7"><a href="javascript:void(0);" onclick="day_avail(7);" id="ach7">S</a></li>
              
              </ul>
              
              
              </div>
              <!--<div class="time"><b>12:00</b> AM - <b>11:30</b> PM</div>
              <div class="time"><img src="common/images/slider.jpg" alt="Slider" /></div>-->
              
              
          </div>
          <div class="blockDiv">
            <div class="heading">
              <h2>Consultation Fee</h2>
            </div>
            
              <!--<div class="time"><b>Fee</b> 100 </div>-->
              <div class="time" style="font-weight:normal; font-size:12px; line-height:25px;">
			  	<!--<div class="span4" style="margin:18px 0 0 0;"><input id="Slider4" type="slider" name="data[Filter][cons_fee]" value="100;2000" /></div>-->
				<input type="radio" name="data[Filter][cons_fee]" value="100;500" />&nbsp;&nbsp;Rs 100 - Rs 500<br />
				<input type="radio" name="data[Filter][cons_fee]" value="500;1000" />&nbsp;&nbsp;Rs 500 - Rs 1000<br />
				<input type="radio" name="data[Filter][cons_fee]" value="1000;1500" />&nbsp;&nbsp;Rs 1000 - Rs 1500<br />
				<input type="radio" name="data[Filter][cons_fee]" value="1500;2000" />&nbsp;&nbsp;Rs 1500 - Rs 2000<br />
			  </div>
              
         
          </div>
		   <div><?php echo $form->submit('/img/change_index/filter-button.jpg',array('alt'=>'Filter','style'=>'cursor:pointer;'));?></div> 
        </div>
		<?php echo $form->end();?>
        <div class="rightPanel">
		<div id="curr_cl_background" style="display:none;"></div>
		<div id="curr_background" style="display:none;"></div>
		<div id="curr_st_background" style="display:none;"></div>
		<div id="curr_lt_background" style="display:none;"></div>
		<div class="right-search-div">
			<?php echo $form->create(null,array('url'=>'/pages/find_doctor','id'=>'form100','name'=>'form100','style'=>'width:100%;'));?>
			<div class="search-div">
				<?php if(!empty($search_name)) {?>
				<?php echo $form->text('SearchDoctor.name',array('placeholder'=>'Search by Clinic Name','class'=>'search-doctor-input','value'=>$search_name,'onkeyup'=>'get_clinic_val(this.value);','onclick'=>'get_clinic_val(this.value);'));?>
				<div class="suggest-box" id="SuggestBoxCl" style="display:none;"></div>
				<div class="suggest-box2" id="SuggestBoxCl2" style="display:none; color:#FF0000;"></div>
				<?php } else {?>
				<?php echo $form->text('SearchDoctor.name',array('placeholder'=>'Search by Clinic Name','class'=>'search-doctor-input','onkeyup'=>'get_clinic_val(this.value);','onclick'=>'get_clinic_val(this.value);'));?>
				<div class="suggest-box" id="SuggestBoxCl" style="display:none;"></div>
				<div class="suggest-box2" id="SuggestBoxCl2" style="display:none; color:#FF0000;"></div>
				<?php }?>
			</div>
			<div class="search-div">
				<?php if(!empty($search_speciality)) {?>
				<?php echo $form->text('SearchDoctor.speciality',array('placeholder'=>'Search by Speciality','class'=>'search-doctor-input','value'=>$search_speciality,'onkeyup'=>'get_special_val(this.value);','onclick'=>'get_special_val(this.value);'));?>
				<?php echo $form->hidden('SearchDoctor.speciality_id',array('value'=>$search_speciality_id));?>
				<div class="suggest-box" id="SuggestBox" style="display:none;"></div>
				<div class="suggest-box2" id="SuggestBox2" style="display:none; color:#FF0000;"></div>
				<?php } else {?>
				<?php echo $form->text('SearchDoctor.speciality',array('placeholder'=>'Search by Speciality','class'=>'search-doctor-input','onkeyup'=>'get_special_val(this.value);','onclick'=>'get_special_val(this.value);'));?>
				<?php echo $form->hidden('SearchDoctor.speciality_id');?>
				<div class="suggest-box" id="SuggestBox" style="display:none;"></div>
				<div class="suggest-box2" id="SuggestBox2" style="display:none; color:#FF0000;"></div>
				<?php }?>
			</div>
			<div class="search-div">
				<?php if(!empty($search_state)) {?>
				<?php echo $form->text('SearchDoctor.state',array('class'=>'search-doctor-input','id'=>'SearchDoctorState','onkeyup'=>'get_state_val(this.value);','onclick'=>'get_state_val(this.value);','value'=>$search_state));?>
				<?php echo $form->hidden('SearchDoctor.state_id',array('id'=>'SearchDoctorStateId','value'=>$search_state_id));?>
				<div class="suggest-box" id="SuggestBoxSt" style="display:none;"></div>
				<div class="suggest-box2" id="SuggestBoxSt2" style="display:none; color:#FF0000;"></div>
				<?php } else {?>
				<?php echo $form->text('SearchDoctor.state',array('placeholder'=>'Enter State','id'=>'SearchDoctorState','onkeyup'=>'get_state_val(this.value);','onclick'=>'get_state_val(this.value);','class'=>'search-doctor-input'));?>
				<?php echo $form->hidden('SearchDoctor.state_id',array('id'=>'SearchDoctorStateId'));?>
				<div class="suggest-box" id="SuggestBoxSt" style="display:none;"></div>
				<div class="suggest-box2" id="SuggestBoxSt2" style="display:none; color:#FF0000;"></div>
				<?php }?>
			</div>
			<div class="search-div">
				<?php if(!empty($search_city)) {?>
				<?php echo $form->text('SearchDoctor.locality',array('class'=>'search-doctor-input','value'=>$search_city,'onkeyup'=>'get_city_val(this.value);','onclick'=>'get_city_val(this.value);'));?>
				<?php echo $form->hidden('SearchDoctor.locality_id',array('value'=>$search_city_id));?>
				<div class="suggest-box" id="SuggestBoxLt" style="display:none; width:248px;"></div>
				<div class="suggest-box2" id="SuggestBoxLt2" style="display:none; color:#FF0000; width:248px;"></div>
				<?php } else {?>
				<?php echo $form->text('SearchDoctor.locality',array('placeholder'=>'Search by Locality','class'=>'search-doctor-input','onkeyup'=>'get_city_val(this.value);','onclick'=>'get_city_val(this.value);'));?>
				<?php echo $form->hidden('SearchDoctor.locality_id');?>
				<div class="suggest-box" id="SuggestBoxLt" style="display:none; width:248px;"></div>
				<div class="suggest-box2" id="SuggestBoxLt2" style="display:none; color:#FF0000; width:248px;"></div>
				<?php }?>
			</div>
			<div class="filter-btn"><?php echo $html->image('change_index/filter-button.jpg',array('onclick'=>'submit_form_doctor();','style'=>'cursor:pointer;'));?></div>
			<?php echo $form->end();?>
		</div>
		<?php if(!empty($dec_doc_name) && !empty($dec_appoint_date) && !empty($dec_appoint_time)) {?>
		<div class="right-search-div" style="color: #FF0000; font-weight: bold; padding: 40px 0 10px; text-align: center; float:none;">Your appointment request has been sent to <?php echo $dec_doc_name;?> for <?php echo $dec_appoint_date;?> at <?php echo $dec_appoint_time;?></div>
		<?php }?>
		<?php if(count($search_doctor) > 0){$i = 1;foreach($search_doctor as $kk => $vv) {?>
		
		<script type="text/javascript">
		function hide_request_appoint<?php echo $i;?>()
		{
			$('#signup-Div-Request<?php echo $i;?>').hide();
			$('.js_lb_overlay').css({'opacity':'0'});
			$('.js_lb_overlay').css({'background':'none'});
		}
		
		$(function() 
		{
			function launch() 
			{
				$('signup-Div-Request<?php echo $i;?>').lightbox_me({centered: true, onLoad: function() { $('#signup-Div-Request<?php echo $i;?>').find('input:first').focus()}});
			}
			$('#request_appoint<?php echo $i;?>').click(function(e) 
			{
				$("#signup-Div-Request<?php echo $i;?>").lightbox_me({centered: true, onLoad: function() 
				{
					$("#signup-Div-Request<?php echo $i;?>").find("input:first").focus();
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
		function validation_request<?php echo $i;?>()
		{
			var str = true;
			document.getElementById('MsgName<?php echo $i;?>').innerHTML = '';
			document.getElementById('MsgAge<?php echo $i;?>').innerHTML = '';
			document.getElementById('MsgEmail<?php echo $i;?>').innerHTML = '';
			document.getElementById('MsgContact<?php echo $i;?>').innerHTML = '';
			document.getElementById('MsgAppointDate<?php echo $i;?>').innerHTML = '';
			document.getElementById('MsgTime<?php echo $i;?>').innerHTML = '';
			document.getElementById('MsgLocation<?php echo $i;?>').innerHTML = '';
			document.getElementById('MsgAppointReason<?php echo $i;?>').innerHTML = '';
			
			if(document.formrequest<?php echo $i;?>.RequestAppointmentPatName<?php echo $i;?>.value == '')
			{
				document.getElementById("MsgName<?php echo $i;?>").innerHTML="Please Enter Name";
				str=false;
			}
			else if(IsCharacter(document.formrequest<?php echo $i;?>.RequestAppointmentPatName<?php echo $i;?>.value)==false)
			{
				document.getElementById("MsgName<?php echo $i;?>").innerHTML="Please Enter Valid Name";
				str=false;
			}
			if(document.formrequest<?php echo $i;?>.RequestAppointmentPatAge<?php echo $i;?>.value == '')
			{
				document.getElementById("MsgAge<?php echo $i;?>").innerHTML="Please Enter Age";
				str=false;
			}
			else if(isNaN(document.formrequest<?php echo $i;?>.RequestAppointmentPatAge<?php echo $i;?>.value))
			{
				document.getElementById("MsgAge<?php echo $i;?>").innerHTML="Please Enter Valid Age";
				str=false;
			}
			var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			if(!document.formrequest<?php echo $i;?>.RequestAppointmentPatEmail<?php echo $i;?>.value.match(validate_char))
			{
				document.getElementById("MsgEmail<?php echo $i;?>").innerHTML="Please Enter a valid email address";
				str=false;
			}
			if(document.formrequest<?php echo $i;?>.RequestAppointmentPatContact<?php echo $i;?>.value == '')
			{
				document.getElementById("MsgContact<?php echo $i;?>").innerHTML="Please Enter Contact Number";
				str=false;
			}
			else if(isNaN(document.formrequest<?php echo $i;?>.RequestAppointmentPatContact<?php echo $i;?>.value))
			{
				document.getElementById("MsgContact<?php echo $i;?>").innerHTML="Please Enter Valid Contact Number";
				str=false;
			}
			if(document.formrequest<?php echo $i;?>.RequestAppointmentAppointDateReq<?php echo $i;?>.value == '')
			{
				document.getElementById("MsgAppointDate<?php echo $i;?>").innerHTML="Please Select Appointment Date";
				str=false;
			}
			if(document.formrequest<?php echo $i;?>.RequestAppointmentAppointTimeHh<?php echo $i;?>.value == '')
			{
				document.getElementById("MsgTime<?php echo $i;?>").innerHTML="Please Select Appointment Time Hour";
				str=false;
			}
			if(document.formrequest<?php echo $i;?>.RequestAppointmentAppointTimeSs<?php echo $i;?>.value == '')
			{
				document.getElementById("MsgTimeSs<?php echo $i;?>").innerHTML="Please Select Appointment Time Second";
				str=false;
			}
			if(document.formrequest<?php echo $i;?>.RequestAppointmentPatLocality<?php echo $i;?>.value == '')
			{
				document.getElementById("MsgLocation<?php echo $i;?>").innerHTML="Please Enter your Location";
				str=false;
			}
			if(document.formrequest<?php echo $i;?>.RequestAppointmentPatReason<?php echo $i;?>.value == '')
			{
				document.getElementById("MsgAppointReason<?php echo $i;?>").innerHTML="Please Enter Appointment Reason";
				str=false;
			}
			return str;
		}
		</script>
		<style type="text/css">
		#signup-Div-Request<?php echo $i;?> {background: #fff; border: 6px solid #727272; width:600px; height:640px; position: relative; display:none; z-index:999; border-radius:13px; }
		#close-one-Request<?php echo $i;?>{display: block; height: 23px; overflow: hidden; position: absolute; right: 3px; top: 8px; width: 24px;}
		</style>
		<div id="signup-Div-Request<?php echo $i;?>"> <a id="close-one-Request<?php echo $i;?>" class="close" href="javascript:void(0);" onclick="hide_request_appoint<?php echo $i;?>();"><?php echo $html->image('close-one.jpg');?></a>
		<div class="doc-name">Request for Appointment</div>
		<div class="doc-desc">
			<?php echo $form->create(null,array('url'=>'/pages/book_appointment_request_search/'.$i,'id'=>'formrequest'.$i,'name'=>'formrequest'.$i));?>
			<?php echo $form->hidden('RequestAppointment.doctor_id',array('value'=>$vv['DoctorClinic']['doctor_id']));?>
			<?php echo $form->hidden('RequestAppointment.clinic_id',array('value'=>$vv['DoctorClinic']['id']));?>
			
			<?php if(!empty($search_name) && $search_name != ''){?><?php echo $form->hidden('RequestAppointment.search_name'.$i,array('value'=>$search_name));?><?php }else{?><?php echo $form->hidden('RequestAppointment.search_name'.$i,array('value'=>'NO'));?><?php }?>
			<?php if(!empty($search_speciality) && $search_speciality != ''){?><?php echo $form->hidden('RequestAppointment.spec_name'.$i,array('value'=>$search_speciality));?><?php }else{?><?php echo $form->hidden('RequestAppointment.spec_name'.$i,array('value'=>'NO'));?><?php }?>
			<?php if(!empty($search_speciality_id) && $search_speciality_id != ''){?><?php echo $form->hidden('RequestAppointment.spec_id'.$i,array('value'=>$search_speciality_id));?><?php }else{?><?php echo $form->hidden('RequestAppointment.spec_id'.$i,array('value'=>'NO'));?><?php }?>
			<?php if(!empty($search_state) && $search_state != ''){?><?php echo $form->hidden('RequestAppointment.state_name'.$i,array('value'=>$search_state));?><?php }else{?><?php echo $form->hidden('RequestAppointment.state_name'.$i,array('value'=>'NO'));?><?php }?>
			<?php if(!empty($search_state_id) && $search_state_id != ''){?><?php echo $form->hidden('RequestAppointment.state_id'.$i,array('value'=>$search_state_id));?><?php }else{?><?php echo $form->hidden('RequestAppointment.state_id'.$i,array('value'=>'NO'));?><?php }?>
			<?php if(!empty($search_city) && $search_city != ''){?><?php echo $form->hidden('RequestAppointment.city'.$i,array('value'=>$search_city));?><?php }else{?><?php echo $form->hidden('RequestAppointment.city'.$i,array('value'=>'NO'));?><?php }?>
			<?php if(!empty($search_city_id) && $search_city_id != ''){?><?php echo $form->hidden('RequestAppointment.city_id'.$i,array('value'=>$search_city_id));?><?php }else{?><?php echo $form->hidden('RequestAppointment.city_id'.$i,array('value'=>'NO'));?><?php }?>
			
			<div class="doc-inner-div" style="float:left; width:96%; height:550px;">
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Patient Name</div>
					<div style="float:left;">
						<?php if(!empty($user_detail)) {?>
						<?php echo $form->text('RequestAppointment.pat_name'.$i,array('class'=>'inptext','value'=>$user_detail['User']['first_name'].' '.$user_detail['User']['last_name']));?><br />
						<?php } else {?>
						<?php echo $form->text('RequestAppointment.pat_name'.$i,array('class'=>'inptext','placeholder'=>'Please Enter Patient Name'));?><br />
						<?php }?>
						<span style="color:#FF0000; font-size:11px;" id="MsgName<?php echo $i;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Patient Age</div>
					<div style="float:left;">
						<?php if(!empty($user_detail)) {?>
						<?php echo $form->text('RequestAppointment.pat_age'.$i,array('class'=>'inptext','value'=>$user_detail['User']['age']));?><br />
						<?php } else {?>
						<?php echo $form->text('RequestAppointment.pat_age'.$i,array('class'=>'inptext','placeholder'=>'Please Enter Age'));?><br />
						<?php }?>
						<span style="color:#FF0000; font-size:11px;" id="MsgAge<?php echo $i;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Patient Email</div>
					<div style="float:left;">
						<?php if(!empty($user_detail)) {?>
						<?php echo $form->text('RequestAppointment.pat_email'.$i,array('class'=>'inptext','value'=>$user_detail['User']['email']));?><br />
						<?php } else {?>
						<?php echo $form->text('RequestAppointment.pat_email'.$i,array('class'=>'inptext','placeholder'=>'Please Enter Email'));?><br />
						<?php }?>
						<span style="color:#FF0000; font-size:11px;" id="MsgEmail<?php echo $i;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Patient Contact No.</div>
					<div style="float:left;">
						<?php if(!empty($user_detail)) {?>
						<?php echo $form->text('RequestAppointment.pat_contact'.$i,array('class'=>'inptext','value'=>$user_detail['User']['contact']));?><br />
						<?php } else {?>
						<?php echo $form->text('RequestAppointment.pat_contact'.$i,array('class'=>'inptext','placeholder'=>'Please Enter Contact No.'));?><br />
						<?php }?>
						<span style="color:#FF0000; font-size:11px;" id="MsgContact<?php echo $i;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Appointment Date</div>
					<div style="float:left;">
						<?php echo $form->text('RequestAppointment.appoint_date_req'.$i,array('class'=>'inptext datepicker1','placeholder'=>'Please Select Date'));?><br />
						<span style="color:#FF0000; font-size:11px;" id="MsgAppointDate<?php echo $i;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Appointment Time</div>
					<div style="float:left;">
						<select name="data[RequestAppointment][appoint_time_hh<?php echo $i;?>]" class="inptext" style="width:55px;" id="RequestAppointmentAppointTimeHh<?php echo $i;?>">
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
						<select name="data[RequestAppointment][appoint_time_ss<?php echo $i;?>]" class="inptext" style="width:55px;" id="RequestAppointmentAppointTimeSs<?php echo $i;?>">
							<option value="">SS</option>
							<?php for($ss=0;$ss<=60;$ss++){?>
							<?php if($ss <= 9) {?>
							<option value="<?php echo '0'.$ss;?>"><?php echo '0'.$ss;?></option>
							<?php } else {?>
							<option value="<?php echo $ss;?>"><?php echo $ss;?></option>
							<?php }?>
							<?php }?>
						</select>
						<select name="data[RequestAppointment][appoint_time_sl<?php echo $i;?>]" class="inptext" style="width:55px;" id="RequestAppointmentAppointTimeSl<?php echo $i;?>">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
						<br />
						<span style="color:#FF0000; font-size:11px;" id="MsgTime<?php echo $i;?>"></span><br />
						<span style="color:#FF0000; font-size:11px;" id="MsgTimeSs<?php echo $i;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Location</div>
					<div style="float:left;">
						<?php if(!empty($user_detail)) {?>
						<?php echo $form->text('RequestAppointment.pat_locality'.$i,array('class'=>'inptext','value'=>$user_detail['User']['locality']));?><br />
						<?php } else {?>
						<?php echo $form->text('RequestAppointment.pat_locality'.$i,array('class'=>'inptext','placeholder'=>'Please Enter Location'));?><br />
						<?php }?>
						<span style="color:#FF0000; font-size:11px;" id="MsgLocation<?php echo $i;?>"></span>
					</div>
				</div>
				<div style="clear:both;">
					<div class="book-home-visit-head">Appointment Reason</div>
					<div style="float:left;">
						<?php echo $form->textarea('RequestAppointment.pat_reason'.$i,array('cols'=>30,'rows'=>6,'style'=>'font-size:11px; color:#666666; border-radius:3px; border:1px solid #D9D9D9;','placeholder'=>'Enter Appointment Reason'));?><br />
						<span style="color:#FF0000; font-size:11px;" id="MsgAppointReason<?php echo $i;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">&nbsp;</div>
					<div style="float:left; margin:10px 0 0 0;"><input type="image" src="<?php echo SITE_URL;?>img/submit-button.gif" alt="Submit" onclick="return validation_request<?php echo $i;?>(this);" /></div>
				</div>
			</div>
			<?php echo $form->end();?>
		</div>
	</div>
		
		
        <div class="sepBox <?php if($i == 1){?>marTopNone<?php }?>">
        <div class="imgbox">
			<?php if($vv['DoctorClinic']['admin_featured'] == 1) {?>
			<?php echo $html->image('featured-dr-icon.png',array('class'=>'fericon'));?>
			<?php }?>
			<?php if(!empty($vv['DoctorClinic']['doctor_image'])) {?>
			<?php echo $html->image(DOCTOR_IMAGE_BIGSMALL_URL.$vv['DoctorClinic']['doctor_image'],array('alt'=>'Doctor','title'=>$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']));?>
			<?php } else {?>
				<?php if($vv['DoctorClinic']['doctor_gender'] == 1) {?>
					<?php echo $html->image('frontend/default_male.jpg',array('alt'=>'Doctor','title'=>$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name'],'height'=>126,'width'=>131))?>
				<?php } else {?>
					<?php echo $html->image('frontend/default_female.jpg',array('alt'=>'Doctor','title'=>$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name'],'height'=>126,'width'=>131))?>
				<?php }?>
			<?php }?>
		</div>
        <div class="docDetails"><div class="heading"><div class="leftText">
		<p><a href="<?php echo SITE_URL;?>pages/doctor_detail/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>"><?php echo $vv['DoctorClinic']['doctor_title'].'. '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name'];?></a>
		
		</p>
        <span><?php echo substr($vv['DoctorClinic']['speciality'],0,50).'...';?></span>
        </div> 
			<?php if($vv['DoctorClinic']['appoint_activate'] == 1) {?>
            <a href="javascript:void(0);" onclick="show_day(<?php echo $vv['DoctorClinic']['id']?>);"><?php echo $html->image('change_index/request-appointment.jpg',array('class'=>'right','alt'=>'Request Appointment'))?></a>
			<?php } else {?>
			<a href="javascript:void(0);" id="request_appoint<?php echo $i;?>"><?php echo $html->image('change_index/request-appointment.jpg',array('class'=>'right','alt'=>'Request Appointment'))?></a>
			<?php }?>
			</div>
            
            <div class="docdiv">
            <div class="leftDivDoc">
				<div style="float:left; font-size:12px;"><?php echo $vv['DoctorClinic']['clinic_name'];?></div>
				<div style="clear:both; font-size:12px; margin:25px 0 0 0;"><?php echo $vv['DoctorClinic']['clinic_add1'].$vv['DoctorClinic']['clinic_add2'];?></div>
				<div style="clear:both; font-size:12px; margin:10px 0 0 0;"><?php echo $vv['DoctorClinic']['city_name'].','.$vv['DoctorClinic']['state_name'];?></div>
				<!--<div style="clear:both;"><strong>Locality :</strong> <?php //echo $vv['DoctorClinic']['doctor_locality'];?></div>-->
            </div>
            <div class="rightDivDoc"><div class="inrTop">INR <?php echo $vv['DoctorClinic']['doctor_cons_fee'];?></div>
			<?php if($vv['DoctorClinic']['doctor_home_fee'] != 0) {?>
            <div style="clear: both; float: left; font-weight: bold; width: auto;">
				<div style="float:left;"><?php echo $html->image('change_index/home-care-icon.jpg',array('width'=>20));?></div>
				<div style="float:left; font-weight:normal; font-size:12px; padding:0 0 0 4px;"><?php echo 'INR '.$vv['DoctorClinic']['doctor_home_fee'];?></div>
			</div>
			<?php }?>
            <div class="day">
				<?php if(!empty($vv['DoctorClinic']['day1'])){ echo 'Mo';}?>
				<?php if(!empty($vv['DoctorClinic']['day2'])){ echo 'Tu';}?>
				<?php if(!empty($vv['DoctorClinic']['day3'])){ echo 'We';}?>
				<?php if(!empty($vv['DoctorClinic']['day4'])){ echo 'Th';}?>
				<?php if(!empty($vv['DoctorClinic']['day5'])){ echo 'Fr';}?>
				<?php if(!empty($vv['DoctorClinic']['day6'])){ echo 'Sa';}?>
				<?php if(!empty($vv['DoctorClinic']['day7'])){ echo 'Su';}?>
			</div>
            <div class="time"><?php echo $vv['DoctorClinic']['clinic_s_time'];?> - <?php echo $vv['DoctorClinic']['clinic_e_time'];?></div>
            </div>
            
            </div>
            
        </div>
        
        </div>
		<script type="text/javascript">
		$(function(){
			$('#slides<?php echo $i;?>').slides({
				preload: true,
				generateNextPrev: true
			});
		});
		</script>
		
		<div class="slideboxDiv" id="PresentDay_<?php echo $vv['DoctorClinic']['id'];?>" style="display:none;">
		<div class="nextPrevBlog">You can book appointments for next 14 days</div>
          	<div id="slides<?php echo $i;?>" style="clear:both; position:relative;">
				<div class="slides_container">
					<div class="slideDiv">
					
		<div class="timeHeading">
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
		<div class="timeTableDiv">
        	<table width="100%" border="0" cellspacing="1" cellpadding="0">
  				<tr>
    				<td height="118"><h3>Morning</h3></td>
					<td width="80">
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>	
				</tr>
				
				<tr>
    				<td height="170"><h3>Afternoon</h3></td>
					<td width="80">
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>

								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
    				<td height="135"><h3>Evening</h3></td>
					<td width="80">
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
    				<td height="100"><h3>Night</h3></td>
					<td width="80">
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>

							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
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
					
		<div class="timeHeading">
        	<ul>
				<!--<li><a href="javascript:void(0);" onclick="open_past(<?php //echo $vv['Doctor']['id']?>);">Prev</a></li>-->
				<li><span><?php echo date('D',strtotime(" +7 days "));?></span><p><?php echo date('d M',strtotime(" +7 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +8 days "));?></span><p><?php echo date('d M',strtotime(" +8 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +9 days "));?></span><p><?php echo date('d M',strtotime(" +9 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +10 days "));?></span><p><?php echo date('d M',strtotime(" +10 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +11 days "));?></span><p><?php echo date('d M',strtotime(" +11 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +12 days "));?></span><p><?php echo date('d M',strtotime(" +12 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +13 days "));?></span><p><?php echo date('d M',strtotime(" +13 days "));?></p></li>
				
            </ul>
        </div>
		<div class="timeTableDiv">
        	<table width="100%" border="0" cellspacing="1" cellpadding="0">
  				<tr>
    				<td height="118"><h3>Morning</h3></td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
                        	<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>	
				</tr>
				
				<tr>
    				<td height="170"><h3>Afternoon</h3></td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
    				<td height="135"><h3>Evening</h3></td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
    				<td height="100"><h3>Night</h3></td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>

										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>

									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="80">
						<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($vv['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($vv['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($vv['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($vv['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($vv['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($vv['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($vv['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $vv['DoctorClinic']['doctor_title'].' '.$vv['DoctorClinic']['doctor_f_name'].' '.$vv['DoctorClinic']['doctor_l_name']?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($vv['DoctorClinic']['doctor_id']);?>/<?php echo base64_encode($vv['DoctorClinic']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>/find_doctor"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
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
		
		<?php $i++;}} else {?>
        <div style="height:18px; clear:both; padding:25px; text-align:center; color:#FF0000; border:1px solid #D8D8D8;">No Clinic Found</div>
		<?php }?>
        
        </div>
        <?php
			echo $this->element('pagination_test');
		?>
        
      </div>
      <div class="bottomShadow"></div>
    </div>
  </div>
  <script type="text/javascript">
function show_all()
{
	jQuery('#ViewAll').hide();
	jQuery('#AllState').show();
}

function day_avail(val)
{
	var rep_div = '';
	rep_div +='<input type="hidden" name="data[Filter][day_avail]" value="'+val+'">';
	jQuery('#DayAvail').html(rep_div);
	var curr_id = document.getElementById('li-id').innerHTML;
	if(curr_id == '')
	{
		jQuery('#Li'+val).css("background-color","#68B323");
		jQuery('#ach'+val).addClass('active');
		document.getElementById('li-id').innerHTML = val;
	}
	else
	{
		$('#Li'+curr_id).removeAttr("style");
		$('#ach'+curr_id).removeClass('active');
		$('#Li'+val).css("background-color","#68B323");
		$('#ach'+val).addClass('active');
		document.getElementById('li-id').innerHTML = val;
	}
}

function show_day(val)
{
	var curropen = document.getElementById('CurrOpen').innerHTML;
	if(curropen == '')
	{
		document.getElementById('CurrOpen').innerHTML = val;
		//jQuery('#ClinicDetail_'+val).show();
		jQuery('#PresentDay_'+val).show();
	}
	else
	{
		var getcurropen = document.getElementById('CurrOpen').innerHTML;
		document.getElementById('CurrOpen').innerHTML = val;
		//jQuery('#ClinicDetail_'+getcurropen).hide();
		jQuery('#PresentDay_'+getcurropen).hide();
		//jQuery('#ClinicDetail_'+val).show();
		jQuery('#PresentDay_'+val).show();
	}
}

function highlight_back(id)
{
	var get_curr_back = document.getElementById('curr_background').innerHTML;
	if(get_curr_back == '')
	{
		document.getElementById('curr_background').innerHTML = id;
		var get_text = document.getElementById(id).innerHTML;
		jQuery('#'+id).css({'background-color':'#0099CC','color':'#FFFFFF'});
	}
	else
	{
		jQuery('#'+get_curr_back).css({'background-color':'#FFFFFF','color':'#5C5C5C'});
		var get_text = document.getElementById(id).innerHTML;
		jQuery('#'+id).css({'background-color':'#0099CC','color':'#FFFFFF'});
		document.getElementById('curr_background').innerHTML = id;
	}
}

function get_special_val(sp_val)
{
	jQuery('#SuggestBox').show();
	jQuery.ajax({
	type:'GET',
	url:siteUrl+'pages/get_special?name='+sp_val,
	dataType:'json',
	success:function(data){
		if(data.spec_info.status == 'Success')
		{
			var rep_div = '';
			jQuery.each(data.spec_info.spec_list,function(index, value)
			{
				rep_div +='<div class="suggest-box-div" onmouseover="highlight_back('+value.Specialization.id+');" id="'+value.Specialization.id+'" onclick="enter_value('+value.Specialization.id+');" style="cursor:pointer;">'+value.Specialization.display_name+'</div>';	
			});
			jQuery('#SuggestBox').html(rep_div);
			jQuery('#SuggestBox').show();
			jQuery('#SuggestBox2').hide();
		}
		if(data.spec_info.status == 'Notsuccess')
		{
			var rep_div = '';
			rep_div +='No Specialization Found';
			jQuery('#SuggestBox2').html(rep_div);
			jQuery('#SuggestBox2').show();
			jQuery('#SuggestBox').hide();
		}
	},
	});
}

function enter_value(id)
{
	jQuery('#SuggestBox2').hide();
	jQuery('#SuggestBox').hide();
	jQuery.ajax({
	type:'GET',
	url:siteUrl+'pages/get_specialization_value?id='+id,
	success:function(data){
		var split_data = data.split('*');					
		jQuery('#SearchDoctorSpeciality').val(split_data[1]);
		jQuery('#SearchDoctorSpecialityId').val(split_data[0]);
	},
	});
}

function get_clinic_val(sp_val)
{
	jQuery('#SuggestBoxCl').show();
	jQuery.ajax({
	type:'GET',
	url:siteUrl+'pages/get_clinic?name='+sp_val,
	dataType:'json',
	success:function(data){
		if(data.clinic_info.status == 'Success')
		{
			var rep_div = '';
			jQuery.each(data.clinic_info.clinic_list,function(index, value)
			{
				rep_div +='<div class="suggest-box-div" onmouseover="highlight_cl_back('+value.DoctorClinic.id+');" id="clname_'+value.DoctorClinic.id+'" onclick="enter_cl_value('+value.DoctorClinic.id+');" style="cursor:pointer;">'+value.DoctorClinic.clinic_name+'</div>';	
			});
			jQuery('#SuggestBoxCl').html(rep_div);
			jQuery('#SuggestBoxCl').show();
			jQuery('#SuggestBoxCl2').hide();
		}
		if(data.clinic_info.status == 'Notsuccess')
		{
			var rep_div = '';
			rep_div +='No Clinics Found';
			jQuery('#SuggestBoxCl2').html(rep_div);
			jQuery('#SuggestBoxCl2').show();
			jQuery('#SuggestBoxCl').hide();
		}
	},
	});
}

function highlight_cl_back(id)
{
	var get_curr_back = document.getElementById('curr_cl_background').innerHTML;
	if(get_curr_back == '')
	{
		document.getElementById('curr_cl_background').innerHTML = id;

		var get_text = document.getElementById('clname_'+id).innerHTML;
		jQuery('#clname_'+id).css({'background-color':'#0099CC','color':'#FFFFFF'});
	}
	else
	{
		jQuery('#clname_'+get_curr_back).css({'background-color':'#FFFFFF','color':'#5C5C5C'});
		var get_text = document.getElementById('clname_'+id).innerHTML;
		jQuery('#clname_'+id).css({'background-color':'#0099CC','color':'#FFFFFF'});
		document.getElementById('curr_cl_background').innerHTML = id;
	}
}

function enter_cl_value(id)
{
	jQuery('#SuggestBoxCl2').hide();
	jQuery('#SuggestBoxCl').hide();
	jQuery.ajax({
	type:'GET',
	url:siteUrl+'pages/get_cl_value?id='+id,
	success:function(data){				
		jQuery('#SearchDoctorName').val(data);
	},
	});
}

function get_state_val(sp_val)
{
	jQuery('#SuggestBoxLt2').hide();
	jQuery('#SuggestBoxLt').hide();
	jQuery('#SuggestBoxSt').show();
	document.getElementById('SuggestBoxLt2').innerHTML = '';
	document.getElementById('SuggestBoxLt').innerHTML = '';
	jQuery.ajax({
	type:'GET',
	url:siteUrl+'pages/get_state_name?name='+sp_val,
	dataType:'json',
	success:function(data){
		if(data.state_info.status == 'Success')
		{
			var rep_div = '';
			jQuery.each(data.state_info.state_list,function(index, value)
			{
				rep_div +='<div class="suggest-box-div" onmouseover="highlight_st_back('+value.State.id+');" id="state_'+value.State.id+'" onclick="enter_st_value('+value.State.id+');" style="cursor:pointer;">'+value.State.name+'</div>';	
			});
			jQuery('#SuggestBoxSt').html(rep_div);
			jQuery('#SuggestBoxSt').show();
			jQuery('#SuggestBoxSt2').hide();
		}
		if(data.state_info.status == 'Notsuccess')
		{
			var rep_div = '';
			rep_div +='No State Found';
			jQuery('#SuggestBoxSt2').html(rep_div);
			jQuery('#SuggestBoxSt2').show();
			jQuery('#SuggestBoxSt').hide();
		}
	},
	});
}

function highlight_st_back(id)
{
	var get_curr_back = document.getElementById('curr_st_background').innerHTML;
	if(get_curr_back == '')
	{
		document.getElementById('curr_st_background').innerHTML = id;
		var get_text = document.getElementById('state_'+id).innerHTML;
		jQuery('#state_'+id).css({'background-color':'#0099CC','color':'#FFFFFF'});
	}
	else
	{
		jQuery('#state_'+get_curr_back).css({'background-color':'#FFFFFF','color':'#5C5C5C'});
		var get_text = document.getElementById('state_'+id).innerHTML;
		jQuery('#state_'+id).css({'background-color':'#0099CC','color':'#FFFFFF'});
		document.getElementById('curr_st_background').innerHTML = id;
	}
}

function enter_st_value(id)
{
	jQuery('#SuggestBoxSt2').hide();
	jQuery('#SuggestBoxSt').hide();
	jQuery.ajax({
	type:'GET',
	url:siteUrl+'pages/get_st_value?id='+id,
	success:function(data){				
		var split_data = data.split('*');					
		jQuery('#SearchDoctorState').val(split_data[1]);
		jQuery('#SearchDoctorStateId').val(split_data[0]);
	},
	});
}

function get_city_val(sp_val)
{
	var state_id = document.getElementById('SearchDoctorStateId').value;
	if(state_id == '')
	{
		var rep_div = '';
		rep_div +='Please Select City';
		jQuery('#SuggestBoxLt2').html(rep_div);
		jQuery('#SuggestBoxLt2').show();
		jQuery('#SuggestBoxLt').hide();
	}
	else
	{
		jQuery('#SuggestBoxLt').show();
		jQuery.ajax({
		type:'GET',
		url:siteUrl+'pages/get_city_name?name='+sp_val+'&state='+state_id,
		dataType:'json',
		success:function(data){
			if(data.city_info.status == 'Success')
			{
				var rep_div = '';
				jQuery.each(data.city_info.city_list,function(index, value)
				{
					rep_div +='<div class="suggest-box-div" onmouseover="highlight_lt_back('+value.StateCity.id+');" id="locality_'+value.StateCity.id+'" onclick="enter_lt_value('+value.StateCity.id+');" style="cursor:pointer; width:220px;">'+value.StateCity.city_name+'</div>';	
				});
				jQuery('#SuggestBoxLt').html(rep_div);
				jQuery('#SuggestBoxLt').show();
				jQuery('#SuggestBoxLt2').hide();
			}
			if(data.city_info.status == 'Notsuccess')
			{
				var rep_div = '';
				rep_div +='No Locality Found';
				jQuery('#SuggestBoxLt2').html(rep_div);
				jQuery('#SuggestBoxLt2').show();
				jQuery('#SuggestBoxLt').hide();
			}
		},
		});
	}
}

function highlight_lt_back(id)
{
	var get_curr_back = document.getElementById('curr_lt_background').innerHTML;
	if(get_curr_back == '')
	{
		document.getElementById('curr_lt_background').innerHTML = id;
		var get_text = document.getElementById('locality_'+id).innerHTML;
		jQuery('#locality_'+id).css({'background-color':'#0099CC','color':'#FFFFFF'});
	}
	else
	{
		jQuery('#locality_'+get_curr_back).css({'background-color':'#FFFFFF','color':'#5C5C5C'});
		var get_text = document.getElementById('locality_'+id).innerHTML;
		jQuery('#locality_'+id).css({'background-color':'#0099CC','color':'#FFFFFF'});
		document.getElementById('curr_lt_background').innerHTML = id;
	}
}

function enter_lt_value(id)
{
	jQuery('#SuggestBoxLt2').hide();
	jQuery('#SuggestBoxLt').hide();
	jQuery.ajax({
	type:'GET',
	url:siteUrl+'pages/get_lt_value?id='+id,
	success:function(data){				
		var split_data = data.split('*');					
		jQuery('#SearchDoctorLocality').val(split_data[1]);
		jQuery('#SearchDoctorLocalityId').val(split_data[0]);
	},
	});
}

$(document).mouseup(function (e)
{
	var spec = document.getElementById('SearchDoctorSpeciality').value;
	var state = document.getElementById('SearchDoctorState').value;
	var city = document.getElementById('SearchDoctorLocality').value;
	if(spec == '')
	{
		var null_val = '';
		jQuery('#SearchDoctorSpecialityId').val(null_val);
	}
	if(state == '')
	{
		var null_val = '';
		jQuery('#SearchDoctorStateId').val(null_val);
		jQuery('#SearchDoctorLocalityId').val(null_val);
	}
	if(city == '')
	{
		var null_val = '';
		jQuery('#SearchDoctorLocalityId').val(null_val);
	}
	jQuery('#SuggestBoxCl2').hide();
	jQuery('#SuggestBoxCl').hide();
	jQuery('#SuggestBox2').hide();
	jQuery('#SuggestBox').hide();
	jQuery('#SuggestBoxSt2').hide();
	jQuery('#SuggestBoxSt').hide();
	jQuery('#SuggestBoxLt2').hide();
	jQuery('#SuggestBoxLt').hide();
});

function submit_form_doctor()
{
	document.forms["form100"].submit();
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


</script>
<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>