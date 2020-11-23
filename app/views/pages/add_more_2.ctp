<script type="text/javascript">
function show_h_cons_fee(val)
{
	if(val == 0)
	{
		var val_null = '';
		$('#HomeConsFee1').hide();
		$('#DoctorClinicHomeVisitFee').val(val_null);
	}
	if(val == 1)
	{
		$('#HomeConsFee1').show();
	}
}

function validationc()
{
	var str=true;
	document.getElementById("msg1").innerHTML="";
	document.getElementById("msg2").innerHTML="";
	document.getElementById("msg100").innerHTML="";
	document.getElementById("msg201").innerHTML="";
	document.getElementById("msg101").innerHTML="";
	
	if(document.form2.DoctorClinicClinicName.value=='')
	{
		document.getElementById("msg1").innerHTML="Please Enter Clinic Name";
		str=false;
	}
	if(document.form2.DoctorClinicAddress1.value=='')
	{
		document.getElementById("msg2").innerHTML="Please Enter Clinic Address";
		str=false;
	}
	if(document.form2.DoctorClinicState.value=='')
	{
		document.getElementById("msg100").innerHTML="Please Select State";
		str=false;
	}
	if(document.form2.DoctorClinicCity.value=='')
	{
		document.getElementById("msg101").innerHTML="Please Select City";
		str=false;
	}
	if(document.getElementById('DoctorClinicCityNew').style.display == 'block')
	{
		document.getElementById("msg201").innerHTML="Please Select City";
		str=false;
	}
	return str;
}

