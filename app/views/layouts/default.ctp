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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">


<title><?php echo WEBSITE_TITLE.' - '.$title_for_layout;?></title>
<meta name="description" content="<?php echo $page_description;?>" />
<meta name="keywords" content="<?php echo $page_keyword;?>" />
<link rel="icon" type="img/ico" href="<?php echo SITE_URL;?>img/niramaya_fav_icon.png">
<link rel="publisher" href="https://plus.google.com/105020569213911001058">
<link rel="author" href="https://plus.google.com/108695454897784287736">

<link rel="publisher" href="https://plus.google.com/116469312113587069343"/>
<link rel="publisher" href="https://plus.google.com/102198367856405173894"/>
<script type="text/javascript">
var siteUrl = '<?php echo SITE_URL?>';
</script>
<?php echo $html->css('layout');?>
<?php echo $html->css('reset');?>
<?php echo $javascript->link('scroll_image/jquery-1') ?>
<?php echo $javascript->link('jquery.easy-ticker') ?>
<?php echo $html->css('layout1');?>
<?php echo $html->css('responsive');?>
<?php echo $html->css('skdslider');?>
<?php echo $html->css('jquery.bxslider');?>
<?php echo $html->css('style2');?>
<?php echo $html->css('res_menu');?>


<script type="text/javascript">
var j = jQuery.noConflict();
j(function(){
j('.demo1').easyTicker({
    direction: 'up'
});

});
</script>
<?php echo $javascript->link('scroll_image/jquery-ui-1') ?>
<?php echo $javascript->link('scroll_image/jquery_003') ?>
<?php echo $javascript->link('scroll_image/jquery_004') ?>
<?php echo $javascript->link('scroll_image/custom') ?>
</head>

