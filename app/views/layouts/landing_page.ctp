<?php
/* SVN FILE: $Id: default.thtml 4409 2007-02-02 13:20:59Z phpnut $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.view.templates.pages
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 4409 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-02-02 07:20:59 -0600 (Fri, 02 Feb 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo WEBSITE_TITLE.' - '.$title_for_layout;?></title>
<link rel="icon" type="img/ico" href="<?php echo SITE_URL;?>img/niramaya_fav_icon.png">
<script type="text/javascript">
var siteUrl = '<?php echo SITE_URL?>';
</script>

<?php echo $html->css('layout');?>
<?php echo $html->css('reset');?>
<?php //echo $javascript->link('script') ?>
<?php //echo $javascript->link('jquery-1.4.4') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php echo $javascript->link('scroll_image/jquery-1') ?>
<?php echo $javascript->link('jquery.easy-ticker') ?>



<script type="text/javascript">
var j = jQuery.noConflict();
j(function(){
j('.demo1').easyTicker({
    direction: 'up'
});

});</script>
<?php echo $javascript->link('scroll_image/jquery-ui-1') ?>
<?php echo $javascript->link('scroll_image/jquery_003') ?>
<?php echo $javascript->link('scroll_image/jquery_004') ?>
<?php echo $javascript->link('scroll_image/custom') ?>

<script type="text/javascript">
$(document).ready(function() {
	var curr_url = $(location).attr('href');
	var str = curr_url;
	
	var n = str.lastIndexOf('/');
	var result = str.substring(n + 1);
		if(result == '' || result == 'index')
	{
		$('#home').addClass('active');
		$('#aboutus').removeClass('active');
		$('#services').removeClass('active');
		$('#ouroffer').removeClass('active');
		$('#whyus').removeClass('active');
		$('#contact').removeClass('active');
	}
	if(result == 'company_overview')
	{
		$('#aboutus').addClass('active');
		$('#home').removeClass('active');
		$('#services').removeClass('active');
		$('#ouroffer').removeClass('active');
		$('#whyus').removeClass('active');
		$('#contact').removeClass('active');
	}
	if(result == 'vision_mission')
	{
		$('#aboutus').addClass('active');
		$('#home').removeClass('active');
		$('#services').removeClass('active');
		$('#ouroffer').removeClass('active');
		$('#whyus').removeClass('active');
		$('#contact').removeClass('active');
	}
	if(result == 'management_team')
	{
		$('#aboutus').addClass('active');
		$('#home').removeClass('active');
		$('#services').removeClass('active');
		$('#ouroffer').removeClass('active');
		$('#whyus').removeClass('active');
		$('#contact').removeClass('active');
	}
	if(result == 'individual_tests')
	{
		$('#services').addClass('active');
		$('#home').removeClass('active');
		$('#aboutus').removeClass('active');
		$('#ouroffer').removeClass('active');
		$('#whyus').removeClass('active');
		$('#contact').removeClass('active');
	}
	if(result == 'profile')
	{
		$('#services').addClass('active');
		$('#home').removeClass('active');
		$('#aboutus').removeClass('active');
		$('#ouroffer').removeClass('active');
		$('#whyus').removeClass('active');
		$('#contact').removeClass('active');
	}
	if(result == 'packages')
	{
		$('#services').addClass('active');
		$('#home').removeClass('active');
		$('#aboutus').removeClass('active');
		$('#ouroffer').removeClass('active');
		$('#whyus').removeClass('active');
		$('#contact').removeClass('active');
	}
	if(result == 'offers')
	{
		$('#ouroffer').addClass('active');
		$('#home').removeClass('active');
		$('#aboutus').removeClass('active');
		$('#services').removeClass('active');
		$('#whyus').removeClass('active');
		$('#contact').removeClass('active');
	}
	if(result == 'why_us')
	{
		$('#whyus').addClass('active');
		$('#home').removeClass('active');
		$('#aboutus').removeClass('active');
		$('#services').removeClass('active');
		$('#ouroffer').removeClass('active');
		$('#contact').removeClass('active');
	}
	
	if(result == 'contact')
	{
		$('#contact').addClass('active');
		$('#home').removeClass('active');
		$('#aboutus').removeClass('active');
		$('#services').removeClass('active');
		$('#ouroffer').removeClass('active');
		$('#whyus').removeClass('active');
		
	}
});

</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#boxTabs .contDivBox').hide();
$('#boxTabs .contDivBox:first').show();
$('#boxTabs dl dt:first').addClass('active');
$('#boxTabs dl dt').click(function(){
$('#boxTabs dl dt').removeClass('active');
$(this).parent().addClass('active');
var currentTab = $(this).attr('href');
$('#boxTabs .contDivBox').hide();
$(currentTab).show();
return false;
});
});
</script>
</head>
<body>
<!--ouer layout starts-->
<div id="outerContainer">   
  <!--Header:Start-->
  
  <div id="header">
    <div class="menuDiv">
      <div class="menuBox">
        <ol>
        
          <li id="home" class="bgNone"><?php echo $this->Html->link('Home','/');?></li>
          <li id="aboutus"><a href="#">About Us</a>
          <ul class="subMenu">
           	<li><?php echo $this->Html->link('Company Overview','/pages/company_overview');?></li>
			<li><?php echo $this->Html->link('Management Team','/pages/management_team');?></li>
            <li><?php echo $this->Html->link('Why Us','/pages/why_us');?></li>
			<li><?php echo $this->Html->link('Career','/pages/career');?></li>
			<li><?php echo $this->Html->link('Vision, Mission and Values','/pages/vision_mission');?></li>
                        <li><?php echo $this->Html->link('Our Clients','/home/our_clients');?></li>
          </ul>
          </li>
          <li id="services"><a href="#">Services</a>
          <ul class="subMenu">
           <li><?php echo $this->Html->link('Tests','/tests/individual_tests');?></li>
           <li><?php echo $this->Html->link('Profiles','/tests/profile');?></li>
           <li><?php echo $this->Html->link('nirAmaya Wellness Packages','/tests/packages');?></li>
		   <li><?php echo $this->Html->link('Home Sample Collection','/pages/sample_collection');?></li>
          </ul>
          </li>
          <li id="ouroffer"><?php echo $this->Html->link('Special Offers','/tests/offers');?></li>
          <li id="whyus"><?php echo $this->Html->link('Faq','/pages/faq');?></li>
          <li id="contact"><?php echo $this->Html->link('Contact Us','/pages/contact');?></li>
        </ol>
        <div class="poweredBy">
			<?php 
			if(!empty($UserId))
			{
			?>
			<span style="padding:0 0 0 5px; font-size:12px;"><a href="<?php echo SITE_URL;?>tests/my_cart">My Cart (<?php echo $test_cart_count;?>)</a> | <a href="<?php echo SITE_URL;?>tests/personal_detail">My Account</a></span>
			<?php 
			}
			else
			{
			$session_test = $this->Session->read('session_test');
			?>
				<?php 
				if(!empty($session_test))
				{
				?>
				<span style="padding:0 0 0 5px; font-size:12px;"><a href="<?php echo SITE_URL;?>tests/my_cart" style="color:#FF6600;">My Cart (<?php echo $test_cart_count;?>)</a></span>
				<?php 	
				}
				else
				{
				?>
				<?php echo $this->Html->image('frontend/header-inner-pgs-call-us.png',array('alt'=>'Powered By - PathCorp','style'=>'margin:7px 0 0 15px; float:left;'))?>
				<?php }?>
			<?php 
			}
			?>
        </div>
      </div>
    </div>
    <div class="menuBoxShadow"></div>
    <div class="newLogoSection">
      <div class="innerDiv">
      <a href="http://www.niramayahealthcare.com"><?php echo $this->Html->image('frontend/logo.png',array('alt'=>'nirAmaya Heath Care'))?></a>
      <div class="topBanner">
	  <div id="intro">
	  <ul>				
				<li> <?php echo $this->Html->image('change_index/top-banner-new.jpg',array('alt'=>'nirAmaya Heath Care'))?><a href="<?php echo SITE_URL;?>pages/become_doctor"><?php echo $this->Html->image('change_index/try-niramya-now.png',array('alt'=>'Try Niramya Now','class'=>'try'))?></a></li>
				<li> <?php echo $this->Html->image('change_index/top-banner-new-2.jpg',array('alt'=>'nirAmaya Heath Care'))?></li>
				<li> <?php echo $this->Html->image('change_index/top-banner-new-3.jpg',array('alt'=>'nirAmaya Heath Care'))?></li>
				<li> <?php echo $this->Html->image('change_index/top-banner-new-4.jpg',array('alt'=>'nirAmaya Heath Care'))?></li>
					
			</ul>
	  </div>
	  
      <?php //echo $this->Html->image('change_index/top-banner-new.jpg',array('alt'=>'nirAmaya Heath Care'))?>
      </div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
 
  <!--Body Part:Start-->
  <?php echo $content_for_layout; ?>
  <!--Body Part:End--> 
  
  <!--Footer Part:Start-->
  <div id="footer">
    <div class="footerTop">
      <div class="topInnerDiv">
        
		
        
        <div class="box marLeftNone">
          
          <h1>Company</h1>
          <ul>
            <li><?php echo $this->Html->link('About Us','/pages/company_overview');?></li>
            <li><?php echo $this->Html->link('Privacy Policy','/pages/privacy');?></li>
            <li><?php echo $this->Html->link('Quality Policy','/pages/quality_policy');?></li>
            <li><?php echo $this->Html->link('Terms & Refunds','/pages/terms_refunds');?></li>
          </ul>
          
        </div>
		<div  class="box">
          <h1>Need Help?</h1>
          <ul>
            
            <!--<li>Shop No. 08, LGF, Crossing Plaza,</li>-->
            <li><?php echo $this->Html->link('Order a Test','/tests/individual_tests');?></li>
            <li><?php echo $this->Html->link('Terms of Services','/pages/terms_of_service');?></li>
			<li><?php echo $this->Html->link('Lab Test Booking','/pages/faq');?></li>
			<!-- 29-05-14 Ashish Edited Starts -->
			<!--<li><a href="http://182.73.179.74/NPLONLINE/" target="_blank">Franchise Login</a></li>-->
			<li><a href="http://182.73.179.75:99/NPLOnline/" target="_blank">Franchise Login</a></li>
			<!-- 29-05-14 Ashish Edited Ends -->
          </ul>
        </div>
		<div  class="box">
          <h1>Services</h1>
          <ul>
            
            <!--<li>Shop No. 08, LGF, Crossing Plaza,</li>-->
            <li><?php echo $this->Html->link('Book Home Blood Sample collection','/pages/buy_home_blood_sample_collection');?></li>
            <li><?php echo $this->Html->link('Buy Executive Health Check Up','/tests/packages');?></li>
			<li><?php echo $this->Html->link('Buy Corporate Health Check up','/tests/health_check_up_corporate');?></li>
			 <li><?php echo $this->Html->link('Sitemap','/pages/sitemap');?></li>
          </ul>
        </div>
		
		<div class="box">
          
        <h1>Know Your Tests</h1> 
         <div style="margin:0 0 0 -8px;"><a href="http://labtestsonline.org/understanding/SearchForm?Search=&action_ProcessSphinxSearchForm=Go" target="_blank"><?php echo $html->image('frontend/niramaya-know-your-test.png',array('class'=>'know'));?></a></div></div>
        
        <div class="box">
		<h1>Contact Us</h1>
          <p><strong>NirAmaya PathLabs Private Limited</strong><br>
			B-4, New Multan Nagar, <br/>
(Near Paschim Vihar Metro )<br />
Pillor No. - 233 New Delhi-110056</p>
<div class="helpNo"> +91-9555009009</div>
<div class="emailID"><a href="mailto:helpline@niramayapathlabs.com">helpline@niramayapathlabs.com</a></div>
		</div>
        

      </div>
    </div>
    <div class="footerMid">
      <div class="innerDiv">
        <!--<div class="left">
          <ul>
            <li class="leftPadNone"><?php //echo $this->Html->link('Order a Test','/tests/individual_tests');?></li>
            <li><?php //echo $this->Html->link('Terms of Services','/pages/terms_of_service');?></li>
			<li class="borderNone"><?php //echo $this->Html->link('Lab Test Booking','/pages/faq');?></li>
          </ul>
        </div>-->
        <div class="socIcon">
        <a href="https://www.facebook.com/NiramayaHealthcare" target="_blank"><?php echo $html->image('frontend/social/fb_without_hover.png');?></a>
        <a href="https://twitter.com/Niramaya_Care" target="_blank"><?php echo $html->image('frontend/social/twitter_without_hover.png');?></a>
       	<a href="http://www.linkedin.com/in/niramayahealthcare" target="_blank"><?php echo $html->image('frontend/social/linkedin_without_hover.png');?></a>
        <a href="https://plus.google.com/105020569213911001058/posts" target="_blank"><?php echo $html->image('frontend/social/g+_without_hover.png');?></a>
        
        </div>
        
      
      </div>
    </div>
    
    <div class="footerBottom">
      <div class="bottomInnerDiv">
        <div class="left">Copyright &copy; Niramaya Health Care.com. All Rights Reserved</div>
        <div class="right">Designed and Developed By <a target="_blank" href="http://www.itcombine.com">ITCombine</a></div>
      </div>
    </div>
  </div>
  <!--Footer Part:End-->
  <?php echo $javascript->link('jquery-1.4.4.js'); ?>
<?php echo $javascript->link('jquery_002.js'); ?>
  
  
</div>
<!--outer layout ends-->
<script type="text/javascript">
(function($){

	$('#intro ul:first').cycle({
		pager:			'#intro .pagination',
		slideResize:	0,
		timeout:		6000
	});
})(window.jQuery);
</script> 
</body>
</html>