function open_day(val)
{
	if(val == 1)
	{
		$('#MainDiv').show();
		$('#DayOne').show();
		$('#DayTwo').hide();
		$('#DayThree').hide();
		$('#DayFour').hide();
		$('#DayFive').hide();
		$('#DaySix').hide();
		$('#DaySeven').hide();
		$('#OverDayTwo').hide();
		$('#OverDayThree').hide();
		$('#OverDayFour').hide();
		$('#OverDayFive').hide();
		$('#OverDaySix').hide();
		$('#OverDaySeven').hide();
		$('#BelowDayOne').hide();
		$('#BelowDayTwo').show();
		$('#BelowDayThree').show();
		$('#BelowDayFour').show();
		$('#BelowDayFive').show();
		$('#BelowDaySix').show();
		$('#BelowDaySeven').show();
		$('#CheckOne').show();
		$('#CheckTwo').hide();
		$('#CheckThree').hide();
		$('#CheckFour').hide();
		$('#CheckFive').hide();
		$('#CheckSix').hide();
		$('#CheckSeven').hide();
		$("#OverDayOne").attr('class', 'dateStrM');
	}
	if(val == 2)
	{
		$('#MainDiv').show();
		$('#DayTwo').show();
		$('#DayOne').hide();
		$('#DayThree').hide();
		$('#DayFour').hide();
		$('#DayFive').hide();
		$('#DaySix').hide();
		$('#DaySeven').hide();
		$('#OverDayOne').show();
		$('#OverDayTwo').show();
		$('#OverDayThree').hide();
		$('#OverDayFour').hide();
		$('#OverDayFive').hide();
		$('#OverDaySix').hide();
		$('#OverDaySeven').hide();
		$('#BelowDayOne').hide();
		$('#BelowDayTwo').hide();
		$('#BelowDayThree').show();
		$('#BelowDayFour').show();
		$('#BelowDayFive').show();
		$('#BelowDaySix').show();
		$('#BelowDaySeven').show();
		$('#CheckOne').hide();
		$('#CheckTwo').show();
		$('#CheckThree').hide();
		$('#CheckFour').hide();
		$('#CheckFive').hide();
		$('#CheckSix').hide();
		$('#CheckSeven').hide();
		$("#OverDayTwo").attr('class', 'dateStrM');
		$("#OverDayOne").attr('class', 'dateStr');
	}
	if(val == 3)
	{
		$('#MainDiv').show();
		$('#DayThree').show();
		$('#DayOne').hide();
		$('#DayTwo').hide();
		$('#DayFour').hide();
		$('#DayFive').hide();
		$('#DaySix').hide();
		$('#DaySeven').hide();
		$('#OverDayOne').show();
		$('#OverDayTwo').show();
		$('#OverDayThree').show();
		$('#OverDayFour').hide();
		$('#OverDayFive').hide();
		$('#OverDaySix').hide();
		$('#OverDaySeven').hide();
		$('#BelowDayOne').hide();
		$('#BelowDayTwo').hide();
		$('#BelowDayThree').hide();
		$('#BelowDayFour').show();
		$('#BelowDayFive').show();
		$('#BelowDaySix').show();
		$('#BelowDaySeven').show();
		$('#CheckOne').hide();
		$('#CheckTwo').hide();
		$('#CheckThree').show();
		$('#CheckFour').hide();
		$('#CheckFive').hide();
		$('#CheckSix').hide();
		$('#CheckSeven').hide();
		$("#OverDayThree").attr('class', 'dateStrM');
		$("#OverDayOne").attr('class', 'dateStr');
		$("#OverDayTwo").attr('class', 'dateStr');
	}
	if(val == 4)
	{
		$('#MainDiv').show();
		$('#DayFour').show();
		$('#DayOne').hide();
		$('#DayTwo').hide();
		$('#DayThree').hide();
		$('#DayFive').hide();
		$('#DaySix').hide();
		$('#DaySeven').hide();
		$('#OverDayOne').show();
		$('#OverDayTwo').show();
		$('#OverDayThree').show();
		$('#OverDayFour').show();
		$('#OverDayFive').hide();
		$('#OverDaySix').hide();
		$('#OverDaySeven').hide();
		$('#BelowDayOne').hide();
		$('#BelowDayTwo').hide();
		$('#BelowDayThree').hide();
		$('#BelowDayFour').hide();
		$('#BelowDayFive').show();
		$('#BelowDaySix').show();
		$('#BelowDaySeven').show();
		$('#CheckOne').hide();
		$('#CheckTwo').hide();
		$('#CheckThree').hide();
		$('#CheckFour').show();
		$('#CheckFive').hide();
		$('#CheckSix').hide();
		$('#CheckSeven').hide();
		$("#OverDayFour").attr('class', 'dateStrM');
		$("#OverDayOne").attr('class', 'dateStr');
		$("#OverDayTwo").attr('class', 'dateStr');
		$("#OverDayThree").attr('class', 'dateStr');
	}
	if(val == 5)
	{
		$('#MainDiv').show();
		$('#DayFive').show();
		$('#DayOne').hide();
		$('#DayTwo').hide();
		$('#DayThree').hide();
		$('#DayFour').hide();
		$('#DaySix').hide();
		$('#DaySeven').hide();
		$('#OverDayOne').show();
		$('#OverDayTwo').show();
		$('#OverDayThree').show();
		$('#OverDayFour').show();
		$('#OverDayFive').show();
		$('#OverDaySix').hide();
		$('#OverDaySeven').hide();
		$('#BelowDayOne').hide();
		$('#BelowDayTwo').hide();
		$('#BelowDayThree').hide();
		$('#BelowDayFour').hide();
		$('#BelowDayFive').hide();
		$('#BelowDaySix').show();
		$('#BelowDaySeven').show();
		$('#CheckOne').hide();
		$('#CheckTwo').hide();
		$('#CheckThree').hide();
		$('#CheckFour').hide();
		$('#CheckFive').show();
		$('#CheckSix').hide();
		$('#CheckSeven').hide();
		$("#OverDayFive").attr('class', 'dateStrM');
		$("#OverDayOne").attr('class', 'dateStr');
		$("#OverDayTwo").attr('class', 'dateStr');
		$("#OverDayThree").attr('class', 'dateStr');
		$("#OverDayFour").attr('class', 'dateStr');
	}
	if(val == 6)
	{
		$('#MainDiv').show();
		$('#DaySix').show();
		$('#DayOne').hide();
		$('#DayTwo').hide();
		$('#DayThree').hide();
		$('#DayFour').hide();
		$('#DayFive').hide();
		$('#DaySeven').hide();
		$('#OverDayOne').show();
		$('#OverDayTwo').show();
		$('#OverDayThree').show();
		$('#OverDayFour').show();
		$('#OverDayFive').show();
		$('#OverDaySix').show();
		$('#OverDaySeven').hide();
		$('#BelowDayOne').hide();
		$('#BelowDayTwo').hide();
		$('#BelowDayThree').hide();
		$('#BelowDayFour').hide();
		$('#BelowDayFive').hide();
		$('#BelowDaySix').hide();
		$('#BelowDaySeven').show();
		$('#CheckOne').hide();
		$('#CheckTwo').hide();
		$('#CheckThree').hide();
		$('#CheckFour').hide();
		$('#CheckFive').hide();
		$('#CheckSix').show();
		$('#CheckSeven').hide();
		$("#OverDaySix").attr('class', 'dateStrM');
		$("#OverDayOne").attr('class', 'dateStr');
		$("#OverDayTwo").attr('class', 'dateStr');
		$("#OverDayThree").attr('class', 'dateStr');
		$("#OverDayFour").attr('class', 'dateStr');
		$("#OverDayFive").attr('class', 'dateStr');
	}
	if(val == 7)
	{
		$('#MainDiv').show();
		$('#DaySeven').show();
		$('#DayOne').hide();
		$('#DayTwo').hide();
		$('#DayThree').hide();
		$('#DayFour').hide();
		$('#DayFive').hide();
		$('#DaySix').hide();
		$('#OverDayOne').show();
		$('#OverDayTwo').show();
		$('#OverDayThree').show();
		$('#OverDayFour').show();
		$('#OverDayFive').show();
		$('#OverDaySix').show();
		$('#OverDaySeven').show();
		$('#BelowDayOne').hide();
		$('#BelowDayTwo').hide();
		$('#BelowDayThree').hide();
		$('#BelowDayFour').hide();
		$('#BelowDayFive').hide();
		$('#BelowDaySix').hide();
		$('#BelowDaySeven').hide();
		$('#CheckOne').hide();
		$('#CheckTwo').hide();
		$('#CheckThree').hide();
		$('#CheckFour').hide();
		$('#CheckFive').hide();
		$('#CheckSix').hide();
		$('#CheckSeven').show();
		$("#OverDaySeven").attr('class', 'dateStrM');
		$("#OverDayOne").attr('class', 'dateStr');
		$("#OverDayTwo").attr('class', 'dateStr');
		$("#OverDayThree").attr('class', 'dateStr');
		$("#OverDayFour").attr('class', 'dateStr');
		$("#OverDayFive").attr('class', 'dateStr');
		$("#OverDaySix").attr('class', 'dateStr');
	}
}

