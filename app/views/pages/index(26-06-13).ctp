<?php echo $this->Html->script('home_banner/jquery-1.4.2');?>
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
if(document.form3.BecomeName.value=='Please Enter Your name')
{
	document.getElementById("msg11").innerHTML="Please Enter Your name";
	str=false;
}
else if(IsCharacter(document.form3.BecomeName.value)==false)

{

	document.getElementById("msg11").innerHTML="Please Enter Your Valid Name";

	str=false;

}

if(document.form3.BecomeEmail.value=='Please Enter Your email')
{
	document.getElementById("msg12").innerHTML="Please Enter Your email";
	str=false;
}
else if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.form3.BecomeEmail.value)==false)
{
	document.getElementById("msg12").innerHTML="Please Enter Your Valid email";
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
 </script>
 <div class="packagesInnerDiv">
      <div class="leftBox">
        <div class="innerDiv">
          <h1><span class="green">Become</span> a Member</h1>
          <p>Be the first to know about latest updates and offers from Niramaya.</p>
            <?php 
			if(!empty($bm_msg))
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
                    <?php echo $form->end(); ?>
                    
            
            
        </div>
      </div>
      <div class="leftBox leftPost">
        <div class="innerDiv">
          <h1><span class="green">NIRAMAYA</span> PACKAGES</h1>
          <p>Packages specially designed for your lifestyle needs</p>
          <ul>
            <li><?php echo $this->Html->link('WholeBody Health Check-Up','/tests/packages');?></li>
            <li><?php echo $this->Html->link('Executive Health Check-Up','/tests/packages');?></li>
            <li><?php echo $this->Html->link('Executive Plus Health Check-Up','/tests/packages');?></li>
            <li class="borderNone"><?php echo $this->Html->link('Cancer Health Check-Up','/tests/packages');?></li>
          </ul>
        </div>
      </div>
	  <?php echo $form->create(null, array('url'=>'/tests/health_collection/home','id'=>'form1','name'=>'form1','class'=>'marTopNone')); ?>
      
      <div class="rightPart">
        <div class="box">
          <h1>Book your Test / Profile</h1>
          <div class="testBox">
            <div class="opt">
              <div class="heading">
                <input type="radio" class="radioBtn" name="opt1" onclick="showMail();" checked="checked"/>
                <h6>Test</h6>
              </div>
              <p>Book individual tests</p>
            </div>
            <div class="opt borderNone">
              <div class="heading">
                <input type="radio" class="radioBtn" name="opt1" onclick="openQueBefore1();"/>
                <h6>Profile</h6>
              </div>
              <p>Profiles(consist of multiple tests)</p>
            </div>
            <!--<select name="data[Sample][test_id]" class="selectBox" multiple="multiple" size="10">
				<option value="">Select Test</option>
				<?php //foreach($tests as $key => $val) {?>
				<option value="<?php //echo $val['Test']['id'];?>"><?php //echo $val['Test']['test_parameter'];?></option>
				<?php //}?>
			</select>-->
             <div  id="firstQuestion" style="display:block">
            
           
            <select name="data[Sample][test_id]" class="selectBox" style="width:300px">
				<option value="">Select Test</option>
				<?php foreach($tests as $key => $val) {?>
				<option value="<?php echo $val['Test']['id'];?>"><?php echo $val['Test']['test_parameter'];?></option>
				<?php }?>
			</select>
			
            <?php //echo $this->Html->link(,'/tests/health_collection', array('escape' => false));?>
            
            <?php echo $form->submit('frontend/go_button.jpg',array('alt'=>'Go','style'=>'margin-top: 10px; margin-left: 15px;'));?>
            <?php //echo $form->submit('', array('div'=>false, 'class' => 'right1')); ?>
            
            
            </div>
            <div id="beforeQue1" class="disNone" style="display:none">
            <select name="data[Profile][test_id]" class="selectBox" style="width:300px">
				<option value="">Select Profile</option>
				<?php foreach($profiles as $key => $val) {?>
				<option value="<?php echo $val['Test']['id'];?>"><?php echo $val['Test']['test_parameter'];?></option>
				<?php }?>
			</select>
            
            <?php //echo $this->Html->link($this->Html->image('frontend/go_button.jpg', array('alt'=>'Go','style'=>'margin-top: 10px; margin-left: 15px;')),'/tests/health_collection', array('escape' => false));?>
            <?php echo $form->submit('frontend/go_button.jpg',array('alt'=>'Go','style'=>'margin-top: 10px; margin-left: 15px;'));?>
            
            <?php //echo $form->submit('', array('div'=>false, 'class' => 'right1')); ?>
            <?php echo $form->end(); ?>
            </div>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Banner Part:End--> 
  
  <!--Body Part:Start-->
  <div id="bodyPart">
  <div style="margin-left: 161px;"><?php //echo $this->Session->flash(); ?></div>
    <div class="bodyInnerDiv">
      <div class="cont">
        <div class="leftPart">
		<div class="banner_sec">
		<div id="slider">
			<?php foreach($show_banner as $key => $val) {?>
			<div class="show_carousal"><?php echo $this->Html->link($this->Html->image(OFFER_IMAGE_THUMB_URL.$val['Banner']['banner_image'], array('alt'=>'Banner','width'=>522,'height'=>265)),'/tests/offers', array('escape' => false));?></div>
			<?php }?>
		</div>
		</div>
        <?php //echo $this->Html->link($this->Html->image('frontend/onlineOffer.gif', array('alt'=>'Banner')),'/tests/offers', array('escape' => false));?>
        <?php //echo $this->Html->image('frontend/onlineOffer.gif',array('alt'=>'Banner'))?></div>
        
        <div class="rightPart"><h3>ABOUT <span class="green">NIRAMAYA</span></h3><?php echo $this->Html->image('frontend/about-us-img.gif',array('alt'=>'About Us'))?>Niramaya Healthcare is a Noida based upcoming Diagnostic and Wellness service provider with presence in Noida and Ghaziabad (Indirampuram and Crossings Republik). We are committed to provide services of best quality ( in terms of accuracy, reliability, turnaround time as well as excellent customer care) at a very affordable cost.
        The Health check-up packages designed / developed by our team of experts, aims at preserving and promoting good health, preventing diseases and disabilities by facilitating early diagnosis. <span class="readMore"><?php echo $this->Html->link('Read More','/pages/company_overview');?></span> </div>
      </div>
      <div class="cont">
        <div class="testimonialBox">
          <h1>OUR <span class="green">TESTIMONIALS</span></h1><span class="readMore">
          <?php echo $this->Html->link('Read More','/pages/our_testimonial',array('style'=>'float:right; margin-top:9px;'));?>
          </span>
          <div class="testimonialDiv">
            <div class="box"> <?php echo $this->Html->image('frontend/testimononial-icon_female.gif',array('alt'=>'Img'))?>
            
              <div class="contDiv">
                <div class="name">Ms. Anita Kapoor</div>
                <p>"Niramaya runs an excellent online diagnosis service, Niramaya made it all so easy, they truly give one point solution for all the different tests."</p>
              </div>
            </div>
            <div class="box"> <?php echo $this->Html->image('frontend/testimononial-icon_female.gif',array('alt'=>'Img'))?>
                <div class="contDiv">
                <div class="name">Ms. Priya Sharma</div>
                <p>"Thanks to the service provided by Niramaya, all I need to worry about is recovering, and they take care of the diagnosis."</p>
              </div>
            </div>
          </div>
        </div>
        
        
        <div class="callBack">
          <h1>Give Me <span class="green">A CALL BACK</span></h1>
          <div class="formDiv">
           <div class="formArea">
		    <?php 
			if(!empty($cll_msg))
			{
			?>
			<div style="color:#000;"><?php echo $cll_msg;?></div>
			<?php 
			}
			?>
           <!--<div style="color:#F00;">thank u </div>-->
           <?php echo $form->create(null, array('url'=>'/pages/index/call_form','id'=>'form2','name'=>'form2','class'=>'marTopNone','onsubmit'=>'return validationc(this);')); ?>
           <?php echo $form->text('Call.name', array('class'=>'inputBox','value'=>'Please Enter Your name','onblur'=>'if(this.value=="")this.value="Please Enter Your name"',' onfocus'=>'if(this.value=="Please Enter Your name")this.value="";')); ?>
           <span id="msg1"></span>
           <?php echo $form->text('Call.phone', array('class'=>'inputBox','value'=>'Please Enter Your Mobile No.','onblur'=>'if(this.value=="")this.value="Please Enter Your Mobile No."',' onfocus'=>'if(this.value=="Please Enter Your Mobile No.")this.value="";')); ?>
           <span id="msg2"></span>
           <?php echo $form->textarea('Call.message', array('class'=>'textArea','value'=>'Please Enter Your Message','onblur'=>'if(this.value=="")this.value="Please Enter Your Message"',' onfocus'=>'if(this.value=="Please Enter Your Message")this.value="";')); ?>
           <span id="msg3"></span>
           
           <?php echo $form->submit('', array('div'=>false, 'class' => 'rightBotton')); ?>
                    <?php echo $form->end(); ?>
                    
           </div> 
            
          </div>
        </div>
      </div>
    </div>
  </div>