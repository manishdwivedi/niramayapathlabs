 <script type="text/javascript">
   $(document).ready(function () {
      $('#id_radio1').removeClass('active');
      $('#id_radio2').removeClass('active');
    $('#id_radio1').click(function () {
       
       $('#div2').hide('');
       $('#div1').show('');
       
       $('#id_radio1').toggleClass('active');
       $('#id_radio2').removeClass('active');
       
  });
  $('#id_radio2').click(function () {
      
      $('#div1').hide('');
      $('#div2').show('');
      
      $('#id_radio1').removeClass('active');
      $('#id_radio2').toggleClass('active');
   });
   });


  
function validationc()
{
var str=true;
document.getElementById("msg1").innerHTML="";
document.getElementById("msg2").innerHTML="";
document.getElementById("msg3").innerHTML="";
document.getElementById("msg8").innerHTML="";
document.getElementById("msg9").innerHTML="";
document.getElementById("msg12").innerHTML="";
document.getElementById("msg13").innerHTML="";
//document.getElementById("msg15").innerHTML="";
document.getElementById("msg102").innerHTML="";
document.getElementById("msg103").innerHTML="";
document.getElementById("msg104").innerHTML="";
document.getElementById("msg105").innerHTML="";
document.getElementById("msg106").innerHTML="";
document.getElementById("msg107").innerHTML="";
document.getElementById("msg99").innerHTML="";


if(document.form1.HealthName.value=='Please Enter Your name')
{
  document.getElementById("msg1").innerHTML="Please Enter Your name";
  str=false;
}
//else if(IsCharacter(document.form1.HealthName.value)==false)
//{
//  document.getElementById("msg1").innerHTML="Please Enter Your Valid Name";
//  str=false;
//}
if(document.form1.HealthGender.value=='')
{
  document.getElementById("msg2").innerHTML="Please Select Your gender";
  str=false;
}
if(document.form1.HealthAge.value=='Please Enter Your age')
{
  document.getElementById("msg3").innerHTML="Please Enter Your age";
  str=false;
}
else if(document.form1.HealthAge.value.length>3)
{
  document.getElementById("msg3").innerHTML="Age must be between 1 to 3 digits";
  str=false;
}
else if(isNaN(document.form1.HealthAge.value))
{
  document.getElementById("msg3").innerHTML="Please Enter Valid Age";
  str=false;
}
if(document.form1.HealthRemarks.value == 'Please enter your remarks')
{
  document.getElementById("msg9").innerHTML="Please enter your remarks";
  str=false;
}
if(document.form1.HealthRemark.value == 'Please Enter Your Refferal')
{
  document.getElementById("msg8").innerHTML="Please Enter Your Refferal";
  str=false;
}
if( document.getElementById("beforeQue1").style.display=="block")
{
  //if( ( document.form1.HealthCityLab1[0].checked == false ) && ( document.form1.HealthCityLab1[1].checked == false ) && ( document.form1.HealthCityLab1[2].checked == false ) )
//  {
//    document.getElementById("msg15").innerHTML="Please select a Lab Location";
//    str=false;
//  }
  if( document.form1.HealthSampleTime.value == '' )
  {
    document.getElementById("msg12").innerHTML="Please select the suitable time";
    str=false;
  }
  else if(isNaN(document.form1.HealthSampleTime.value))
  {
    document.getElementById("msg12").innerHTML="Please Enter Valid sample Time";
    str=false;
  }
  if( document.form1.HealthSampleDate.value == 'Please select a suitable date')
  {
    document.getElementById("msg13").innerHTML="Please select a suitable date";
    str=false;
  }
}

if( document.getElementById("firstQuestion").style.display=="block")
{ 
  if( document.form1.HealthCityId.value == '')
  {
    document.getElementById("msg102").innerHTML="Please select city";
    str=false;
  }
  if( document.form1.HealthAddress1.value == 'Please enter your residential address')
  {
    document.getElementById("msg103").innerHTML="Please enter your residential address";
    str=false;
  }
  if( document.form1.HealthState.value == '')
  {
    document.getElementById("msg104").innerHTML="Please select state";
    str=false;
  }
  if( document.form1.HealthLocality.value == 'Please enter locality')
  {
    document.getElementById("msg105").innerHTML="Please enter locality";
    str=false;
  }
  if( document.form1.HealthPincode.value == 'Please enter pincode')
  {
    document.getElementById("msg106").innerHTML="Please enter pincode";
    str=false;
  }
  if( document.form1.HealthLandmark.value == 'Please enter your landmark')
  {
    document.getElementById("msg107").innerHTML="Please enter your landmark";
    str=false;
  }
} 
if(document.form1.HealthLandline.value=='Please Enter Your mobile number')
{
  document.getElementById("msg99").innerHTML="Please Enter Your mobile number";
  str=false;
}
return str;
}

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/jquery/ui-lightness/admin/jquery-ui.css" />