function select_all(val)
{
	if(val == 1)
	{
		for (var i = 1; i <= 27; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',true);
		}
		var rep_div = '<input type="checkbox" onclick="unselect_all(1);" checked="checked" />&nbsp;Check All';
		$('#CheckOne').html(rep_div);
	}
	if(val == 2)
	{
		for (var i = 28; i <= 54; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',true);
		}
		var rep_div = '<input type="checkbox" onclick="unselect_all(2);" checked="checked" />&nbsp;Check All';
		$('#CheckTwo').html(rep_div);
	}
	if(val == 3)
	{
		for (var i = 55; i <= 81; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',true);
		}
		var rep_div = '<input type="checkbox" onclick="unselect_all(3);" checked="checked" />&nbsp;Check All';
		$('#CheckThree').html(rep_div);
	}
	if(val == 4)
	{
		for (var i = 82; i <= 108; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',true);
		}
		var rep_div = '<input type="checkbox" onclick="unselect_all(4);" checked="checked" />&nbsp;Check All';
		$('#CheckFour').html(rep_div);
	}
	if(val == 5)
	{
		for (var i = 109; i <= 135; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',true);
		}
		var rep_div = '<input type="checkbox" onclick="unselect_all(5);" checked="checked" />&nbsp;Check All';
		$('#CheckFive').html(rep_div);
	}
	if(val == 6)
	{
		for (var i = 136; i <= 162; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',true);
		}
		var rep_div = '<input type="checkbox" onclick="unselect_all(6);" checked="checked" />&nbsp;Check All';
		$('#CheckSix').html(rep_div);
	}
	if(val == 7)
	{
		for (var i = 163; i <= 189; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',true);
		}
		var rep_div = '<input type="checkbox" onclick="unselect_all(7);" checked="checked" />&nbsp;Check All';
		$('#CheckSeven').html(rep_div);
	}
}

function unselect_all(val)
{
	if(val == 1)
	{
		for (var i = 1; i <= 27; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',false);
		}
		var rep_div = '<input type="checkbox" onclick="select_all(1);" />&nbsp;Check All';
		$('#CheckOne').html(rep_div);
	}
	if(val == 2)
	{
		for (var i = 28; i <= 54; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',false);
		}
		var rep_div = '<input type="checkbox" onclick="select_all(2);" />&nbsp;Check All';
		$('#CheckTwo').html(rep_div);
	}
	if(val == 3)
	{
		for (var i = 55; i <= 81; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',false);
		}
		var rep_div = '<input type="checkbox" onclick="select_all(3);" />&nbsp;Check All';
		$('#CheckThree').html(rep_div);
	}
	if(val == 4)
	{
		for (var i = 82; i <= 108; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',false);
		}
		var rep_div = '<input type="checkbox" onclick="select_all(4);" />&nbsp;Check All';
		$('#CheckFour').html(rep_div);
	}
	if(val == 5)
	{
		for (var i = 109; i <= 135; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',false);
		}
		var rep_div = '<input type="checkbox" onclick="select_all(5);" />&nbsp;Check All';
		$('#CheckFive').html(rep_div);
	}
	if(val == 6)
	{
		for (var i = 136; i <= 162; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',false);
		}
		var rep_div = '<input type="checkbox" onclick="select_all(6);" />&nbsp;Check All';
		$('#CheckSix').html(rep_div);
	}
	if(val == 7)
	{
		for (var i = 163; i <= 189; i++)
		{
			$('#DoctorClinicVal'+i).attr('checked',false);
		}
		var rep_div = '<input type="checkbox" onclick="select_all(7);" />&nbsp;Check All';
		$('#CheckSeven').html(rep_div);
	}
}

function select_city(val)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'pages/get_city?id='+val,
		dataType:'json',
		success:function(data){
			if(data.city_info.status == 'Success')
			{
				var rep_div = '';
				rep_div +='<label>City <font color="#FF0000">*</font></label>';
				rep_div +='<div class="mid">:</div>';
				rep_div +='<select name="data[DoctorClinic][city]" onchange="add_new_city(this.value);">';
				rep_div +='<option value="">Select City</option>';
				jQuery.each(data.city_info.city_name,function(index, value)
				{
					rep_div +='<option value="'+value.StateCity.id+'">'+value.StateCity.city_name+'</option>';
				});
				rep_div +='<option value="other">Other</option>';
				rep_div +='</select>';
				rep_div +='<span id="msg101" style="color:#FF0000; float:left; clear:both; padding:0 0 0 210px;"></span>';
				jQuery('#CityName').html(rep_div);
			}
			if(data.city_info.status == 'Notsuccess')
			{
				var rep_div = '';
				rep_div +='<label>City <font color="#FF0000">*</font></label>';
				rep_div +='<div class="mid">:</div>';
				rep_div +='No Cities Found';
			}
			jQuery('#StateProcess').hide();
		},
		beforeSend:function(){
			jQuery('#StateProcess').show();
		},
	});
}

function add_new_city(val)
{
	if(val == 'other')
	{
		var new_city = '';
		new_city +='<label>New City Name <font color="#FF0000">*</font></label>';
		new_city +='<div class="mid">:</div>';
		new_city +='<input type="text" name="data[DoctorClinic][city_name_new]" id="DoctorClinicCityNew">';
		new_city +='<span id="msg201" style="color:#FF0000; float:left; clear:both; padding:0 0 0 210px;"></span>';
		jQuery('#CityNameNew').html(new_city);
		jQuery('#CityNameNew').show();
	}
}
</script>
<style type="text/css">