<body>
<div id="outerContainer"> 
  
  <!--Header:Start-->
  
  <div id="header">
    <div class="menuDiv">
      <div class="menuBox">
        <ol>
        
          <li id="home" class="bgNone"><?php echo $this->Html->link('Home','/');?></li>
          <li id="aboutus"><a href="javascript:void(0);">About Us</a>
          <ul class="subMenu">
          	<li><?php echo $this->Html->link('Company Overview','/pages/company_overview');?></li>
			<li><?php echo $this->Html->link('Why Us','/pages/why_us');?></li>
			<li><?php echo $this->Html->link('Career','/pages/career');?></li>
            <li><?php echo $this->Html->link('Vision, Mission and Values','/pages/vision_mission');?></li>
            <li><?php echo $this->Html->link('Our Clients','/home/our_clients');?></li>
          </ul>
          </li>
          <li id="services"><a href="javascript:void(0);">Services</a>
          <ul class="subMenu">
           <li><?php echo $this->Html->link('Tests','/tests/individual_tests');?></li>
           <li><?php echo $this->Html->link('Profiles','/tests/profile');?></li>
           <li><?php echo $this->Html->link('nirAmaya Preventive Health Check Up Packages','/packagelists/package');?></li>
		   <li><?php echo $this->Html->link('Patient Care Services','/tests/services');?></li>
           <li><?php echo $this->Html->link('Corporate Health Checkup','/tests/health_check_up_corporate');?></li>
           <li><?php echo $this->Html->link('Home Sample Collection','/pages/buy_home_blood_sample_collection');?></li>                        
            </ul>
          </li>
          <li id="ouroffer"><?php echo $this->Html->link('Special Offers','/tests/offers');?></li>
          <li id="whyus"><?php echo $this->Html->link('FAQ','/pages/faq');?></li>
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
				<span style="padding:6px; float:left; font-size:12px;"> <a href="<?php echo SITE_URL;?>tests/my_cart" style="color:#FF6600;">My Cart (<?php echo $test_cart_count;?>)</a></span>
				<?php 	
				}
				else
				{
				if(!empty($DoctorId))
				{
				?>
					<span style="padding:6px; float:left; font-size:12px;"><a href="<?php echo SITE_URL;?>pages/doctor_account" style="color:#FF6600;">My Account</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?php echo SITE_URL;?>pages/doctor_change_password" style="color:#FF6600;">Change Password</a></span>
				<?php 
				}
				else
				{
				?>
				<?php echo $this->Html->image('frontend/header-inner-pgs-call-us.png',array('alt'=>'Powered By - PathCorp','style'=>'margin:7px 0 0 15px; float:left;'))?>
				<?php }}?>
			<?php 
			}
			?>
        </div>
      </div>
    </div>
        <div class="menuBoxShadow"></div>
    <div class="logoSection">
      <div class="innerDiv">
        <div class="logo" style="margin:15px 0 0 0;"><a href="<?php echo SITE_URL;?>"><?php echo $this->Html->image('frontend/logo.png',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'))?></a></div>
		
		<div class="logoright"><?php echo $this->Html->image('frontend/home-page-call-us.jpg',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare','class'=>'left'))?>
		<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=650,width=930,left=220,top=40,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}
</script>
<!--<a href="JavaScript:newPopup('http://www.niramayahealthcare.com/registration_ad.php');"><img src="http://www.niramayahealthcare.com/img/frontend/banner-option-2.jpg" class="rightText" alt="nirAmaya Heathcare" title="nirAmaya Heathcare"></a>-->
<a onclick="window.open('http://www.niramayahealthcare.com/registration_ad.php','anab','location=no, menubar=no, resizable=no, width=1000, scrollbars=yes, height=900');"><img src="http://www.niramayahealthcare.com/img/frontend/banner-option-2.jpg" class="rightText" alt="nirAmaya Heathcare" title="nirAmaya Heathcare"></a>
		<?php //echo $html->image('frontend/home_pg_top_right_banner.png',array('class'=>'rightText','alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'));?>
        <!--<div class="simply-scroll-list marqDiv" id="scroller1">
        
        <p>Niramaya healthcare is organizing health Check-up camp at Birlasoft, Noida on 17th & 18th December 2013.&nbsp;&nbsp;&nbsp;&nbsp;</p>
        
        
        </div>-->
      </div>
        
      </div>
    </div>
  </div>
  <!--Header:End--> 
 <!--Banner Part:Start-->
  <div id="banner">
    <div class="bannerInnerDiv">
      <div class="bannerbox">
	  <div id="intro">
			<ul>	
			<!--<li> <?php echo $this->Html->image('frontend/niramaya_banner_6.png',array('alt'=>'Banner'))?></li>	-->		
				<li> <?php echo $this->Html->image('frontend/niramaya_banner_1.png',array('alt'=>'Banner'))?></li>
				<li> <?php echo $this->Html->image('frontend/niramaya_banner_2.png',array('alt'=>'Banner'))?></li>
				<li> <?php echo $this->Html->image('frontend/niramaya_banner_3.png',array('alt'=>'Banner'))?></li>
				<li> <?php echo $this->Html->image('frontend/niramaya_banner_4.png',array('alt'=>'Banner'))?></li>
             	 <li> <?php echo $this->Html->image('frontend/niramaya_banner_5.png',array('alt'=>'Banner'))?></li>		
			</ul>
            <div class="pagination">
 

  </div>
		</div>
      </div>
    </div>
  </div>
  
  <!--Banner Part:End--> 
  
  <!--Banner Part:Start-->
  <div id="packages">
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
			<!--<li><a href="http://182.73.242.9/" target="_blank">Franchise Login</a></li>-->
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
  
  
</div>

<?php echo $this->element('sql_dump');?>
<?php echo $javascript->link('jquery-1.4.4.js'); ?>
<?php echo $javascript->link('jquery_002.js'); ?>

<!--<div id="Accordion1" class="Accordion" tabindex="0">
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Label 1</div>
    <div class="AccordionPanelContent">Content 1</div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Label 2</div>
    <div class="AccordionPanelContent">Content 2</div>
  </div>
</div>-->
<script type="text/javascript">
(function($){

	$('#intro ul:first').cycle({
		pager:			'#intro .pagination',
		slideResize:	0,
		timeout:		6000
	});
})(window.jQuery);
</script> 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45577171-1', 'niramayahealthcare.com');
  ga('send', 'pageview');

</script>
   
</body>
</html>

