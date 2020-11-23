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
          <div class="bread"><?php echo $this->Html->link('Become Doctor','/pages/thankyou/'.$last_id.'/'.$real_pass);?></div>
        </div>
        
      </div>
      <h1>Doctor <span class="green">Registration</span></h1>
     
      <p style="text-align:left;">Thankyou for registering yourself as a doctor a confirmation email has been sent on your email (<?php echo $email;?>).</p>
	  <p style="text-align:left;">Please confirm your registration by clicking on confirmation link send on your email.</p>
	  <p style="text-align:left;">There are additinal benefits for Doctors who are registered as "Featured Doctors".</p>
	  <p style="text-align:left;">To explore the benefits as a Featured Doctor, click on button below</p>
	  <p><a href="<?php echo SITE_URL;?>pages/feature_page/<?php echo $last_id;?>/<?php echo $real_pass;?>"><?php echo $html->image('upgrade-to-featured-listing-button.jpg',array('style'=>'margin:0 0 -10px 0;'));?></a></p>
      
      <div class="bottomShadow"></div>
    </div>
  </div>
  <!--Body Part:End--> 