#bodyPart .bodyInnerDiv form .row {
    clear: both;
    float: left;
    min-height: 50px;
    width: 100%;
}
.OverTd{
	background-color:#EFA113; height:30px; font-weight:bold; font-size:18px; padding:5px 5px 5px 15px;
}
</style>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_dr_module_banner.jpg',array('alt'=>'Banner'))?></div>
</div>
</div>
</div>
<!--Header:End-->
<!--Body Part:Start-->
<div id="bodyPart">
  <div class="bodyInnerDiv">
    <div class="breadcrumbs">
      <div class="left">
        <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
        <div class="bread"><?php echo $this->Html->link('Become Doctor','/pages/become_doctor');?></div>
      </div>
    </div>
    <h1>Doctor <span class="green">Registration</span></h1>
    <div style="color:#FF0000; clear:both;">Fields in * are mandatory Fields</div>
    <?php if(!empty($messg)) {?>
    <span style="color:#FF0000;"><?php echo $messg; ?></span>
    <?php }?>
    <?php echo $form->create(null, array('url'=>'/pages/become_doctor_3/'.$last_id.'/'.$real_pass,'id'=>'form2','name'=>'form2','onsubmit'=>'return validationc(this);')); ?> <?php echo $form->hidden('DoctorClinic.doctor_id',array('value'=>base64_decode($last_id)));?>
	<?php echo $form->hidden('DoctorClinic.doctor_id',array('value'=>base64_decode($last_id)));?>
	<?php echo $form->hidden('DoctorClinic.go_form',array('value'=>$add_more));?>
	<h1>Clinic Information</h1>
    <div class="row">
      <label>Name of Center / Clinic <font color="#FF0000">*</font></label>
      <div class="mid">:</div>
      <?php echo $form->text('DoctorClinic.clinic_name',array('placeholder'=>'Name of Center / Clinic'));?>
	  <span id="msg1" style="color:#FF0000; float:left; clear:both; padding:0 0 0 210px;"></span>  
	</div>
    <div class="row">
      <label>Address of Clinic / Center <font color="#FF0000">*</font></label>
      <div class="mid">:</div>
      <?php echo $form->text('DoctorClinic.address1',array('placeholder'=>'Address of Center / Clinic'));?> </div>
    <div class="row">
      <label>&nbsp;</label>
      <div class="mid">:</div>
      <?php echo $form->text('DoctorClinic.address2',array('placeholder'=>'Address of Center / Clinic'));?> 
	  <span id="msg2" style="color:#FF0000; float:left; clear:both; padding:0 0 0 210px;"></span> 
	</div>
	<div class="row">
      <label>State <font color="#FF0000">*</font></label>
      <div class="mid">:</div>
      <select name="data[DoctorClinic][state]" id="DoctorClinicState" onchange="select_city(this.value);">
	  	<option value="">Select State</option>
		<?php foreach($state as $s_k => $s_v){?>
		<option value="<?php echo $s_v['State']['id'];?>"><?php echo $s_v['State']['name'];?></option>
		<?php }?>
	  </select>
	  <?php echo $html->image('loading.gif',array('id'=>'StateProcess','style'=>'display:none;'));?>
	  <span id="msg100" style="color:#FF0000; float:left; clear:both; padding:0 0 0 210px;"></span>  
	</div>
	<div class="row" id="CityName">
      <label>City <font color="#FF0000">*</font></label>
      <div class="mid">:</div>
      <select name="data[DoctorClinic][city]" id="DoctorClinicCity">
	  	<option value="">Select City</option>
	  </select>
	  <span id="msg101" style="color:#FF0000; float:left; clear:both; padding:0 0 0 210px;"></span>  
	</div>
	<div class="row" id="CityNameNew" style="display:none;"></div>
    <div class="row">
      <label>Available Days with Time <font color="#FF0000">*</font></label>
      <div class="mid">:</div>
	  <div class="rightBoxDiv">
	  	<a href="javascript:void(0);" onclick="open_day(1);"><div class="dateStr marTopNone" id="OverDayOne">Monday<span style="font-size:12px; padding:0 10px 0 0; float:right; display:none;" id="CheckOne"><input type="checkbox" onclick="select_all(1);" />&nbsp;Check All</span></div></a>
		<a href="javascript:void(0);" onclick="open_day(2);"><div class="dateStr" id="OverDayTwo">Tuesday<span style="font-size:12px; padding:0 10px 0 0; float:right; display:none;" id="CheckTwo"><input type="checkbox" onclick="select_all(2);" />&nbsp;Check All</span></div></a>
		<a href="javascript:void(0);" onclick="open_day(3);"><div class="dateStr" id="OverDayThree">Wednesday<span style="font-size:12px; padding:0 10px 0 0; float:right; display:none;" id="CheckThree"><input type="checkbox" onclick="select_all(3);" />&nbsp;Check All</span></div></a>
		<a href="javascript:void(0);" onclick="open_day(4);"><div class="dateStr" id="OverDayFour">Thursday<span style="font-size:12px; padding:0 10px 0 0; float:right; display:none;" id="CheckFour"><input type="checkbox" onclick="select_all(4);" />&nbsp;Check All</span></div></a>
		<a href="javascript:void(0);" onclick="open_day(5);"><div class="dateStr" id="OverDayFive">Friday<span style="font-size:12px; padding:0 10px 0 0; float:right; display:none;" id="CheckFive"><input type="checkbox" onclick="select_all(5);" />&nbsp;Check All</span></div></a>
		<a href="javascript:void(0);" onclick="open_day(6);"><div class="dateStr" id="OverDaySix">Saturday<span style="font-size:12px; padding:0 10px 0 0; float:right; display:none;" id="CheckSix"><input type="checkbox" onclick="select_all(6);" />&nbsp;Check All</span></div></a>
		<a href="javascript:void(0);" onclick="open_day(7);"><div class="dateStr" id="OverDaySeven">Sunday<span style="font-size:12px; padding:0 10px 0 0; float:right; display:none;" id="CheckSeven"><input type="checkbox" onclick="select_all(7);" />&nbsp;Check All</span></div></a>
	  </div>
	  <div class="rightBoxDiv" id="MainDiv" style="display:none;">
        <div class="sepDiv" id="DayOne" style="display:none;">
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="dateTable">Mon</td>
              <td><table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Morning</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_1]" id="DoctorClinicVal1" value="09:00 AM" />
                                  <span>09:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_2]" id="DoctorClinicVal2" value="09:30 AM" />
                                  <span>09:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_3]" id="DoctorClinicVal3" value="10:00 AM" />
                                  <span>10:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_4]" id="DoctorClinicVal4" value="10:30 AM" />
                                  <span>10:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_5]" id="DoctorClinicVal5" value="11:00 AM" />
                                  <span>11:00 AM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_6]" id="DoctorClinicVal6" value="11:30 AM" />
                                  <span>11:30 AM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Afternoon</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_7]" id="DoctorClinicVal7" value="12:00 PM" />
                                  <span>12:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_8]" id="DoctorClinicVal8" value="12:30 PM" />
                                  <span>12:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_9]" id="DoctorClinicVal9" value="01:00 PM" />
                                  <span>01:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_10]" id="DoctorClinicVal10" value="01:30 PM" />
                                  <span>01:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_11]" id="DoctorClinicVal11" value="02:00 PM" />
                                  <span>02:00 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_12]" id="DoctorClinicVal12" value="02:30 PM" />
                                  <span>02:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_13]" id="DoctorClinicVal13" value="03:00 PM" />
                                  <span>03:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_14]" id="DoctorClinicVal14" value="03:30 PM" />
                                  <span>03:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_15]" id="DoctorClinicVal15" value="04:00 PM" />
                                  <span>04:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Evening</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_16]" id="DoctorClinicVal16" value="04:30 PM" />
                                  <span>04:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_17]" id="DoctorClinicVal17" value="05:00 PM" />
                                  <span>05:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_18]" id="DoctorClinicVal18" value="05:30 PM" />
                                  <span>05:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_19]" id="DoctorClinicVal19" value="06:00 PM" />
                                  <span>06:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_20]" id="DoctorClinicVal20" value="06:30 PM" />
                                  <span>06:30 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_21]" id="DoctorClinicVal21" value="07:00 PM" />
                                  <span>07:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_22]" id="DoctorClinicVal22" value="07:30 PM" />
                                  <span>07:30 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Night</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_23]" id="DoctorClinicVal23" value="08:00 PM" />
                                  <span>08:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_24]" id="DoctorClinicVal24" value="08:30 PM" />
                                  <span>08:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_25]" id="DoctorClinicVal25" value="09:00 PM" />
                                  <span>09:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_26]" id="DoctorClinicVal26" value="09:30 PM" />
                                  <span>09:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_27]" id="DoctorClinicVal27" value="10:00 PM" />
                                  <span>10:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </div>
        <div class="sepDiv" id="DayTwo" style="display:none;">
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="dateTable">Tue</td>
              <td><table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Morning</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_28]" id="DoctorClinicVal28" value="09:00 AM" />
                                  <span>09:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_29]" id="DoctorClinicVal29" value="09:30 AM" />
                                  <span>09:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_30]" id="DoctorClinicVal30" value="10:00 AM" />
                                  <span>10:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_31]" id="DoctorClinicVal31" value="10:30 AM" />
                                  <span>10:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_32]" id="DoctorClinicVal32" value="11:00 AM" />
                                  <span>11:00 AM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_33]" id="DoctorClinicVal33" value="11:30 AM" />
                                  <span>11:30 AM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Afternoon</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_34]" id="DoctorClinicVal34" value="12:00 PM" />
                                  <span>12:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_35]" id="DoctorClinicVal35" value="12:30 PM" />
                                  <span>12:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_36]" id="DoctorClinicVal36" value="01:00 PM" />
                                  <span>01:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_37]" id="DoctorClinicVal37" value="01:30 PM" />
                                  <span>01:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_38]" id="DoctorClinicVal38" value="02:00 PM" />
                                  <span>02:00 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_39]" id="DoctorClinicVal39" value="02:30 PM" />
                                  <span>02:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_40]" id="DoctorClinicVal40" value="03:00 PM" />
                                  <span>03:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_41]" id="DoctorClinicVal41" value="03:30 PM" />
                                  <span>03:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_42]" id="DoctorClinicVal42" value="04:00 PM" />
                                  <span>04:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Evening</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_43]" id="DoctorClinicVal43" value="04:30 PM" />
                                  <span>04:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_44]" id="DoctorClinicVal44" value="05:00 PM" />
                                  <span>05:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_45]" id="DoctorClinicVal45" value="05:30 PM" />
                                  <span>05:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_46]" id="DoctorClinicVal46" value="06:00 PM" />
                                  <span>06:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_47]" id="DoctorClinicVal47" value="06:30 PM" />
                                  <span>06:30 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_48]" id="DoctorClinicVal48" value="07:00 PM" />
                                  <span>07:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_49]" id="DoctorClinicVal49" value="07:30 PM" />
                                  <span>07:30 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Night</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_50]" id="DoctorClinicVal50" value="08:00 PM" />
                                  <span>08:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_51]" id="DoctorClinicVal51" value="08:30 PM" />
                                  <span>08:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_52]" id="DoctorClinicVal52" value="09:00 PM" />
                                  <span>09:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_53]" id="DoctorClinicVal53" value="09:30 PM" />
                                  <span>09:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_54]" id="DoctorClinicVal54" value="10:00 PM" />
                                  <span>10:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </div>
        <div class="sepDiv" id="DayThree" style="display:none;">
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="dateTable">Wed</td>
              <td><table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Morning</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_55]" id="DoctorClinicVal55" value="09:00 AM" />
                                  <span>09:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_56]" id="DoctorClinicVal56" value="09:30 AM" />
                                  <span>09:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_57]" id="DoctorClinicVal57" value="10:00 AM" />
                                  <span>10:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_58]" id="DoctorClinicVal58" value="10:30 AM" />
                                  <span>10:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_59]" id="DoctorClinicVal59" value="11:00 AM" />
                                  <span>11:00 AM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_60]" id="DoctorClinicVal60" value="11:30 AM" />
                                  <span>11:30 AM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Afternoon</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_61]" id="DoctorClinicVal61" value="12:00 PM" />
                                  <span>12:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_62]" id="DoctorClinicVal62" value="12:30 PM" />
                                  <span>12:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_63]" id="DoctorClinicVal63" value="01:00 PM" />
                                  <span>01:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_64]" id="DoctorClinicVal64" value="01:30 PM" />
                                  <span>01:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_65]" id="DoctorClinicVal65" value="02:00 PM" />
                                  <span>02:00 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_66]" id="DoctorClinicVal66" value="02:30 PM" />
                                  <span>02:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_67]" id="DoctorClinicVal67" value="03:00 PM" />
                                  <span>03:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_68]" id="DoctorClinicVal68" value="03:30 PM" />
                                  <span>03:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_69]" id="DoctorClinicVal69" value="04:00 PM" />
                                  <span>04:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Evening</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_70]" id="DoctorClinicVal70" value="04:30 PM" />
                                  <span>04:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_71]" id="DoctorClinicVal71" value="05:00 PM" />
                                  <span>05:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_72]" id="DoctorClinicVal72" value="05:30 PM" />
                                  <span>05:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_73]" id="DoctorClinicVal73" value="06:00 PM" />
                                  <span>06:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_74]" id="DoctorClinicVal74" value="06:30 PM" />
                                  <span>06:30 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_75]" id="DoctorClinicVal75" value="07:00 PM" />
                                  <span>07:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_76]" id="DoctorClinicVal76" value="07:30 PM" />
                                  <span>07:30 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Night</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_77]" id="DoctorClinicVal77" value="08:00 PM" />
                                  <span>08:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_78]" id="DoctorClinicVal78" value="08:30 PM" />
                                  <span>08:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_79]" id="DoctorClinicVal79" value="09:00 PM" />
                                  <span>09:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_80]" id="DoctorClinicVal80" value="09:30 PM" />
                                  <span>09:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_81]" id="DoctorClinicVal81" value="10:00 PM" />
                                  <span>10:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </div>
        <div class="sepDiv" id="DayFour" style="display:none;">
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="dateTable">Thu</td>
              <td><table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Morning</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_82]" id="DoctorClinicVal82" value="09:00 AM" />
                                  <span>09:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_83]" id="DoctorClinicVal83" value="09:30 AM" />
                                  <span>09:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_84]" id="DoctorClinicVal84" value="10:00 AM" />
                                  <span>10:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_85]" id="DoctorClinicVal85" value="10:30 AM" />
                                  <span>10:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_86]" id="DoctorClinicVal86" value="11:00 AM" />
                                  <span>11:00 AM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_87]" id="DoctorClinicVal87" value="11:30 AM" />
                                  <span>11:30 AM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Afternoon</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_88]" id="DoctorClinicVal88" value="12:00 PM" />
                                  <span>12:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_89]" id="DoctorClinicVal89" value="12:30 PM" />
                                  <span>12:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_90]" id="DoctorClinicVal90" value="01:00 PM" />
                                  <span>01:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_91]" id="DoctorClinicVal91" value="01:30 PM" />
                                  <span>01:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_92]" id="DoctorClinicVal92" value="02:00 PM" />
                                  <span>02:00 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_93]" id="DoctorClinicVal93" value="02:30 PM" />
                                  <span>02:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_94]" id="DoctorClinicVal94" value="03:00 PM" />
                                  <span>03:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_95]" id="DoctorClinicVal95" value="03:30 PM" />
                                  <span>03:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_96]" id="DoctorClinicVal96" value="04:00 PM" />
                                  <span>04:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Evening</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_97]" id="DoctorClinicVal97" value="04:30 PM" />
                                  <span>04:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_98]" id="DoctorClinicVal98" value="05:00 PM" />
                                  <span>05:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_99]" id="DoctorClinicVal99" value="05:30 PM" />
                                  <span>05:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_100]" id="DoctorClinicVal100" value="06:00 PM" />
                                  <span>06:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_101]" id="DoctorClinicVal101" value="06:30 PM" />
                                  <span>06:30 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_102]" id="DoctorClinicVal102" value="07:00 PM" />
                                  <span>07:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_103]" id="DoctorClinicVal103" value="07:30 PM" />
                                  <span>07:30 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Night</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_104]" id="DoctorClinicVal104" value="08:00 PM" />
                                  <span>08:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_105]" id="DoctorClinicVal105" value="08:30 PM" />
                                  <span>08:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_106]" id="DoctorClinicVal106" value="09:00 PM" />
                                  <span>09:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_107]" id="DoctorClinicVal107" value="09:30 PM" />
                                  <span>09:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_108]" id="DoctorClinicVal108" value="10:00 PM" />
                                  <span>10:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </div>
        <div class="sepDiv" id="DayFive" style="display:none;">
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="dateTable">Fri</td>
              <td><table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Morning</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_109]" id="DoctorClinicVal109" value="09:00 AM" />
                                  <span>09:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_110]" id="DoctorClinicVal110" value="09:30 AM" />
                                  <span>09:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_111]" id="DoctorClinicVal111" value="10:00 AM" />
                                  <span>10:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_112]" id="DoctorClinicVal112" value="10:30 AM" />
                                  <span>10:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_113]" id="DoctorClinicVal113" value="11:00 AM" />
                                  <span>11:00 AM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_114]" id="DoctorClinicVal114" value="11:30 AM" />
                                  <span>11:30 AM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Afternoon</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_115]" id="DoctorClinicVal115" value="12:00 PM" />
                                  <span>12:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_116]" id="DoctorClinicVal116" value="12:30 PM" />
                                  <span>12:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_117]" id="DoctorClinicVal117" value="01:00 PM" />
                                  <span>01:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_118]" id="DoctorClinicVal118" value="01:30 PM" />
                                  <span>01:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_119]" id="DoctorClinicVal119" value="02:00 PM" />
                                  <span>02:00 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_120]" id="DoctorClinicVal120" value="02:30 PM" />
                                  <span>02:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_121]" id="DoctorClinicVal121" value="03:00 PM" />
                                  <span>03:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_122]" id="DoctorClinicVal122" value="03:30 PM" />
                                  <span>03:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_123]" id="DoctorClinicVal123" value="04:00 PM" />
                                  <span>04:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Evening</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_124]" id="DoctorClinicVal124" value="04:30 PM" />
                                  <span>04:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_125]" id="DoctorClinicVal125" value="05:00 PM" />
                                  <span>05:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_126]" id="DoctorClinicVal126" value="05:30 PM" />
                                  <span>05:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_127]" id="DoctorClinicVal127" value="06:00 PM" />
                                  <span>06:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_128]" id="DoctorClinicVal128" value="06:30 PM" />
                                  <span>06:30 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_129]" id="DoctorClinicVal129" value="07:00 PM" />
                                  <span>07:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_130]" id="DoctorClinicVal130" value="07:30 PM" />
                                  <span>07:30 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Night</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_131]" id="DoctorClinicVal131" value="08:00 PM" />
                                  <span>08:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_132]" id="DoctorClinicVal132" value="08:30 PM" />
                                  <span>08:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_133]" id="DoctorClinicVal133" value="09:00 PM" />
                                  <span>09:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_134]" id="DoctorClinicVal134" value="09:30 PM" />
                                  <span>09:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_135]" id="DoctorClinicVal135" value="10:00 PM" />
                                  <span>10:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </div>
        <div class="sepDiv" id="DaySix" style="display:none;">
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="dateTable">Sat</td>
              <td><table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Morning</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_136]" id="DoctorClinicVal136" value="09:00 AM" />
                                  <span>09:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_137]" id="DoctorClinicVal137" value="09:30 AM" />
                                  <span>09:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_138]" id="DoctorClinicVal138" value="10:00 AM" />
                                  <span>10:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_139]" id="DoctorClinicVal139" value="10:30 AM" />
                                  <span>10:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_140]" id="DoctorClinicVal140" value="11:00 AM" />
                                  <span>11:00 AM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_141]" id="DoctorClinicVal141" value="11:30 AM" />
                                  <span>11:30 AM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Afternoon</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_142]" id="DoctorClinicVal142" value="12:00 PM" />
                                  <span>12:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_143]" id="DoctorClinicVal143" value="12:30 PM" />
                                  <span>12:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_144]" id="DoctorClinicVal144" value="01:00 PM" />
                                  <span>01:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_145]" id="DoctorClinicVal145" value="01:30 PM" />
                                  <span>01:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_146]" id="DoctorClinicVal146" value="02:00 PM" />
                                  <span>02:00 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_147]" id="DoctorClinicVal147" value="02:30 PM" />
                                  <span>02:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_148]" id="DoctorClinicVal148" value="03:00 PM" />
                                  <span>03:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_149]" id="DoctorClinicVal149" value="03:30 PM" />
                                  <span>03:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_150]" id="DoctorClinicVal150" value="04:00 PM" />
                                  <span>04:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Evening</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_151]" id="DoctorClinicVal151" value="04:30 PM" />
                                  <span>04:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_152]" id="DoctorClinicVal152" value="05:00 PM" />
                                  <span>05:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_153]" id="DoctorClinicVal153" value="05:30 PM" />
                                  <span>05:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_154]" id="DoctorClinicVal154" value="06:00 PM" />
                                  <span>06:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_155]" id="DoctorClinicVal155" value="06:30 PM" />
                                  <span>06:30 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_156]" id="DoctorClinicVal156" value="07:00 PM" />
                                  <span>07:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_157]" id="DoctorClinicVal157" value="07:30 PM" />
                                  <span>07:30 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Night</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_158]" id="DoctorClinicVal158" value="08:00 PM" />
                                  <span>08:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_159]" id="DoctorClinicVal159" value="08:30 PM" />
                                  <span>08:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_160]" id="DoctorClinicVal160" value="09:00 PM" />
                                  <span>09:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_161]" id="DoctorClinicVal161" value="09:30 PM" />
                                  <span>09:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_162]" id="DoctorClinicVal162" value="10:00 PM" />
                                  <span>10:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </div>
        <div class="sepDiv" id="DaySeven" style="display:none;">
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="dateTable">Sun</td>
              <td><table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Morning</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_163]" id="DoctorClinicVal163" value="09:00 AM" />
                                  <span>09:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_164]" id="DoctorClinicVal164" value="09:30 AM" />
                                  <span>09:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_165]" id="DoctorClinicVal165" value="10:00 AM" />
                                  <span>10:00 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_166]" id="DoctorClinicVal166" value="10:30 AM" />
                                  <span>10:30 AM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_167]" id="DoctorClinicVal167" value="11:00 AM" />
                                  <span>11:00 AM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_168]" id="DoctorClinicVal168" value="11:30 AM" />
                                  <span>11:30 AM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Afternoon</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_169]" id="DoctorClinicVal169" value="12:00 PM" />
                                  <span>12:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_170]" id="DoctorClinicVal170" value="12:30 PM" />
                                  <span>12:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_171]" id="DoctorClinicVal171" value="01:00 PM" />
                                  <span>01:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_172]" id="DoctorClinicVal172" value="01:30 PM" />
                                  <span>01:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_173]" id="DoctorClinicVal173" value="02:00 PM" />
                                  <span>02:00 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_174]" id="DoctorClinicVal174" value="02:30 PM" />
                                  <span>02:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_175]" id="DoctorClinicVal175" value="03:00 PM" />
                                  <span>03:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_176]" id="DoctorClinicVal176" value="03:30 PM" />
                                  <span>03:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_177]" id="DoctorClinicVal177" value="04:00 PM" />
                                  <span>04:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="borBott"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Evening</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_178]" id="DoctorClinicVal178" value="04:30 PM" />
                                  <span>04:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_179]" id="DoctorClinicVal179" value="05:00 PM" />
                                  <span>05:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_180]" id="DoctorClinicVal180" value="05:30 PM" />
                                  <span>05:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_181]" id="DoctorClinicVal181" value="06:00 PM" />
                                  <span>06:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_182]" id="DoctorClinicVal182" value="06:30 PM" />
                                  <span>06:30 PM</span>
								</div>
                              </li>
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_183]" id="DoctorClinicVal183" value="07:00 PM" />
                                  <span>07:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_184]" id="DoctorClinicVal184" value="07:30 PM" />
                                  <span>07:30 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="timeTable">Night</td>
                          <td><ul class="selectTime">
                              <li>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_185]" id="DoctorClinicVal185" value="08:00 PM" />
                                  <span>08:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_186]" id="DoctorClinicVal186" value="08:30 PM" />
                                  <span>08:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_187]" id="DoctorClinicVal187" value="09:00 PM" />
                                  <span>09:00 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_188]" id="DoctorClinicVal188" value="09:30 PM" />
                                  <span>09:30 PM</span>
								</div>
                                <div class="boxDiv">
                                  <input type="checkbox" name="data[DoctorClinic][val_189]" id="DoctorClinicVal189" value="10:00 PM" />
                                  <span>10:00 PM</span>
								</div>
                              </li>
                            </ul></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </div>
      </div>
	  <div class="rightBoxDiv" id="SingleDay">
	  	<a href="javascript:void(0);" onclick="open_day(1);"><div class="dateStr" id="BelowDayOne" style="display:none;">Monday</div></a>
		<a href="javascript:void(0);" onclick="open_day(2);"><div class="dateStr" id="BelowDayTwo" style="display:none;">Tuesday</div></a>
		<a href="javascript:void(0);" onclick="open_day(3);"><div class="dateStr" id="BelowDayThree" style="display:none;">Wednesday</div></a>
		<a href="javascript:void(0);" onclick="open_day(4);"><div class="dateStr" id="BelowDayFour" style="display:none;">Thursday</div></a>
		<a href="javascript:void(0);" onclick="open_day(5);"><div class="dateStr" id="BelowDayFive" style="display:none;">Friday</div></a>
		<a href="javascript:void(0);" onclick="open_day(6);"><div class="dateStr" id="BelowDaySix" style="display:none;">Saturday</div></a>
		<a href="javascript:void(0);" onclick="open_day(7);"><div class="dateStr" id="BelowDaySeven" style="display:none;">Sunday</div></a>
	  </div>
    </div>
    <!--<div class="row" style="margin:20px 0 0 0;">
      <label>Consultancy Fee <font color="#FF0000">*</font></label>
      <div class="mid">:</div>
      <?php //echo $form->text('DoctorClinic.consultancy_fee',array('placeholder'=>'Consultancy Fee'));?> 
	  <span id="msg3" style="color:#FF0000; float:left; clear:both; padding:0 0 0 210px;"></span> 
	</div>
    <div class="row">
      <label>Home Visit Facility</label>
      <div class="mid">:</div>
      <input type="radio" name="data[DoctorClinic][home_visit]" value="1" onclick="show_h_cons_fee(this.value);" />
      &nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="data[DoctorClinic][home_visit]" value="0" onclick="show_h_cons_fee(this.value);" />
      No </div>
    <div class="row" id="HomeConsFee1" style="display:none;">
      <label>Home Visit Consultancy Fee</label>
      <div class="mid">:</div>
      <?php //echo $form->text('DoctorClinic.home_visit_fee',array('placeholder'=>'Home Visit Consultancy Fee'));?> </div>-->
    <div class="row">
      <label>Want to Add More Clinic</label>
      <div class="mid">:</div>
      <input type="radio" name="data[DoctorClinic][add_more]" value="1" />
      &nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="data[DoctorClinic][add_more]" value="0" />
      No </div>
    <input type="image" src="<?php echo SITE_URL;?>img/submit-button.gif" alt="Next" class="btn" />
    </form>
    <div class="bottomShadow"></div>
  </div>
</div>
