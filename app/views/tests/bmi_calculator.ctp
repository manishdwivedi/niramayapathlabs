<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
function show_tab(val)
{
	if(val == 'sample')
	{
		document.getElementById('SampleRequest').style.display = 'block';
	}
	
	if(val == 'loggedout')
	{
		window.location.href = siteUrl+'tests/logout';
	}
}
</script>

<script type="text/javascript">
		function validation()
		{
			var str = true;
			
			document.getElementById('msg1').innerHTML = '';
			document.getElementById('msg2').innerHTML = '';
			document.getElementById('msg4').innerHTML = '';
			document.getElementById('msg5').innerHTML = '';
			document.getElementById('msg100').innerHTML = '';
			
			if((document.getElementById('BMICalculatorSelectOption1').checked == false) && (document.getElementById('BMICalculatorSelectOption2').checked == false))
			{
				document.getElementById('msg4').innerHTML = 'Please select option of your height';
				str = false;
			}
			if(isNaN(document.formbmi.BMICalculatorWeight.value))
			{
				document.getElementById('msg1').innerHTML = 'Please enter only numeric digits';
				str = false;
			}
			else if(document.formbmi.BMICalculatorWeight.value=='')
			{
				document.getElementById('msg1').innerHTML = 'Please enter weight in KG';
				str = false;
			}
			if(document.getElementById('HeightFeet').style.display == 'block')
			{
				if(document.formbmi.BMICalculatorHeightFeet.value=='')
				{
					document.getElementById('msg2').innerHTML = 'Please enter your height in feet';
					str = false;
				}
				else if(isNaN(document.formbmi.BMICalculatorHeightFeet.value))
				{
					document.getElementById('msg2').innerHTML = 'Please enter only numeric digits';
					str = false;
				}
				if(document.formbmi.BMICalculatorHeightInch.value=='')
				{
					document.getElementById('msg100').innerHTML = 'Please enter your height in inches';
					str = false;
				}
				else if(isNaN(document.formbmi.BMICalculatorHeightInch.value))
				{
					document.getElementById('msg100').innerHTML = 'Please enter only numeric digits';
					str = false;
				}
			}
			if(document.getElementById('Heightcms').style.display == 'block')
			{
				if(isNaN(document.formbmi.BMICalculatorHeightCms.value))
				{
					document.getElementById('msg5').innerHTML = 'Please enter only numbers';
					str = false;
				}
				if(document.formbmi.BMICalculatorHeightCms.value=='')
				{
					document.getElementById('msg5').innerHTML = 'Please enter your height in cms';
					str = false;
				}
			}
			return str;
		}
		
		function validationbp()
		{
			var str = true;
			
			document.getElementById('msg3').innerHTML = '';
			document.getElementById('msg6').innerHTML = '';
			document.getElementById('msg7').innerHTML = '';
			
			if(document.formbp.BPBpSystolic.value=='')
			{
				document.getElementById('msg3').innerHTML = 'Please enter systolic value';
				str = false;
			}
			else if(document.formbp.BPBpSystolic.value!='')
			{
				document.getElementById('msg3').innerHTML = '&nbsp;';
			}
			if(document.formbp.BPBpDiastolic.value=='')
			{
				document.getElementById('msg6').innerHTML = 'Please enter diastolic value';
				str = false;
			}
			else if(document.formbp.BPBpDiastolic.value!='')
			{
				document.getElementById('msg6').innerHTML = '&nbsp;';
			}
			if(document.formbp.BPBpPulse.value=='')
			{
				document.getElementById('msg7').innerHTML = 'Please enter pulse rate';
				str = false;
			}
			else if(document.formbp.BPBpPulse.value!='')
			{
				document.getElementById('msg7').innerHTML = '&nbsp;';
			}
			return str;
		}
		
		function show_option(val)
		{
			if(val == 'feet')
			{
				document.getElementById('HeightFeet').style.display = 'block';
				document.getElementById('Heightcms').style.display = 'none';
			}
			if(val == 'cms')
			{
				document.getElementById('Heightcms').style.display = 'block';
				document.getElementById('HeightFeet').style.display = 'none';
			}
		}
		</script>
	<?php echo $html->css('bmi_calc/lightbox');?>
	<?php echo $javascript->link('bmi_calc/lightbox-2.6.min');?>