<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery/jquery.ui.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



<script type="text/javascript">



   $(document).ready(function () {
    $('.lab-header input[type="radio"]').click(function(){

        var inputValue = $(this).attr("value");
        var targetBox = $(".lab_" + inputValue);
        $(".content-sec").not(targetBox).hide();
        $(targetBox).show();




    //  $(this).parent('.lab-header').parent('.lab_listing').children('.content-sec').addClass('active');
     // $('.content-sec.active').show();
    });

  $( ".datepicker1" ).datepicker({
    minDate: 0,
    maxDate: '+6M',
    dateFormat: 'dd-mm-yy'});
   $( ".datepicker" ).datepicker({
    minDate: 0,
    maxDate: '+6M',
    dateFormat: 'dd-mm-yy'});


   });


</script>

<div id="layout">
    </div>
  </div>    
<div class="banner_res"><?php echo $this->Html->image('frontend/mobilebanner/niramaya_profiles.jpg',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'))?></div>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'))?></div>
      </div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
  <!--Body Part:Start-->
 <div id="bodyPart" class="inner_test_page">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="https://www.niramayahealthcare.com/pages/index">Home Page</a></div>
          <div class="bread"><a href="/tests/health_collection">Health Collection</a></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
  <h1>Booking <span class="green">Request</span></h1>
  
  <br /><br/>
    <!--<div class="greenText">You have opted for <b></b></div>-->
        
        <div class="box-controller">
              <div class="form-title">
                    <div class="panels-inner" style="width:856px;">patient Details</div>
                </div>
              <div class="login-panel sign">
                  <div class="panels-inner booking_page_width">
                    <?php echo $form->create(null, array('url'=>'','id'=>'form1','name'=>'form1','class'=>'','onsubmit'=>'return validationc(this);')); ?>
                          <div class="abc">
                              <div class="left-side">
                                <ul>
                                    <li>
                                        <label>Full Name</label>
                                      <?php echo $form->text('Health.name',array('value'=>$userData['User']['name'],'onblur'=>'if(this.value=="")this.value="Please Enter Your name"',' onfocus'=>'if(this.value=="Please Enter Your name")this.value="";')); ?>
                                    </li>
                                    <li>
                                        <label>age</label>
                                        <?php echo $form->text('Health.age', array('class'=>'','value'=>$userData['User']['age'],'onblur'=>'if(this.value=="")this.value="Please Enter Your age"',' onfocus'=>'if(this.value=="Please Enter Your age")this.value="";')); ?>
                                    </li>
                                    <li>
                                        <label>remarks</label>
                                     <?php echo $form->textarea('Health.remarks', array('class'=>'','value'=>'Please enter your remarks','onblur'=>'if(this.value=="")this.value="Please enter your remarks"',' onfocus'=>'if(this.value=="Please enter your remarks")this.value="";','rows'=>5,'cols'=>30)); ?> 
                                    </li>
                                </ul>
                            </div>
                              <div class="right-side">
                                <ul>
                                  <li>
                                        <label>gender</label>
                                     <select name="data[Health][gender]" class="" id="HealthGender">
    <option value="">Please Select Your Gender</option>
    <?php foreach($gender as $key => $val) {?>
    <option value="<?php echo $val['Gender']['id'];?>" <?php if($userData['User']['gender'] == $val['Gender']['id']) {?> selected="selected" <?php }?>><?php echo $val['Gender']['name'];?></option>
    <?php }?>
  </select>  
                                    </li>
                                    <li>
                                        <label>Contact No.</label>
                                          <?php echo $form->text('Health.landline', array('value'=>$userData['User']['contact'],'onblur'=>'if(this.value=="")this.value="Please Enter Your mobile number"',' onfocus'=>'if(this.value=="Please Enter Your mobile number")this.value="";')); ?> 
                                    </li>
                                    <li>
                                        <label>Refered by</label>
                                      <?php echo $form->text('Health.remark', array('class'=>'','value'=>'Please Enter Your referral','onblur'=>'if(this.value=="")this.value="Please Enter Your referral"',' onfocus'=>'if(this.value=="Please Enter Your referral")this.value="";')); ?>
                                    </li>
                                </ul>
                            </div>
                          </div>
                            <div class="sample_collection">
                                <h4>Choose sample collection option</h4>
                            </div>
                            <div class="choosing_point">
                                <ul>
                                    <li><input id="id_radio1" type="radio" name="opt" onclick="openQueBefore1();" value="value_radio1" /><label>Visit a Lab</label></li>
                                    <li><input id="id_radio2" type="radio" name="opt" value="value_radio2" /><label>Home Collection</label></li>
                                </ul>
                            </div>
                          <div class="lab-content bxx" id="div1">
                              <div class="left-lab">

                                  <?php $f = 1; foreach($pcc as $key => $val) {?>  
                                  
                                  <div class="lab_listing ">
                                      <div class="lab-header">
                                          <h5><?php echo $val['Lab']['pcc_name'];?></h5>
                                            <span></span>
                                            <input type="radio" name="data[Health][city]" id="HealthCityLab1" value="<?php echo $val['Lab']['id'];?>" />
                                        </div>
                                        <div class="content-sec lab_<?php echo $val['Lab']['id'];?> ">
                                          <p><?php echo nl2br($val['Lab']['pcc_address']);?></p>
                                           
                                        </div>
                                    </div>
                                                                      
                                                                             
                                            <?php $f++; } ?>                                                           
                                    
                                </div>

                                <div  class="visit">
                              <div class="left-side">
                                <ul>
                                    <li>
                                       <label>Time</label>
   
   <?php echo $form->input('Health.sample_time',array('type'=>'select','options'=>$time,'empty'=>'Please select a suitable time','class'=>'','label'=>false)); ?> 
                                    </li>

                                </ul>
                              </div>
                                <div class="right-side">
                                <ul>
                                    <li>
                                       <label class="">Date</label>
    
    <?php echo $form->text('Health.sample_date', array('class'=>'datepicker','value'=>'Please select a suitable date','onblur'=>'if(this.value=="")this.value="Please select a suitable date"',' onfocus'=>'if(this.value=="Please select a suitable date")this.value="";')); ?>   
                                    </li>

                                     <li class="button-section">

                                          <!-- <input type="submit" name="submit" value="Submit" />-->
                                          <?php echo $form->submit('submit', array('div'=>false, 'class' => 'right')); ?>
                                        </li>

                                </ul>
                              </div>
                            </div>


  
    <!--<div class="boxRow"><img src="common/images/submit-button.gif" class="right" alt="Submit" /></div>-->
       
    </div>
   
    


                          <div class="home-collection bxx" id="div2">
                            <p>Please select a date and time for Collection of Sample. Our representative will come to the address mention above.</p>
                                <div class="home-area">
                                    <div class="left-side">
                                    <ul>
                                        <li>
                                            <label>Time</label>
                                           <?php echo $form->input('Health.sample_time1',array('type'=>'select','options'=>$time1,'empty'=>'Please select a suitable time','class'=>'','label'=>false)); ?>
                                        </li>
                                        <li>
                                            <label>Address</label>
                                        <?php  $explode_add = explode('*',$userData['User']['address']); ?>

                                            <?php echo $form->textarea('Health.address1', array('class'=>'','value'=>$explode_add[0])); ?>
    
                                        </li>
                                         <li>
                                            <label>State</label>
                                          <select name="data[Health][state]" id="HealthState" class="">
                                              <option value="">Please Select State</option>
                                                 <?php foreach($state as $key => $val) {?>
                                     <option value="<?php echo $val['State']['id'];?>" <?php if($val['State']['id'] == $userData['User']['state']) {?> selected="selected" <?php }?>><?php echo $val['State']['name'];?></option>
    <?php }?>
  </select>
                                        </li>
                                        <li>
                                            <label>Pincode</label>
                                          <?php echo $form->text('Health.pincode', array('class'=>'','value'=>$userData['User']['pincode'])); ?>
                                        </li>
                                    </ul>
                                </div>
                                    <div class="right-side">
                                    <ul>
                                        <li>
                                            <label>Date</label>
                                           <?php echo $form->text('Health.sample_date1', array('class'=>'datepicker1','value'=>'Please select a suitable date','onblur'=>'if(this.value=="")this.value="Please select a suitable date"',' onfocus'=>'if(this.value=="Please select a suitable date")this.value="";')); ?>
                                        </li>
                                        <li>
                                            <label>City</label>
                                        <!--    <select name="fname" placeholder="Please enter your city" style="margin-bottom:37px;">
                                                <option>Faridabad</option>
                                                <option>Delhi</option>
                                            </select>-->

                 <select name="data[Health][city_id]" id="HealthCityId" class="" style="margin-bottom:37px;">
    <option value="">Please Select City</option>
    <?php foreach($city as $key => $val) {?>
    <option value="<?php echo $val['City']['id'];?>" <?php if($val['City']['id'] == $userData['User']['city']) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
    <?php }?>
  </select>

                                        </li>
                                        <li>
                                            <label>Locality</label>
                                           <?php echo $form->text('Health.locality', array('class'=>'','value'=>$userData['User']['locality'])); ?>
                                        </li>
                                        <li>
                                            <label>Landmark</label>
                                           <?php echo $form->text('Health.landmark', array('class'=>'','value'=>$userData['User']['landmark'])); ?>
                                        </li>
                                        <li class="button-section">
                                            <?php echo $form->submit('submit', array('div'=>false, 'class' => 'right')); ?>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                          </div>
                       <?php echo $form->end(); ?>
                    </div>
                </div>
            </div>
            
            
      </div>
  </div>
  </div>
 
  