<style type="text/css">
#bodyPart .bodyInnerDiv .formDiv {
    float: left;
    width: 100%;
}
</style>
	<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  	<div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread"><?php echo $this->Html->link('BMI Calculator','/tests/bmi_calculator');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
      <h1>Calculate Your <span class="green">Body Mass Index</span></h1>
      <div class="bmiCalc">
        <div class="leftPart">
          <div class="text">Body mass index (BMI) is a measure of body fat based on height and weight that applies to adult men and women.</div>
          <div class="box">
            <div class="greenBorder">
			<?php if(empty($bmi_value) && empty($bmi_indicator)) {?>
			<?php echo $form->create(null,array('url'=>'/tests/bmi_calculator/bmi_calc','id'=>'formbmi','name'=>'formbmi','onsubmit'=>'return validation(this);'));?>
              <div class="boxinner">
                <h4>Enter Your Measurements:</h4>
				<div class="rowDivb">
                  <label>Your Height in</label>
                  <div class="fl">
                    <input type="radio" name="data[BMICalculator][select_option]" value="1" id="BMICalculatorSelectOption1" onclick="show_option('feet');" />&nbsp;Feet&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[BMICalculator][select_option]" value="2" id="BMICalculatorSelectOption2" onclick="show_option('cms');" />&nbsp;CMs
					<br /><span id="msg4"></span>
                  </div>
                </div>
				<div class="rowDivb" id="Heightcms" style="display:none;">
                  <label>Height in CMs</label>
                  <div class="fl">
                    <?php echo $form->text('BMICalculator.height_cms',array('placeholder'=>'Enter Height in CMs'));?>
					<br /><span id="msg5"></span>
                  </div>
                </div>
                <div class="rowDivb" id="HeightFeet" style="display:none;">
                  <label>Height in Feet</label>
                  <div class="fl">
                    <?php echo $form->text('BMICalculator.height_feet',array('placeholder'=>'Enter Height in Feet'));?>
					<span id="msg2"></span>
                    </div>
                  <div class="fr">
                    <?php echo $form->text('BMICalculator.height_inch',array('placeholder'=>'Enter Height in Inch'));?>
					<span id="msg100"></span>
                  </div>
                </div>
                <div class="rowDivb">
                  <label>Your Weight</label>
                  <div class="fl">
                    <?php echo $form->text('BMICalculator.weight',array('placeholder'=>'Enter Weight in KG'));?>
					<span id="msg1"></span>
                  </div>
                  <div class="fr"><input type="image" src="<?php echo SITE_URL;?>img/bmi_calc/calculate-bmi-button.jpg" /></div>
                </div>
				<div class="rowDivb" style="height:10px;">For individuals in the height range of 5 to 6.4 Feet</div>
              </div>
			  <?php echo $form->end();?>
			  <?php } else {?>
              <!--Result:Start-->
              <?php echo $form->create(null,array('url'=>'/tests/bmi_calculator/bp_calc','id'=>'formbp','name'=>'formbp','onsubmit'=>'return validationbp(this);'));?>
			  <?php echo $form->hidden('BP.bmi_value',array('value'=>$bmi_value));?>
			  <?php echo $form->hidden('BP.bmi_indicator',array('value'=>$bmi_indicator));?>
              <div class="boxinner">
                <h4>Your Body Mass Index:</h4>
                <div class="rowDivbNext">
                  <div class="leftPartDiv">
				  <?php if(!empty($enter_height_feet) && !empty($enter_height_inch)) {?>
				  The Height you entered is <b><?php echo $enter_height_feet;?> feet, <?php echo $enter_height_inch;?> inches</b>.<br/>
				  <?php }?>
				  <?php if(!empty($enter_height_cm)) {?>
				  The Height you entered is <b><?php echo $enter_height_cm;?> CM</b>.<br/>
				  <?php }?>
                    The Weight you entered is <b><?php echo $enter_height_weight;?> kilograms</b>.</div>
                  <div class="rigfhtPartDiv">
                    <p>Your BMI is :</p>
                    <div class="bmiTab" <?php echo $background_color;?>><?php echo $bmi_value;?></div>
					<?php if(!empty($bmi_indicator)) {?>
					<p style="width:290px; text-align:left;"><span style="font-weight:normal; color:#5C5C5C;">This is in the</span> <?php echo $bmi_indicator;?> <span style="font-weight:normal; color:#5C5C5C;">range.</span></p>
					<?php }?>
					<?php if(!empty($ideal_weight)) {?>
					<p style="width:290px; text-align:left;"><span style="font-weight:normal; color:#5C5C5C;">Your ideal weight is</span> <?php echo $ideal_weight;?></p>
					<?php }?>
                  </div>
                </div>
              </div>
              
              <!--Result:End--> 
              <?php }?>
            </div>
          </div>
		  <?php if(!empty($bmi_value) && !empty($bmi_indicator)) {?>
          <div class="bpDiv">
            <p class="divText">Save this to your records along with your <b>BP value:</b></p>
			<div style="float:left;">
            <?php echo $form->text('BP.bp_systolic',array('placeholder'=>'Systolic'));?>
			<?php echo $form->text('BP.bp_diastolic',array('placeholder'=>'Diastolic'));?>
			<?php echo $form->text('BP.bp_pulse',array('placeholder'=>'Enter Pulse rate'));?>
			<div id="msg3" style="color:#840808; clear:both; float:left; padding:0 0 0 10px; width:158px;"></div>
			<div id="msg6" style="color:#840808; float:left; padding:0 0 0 21px; width:158px;"></div>
			<div id="msg7" style="color:#840808; float:left; padding:0 0 0 20px; width:158px;"></div>
            <input type="image" src="<?php echo SITE_URL;?>img/bmi_calc/save-button.jpg" /></div>
			</div>
			<?php echo $form->end();?>
			<?php }?>  
        </div>
        
        
        
        <a class="example-image-link" href="<?php echo SITE_URL;?>img/bmi_calc/light-box-img.jpg" data-lightbox="example-1"><?php echo $html->image('bmi_calc/right-img.jpg',array('class'=>'fr'));?></a> </div>
    
      	
	  	
  </div>