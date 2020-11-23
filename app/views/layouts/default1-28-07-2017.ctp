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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


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
<?php echo $html->css('layout1');?>
<?php echo $html->css('reset');?>
<?php echo $html->css('skdslider');?>
<?php echo $html->css('jquery.bxslider');?>
<?php echo $html->css('style2');?>
</head>

<body>
<div class="social-icons-cantt">
        <ul>
          <li><a href="https://www.facebook.com/NiramayaHealthcare" target="_blank"><?php echo $this->Html->image('fb.png',array('alt'=>'Facebook','title'=>'Facebook'))?></a></li>
          <li><a href="https://twitter.com/Niramaya_Care"  target="_blank"><?php echo $this->Html->image('tw.png',array('alt'=>'twitter','title'=>'twitter'))?></a></li>
          <li><a href="http://www.linkedin.com/in/niramayahealthcare" target="_blank"><?php echo $this->Html->image('in.png',array('alt'=>'Linkedin','title'=>'Linkedin'))?></a></li>
          <li><a href="https://plus.google.com/105020569213911001058/posts" target="_blank"><?php echo $this->Html->image('g+.png',array('alt'=>'Google Plus','title'=>'Google Plus'))?></a></li>
          <!--<li><a href="http://www.niramayahealthcare.com/pages/testimonials"><?php echo $this->Html->image('testimonial-img.png',array('alt'=>'Testimonials','title'=>'Testimonials'))?></a></li>-->
        </ul>
      </div>
<style type="text/css">
.social-icons-cantt ul li:last-child {
     margin-left: 0%; 
     margin-top: 0%; 
}
</style>
<div id="outerContainer"> 
  <!--Header:Start-->
  <div id="header">
    <div class="menuDiv">
      <div class="menuBox">
        <ol>
          <li id="home" class="bgNone"><a class="active" href="<?php echo SITE_URL;?>"><?php echo $this->Html->image('home-icon-hover.png',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'))?></a></li>
		  <li id="aboutus"><a href="javascript:void(0);"> About Us</a>
            <ul class="subMenu">
              <li><?php echo $this->Html->link('Company Overview','/pages/company_overview');?></li>
              <li><?php echo $this->Html->link('Why Us','/pages/why_us');?></li>
              <li><?php echo $this->Html->link('Vision, Mission and Values','/pages/vision_mission');?></li>
              <li><?php echo $this->Html->link('Our Clients','/home/our_clients');?></li>
			  <li><?php echo $this->Html->link('Career','/pages/career');?></li>
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
		  <li id="ouroffer"><a href="javascript:void(0);">Special Offers</a>
		  <ul class="subMenu">
              <li><?php echo $this->Html->link('nirAmaya Preventive Health Check Up Packages','/packagelists/package');?></li>
              <li><?php echo $this->Html->link('Special Offers','/tests/offers');?></li>
              </ul>
			</li>
          <li id="whyus"><?php echo $this->Html->link('Our Centers','/pages/contact');?></li>
		  <li id="contact"><?php echo $this->Html->link('Quality','/pages/quality_policy');?></li>
          <li id="contact"><?php echo $this->Html->link('FAQ','/pages/faq');?></li>
        </ol>
      <div class="poweredBy">
	  <?php 
			if(!empty($UserId))
			{
			?>
			<span style="float: right; font-size: 14px; margin: 10px 0 0 18px;"><a href="<?php echo SITE_URL;?>tests/my_cart">My Cart (<?php echo $test_cart_count;?>)</a> | <a href="<?php echo SITE_URL;?>tests/personal_detail">My Account</a></span>
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
				<?php echo $this->Html->image('header-inner-pgs-call-us.png',array('alt'=>'Powered By - PathCorp','style'=>'margin:7px 0 0 15px; float:left;'))?>
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
        <div class="logo"><a href="<?php echo SITE_URL;?>"><?php echo $this->Html->image('logo1.png',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'))?></a></div>
       <div class="logoright"><a onclick="window.open('http://www.niramayahealthcare.com/registration_ad1.php','anab','location=no, menubar=no, resizable=no, width=1250, scrollbars=yes, height=950');"><?php echo $this->Html->image('nabl.png',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare','class'=>'rightText'))?></a> </div>
      </div>
    </div>
  </div>
  <!--Header:End-->
  <!--Banner Part:Start-->
  <section id="slider">
    <div class="banner-container">
      <ul class="bxslider" id="slider2">
          <li><?php echo $this->Html->image('Niramaya-Home-Page-banner-1.jpg',array('alt'=>'Banner1'))?></li>
         <li><?php echo $this->Html->image('Niramaya-Home-Page-banner-2.jpg',array('alt'=>'Banner2'))?></li>
		 <li><?php echo $this->Html->image('Niramaya-Home-Page-banner-4.jpg',array('alt'=>'Banner3'))?></li>
		 <li><?php echo $this->Html->image('Niramaya-Home-Page-banner-5.jpg',array('alt'=>'Banner4'))?></li>
		 <li><?php echo $this->Html->image('Niramaya-Home-Page-banner-6.jpg',array('alt'=>'Banner5'))?></li>
       </ul>
    </div>
  </section>
  <!--Header:Start-->
  
  
  
  <!--Header:End--> 
 <!--Banner Part:Start-->
  
  
  <!--Banner Part:End--> 
  
  <!--Banner Part:Start-->
  <div class="search-box">
  <?php echo $content_for_layout; ?>
   
  <!--Body Part:End--> 
   <!--Footer Part:Start-->
   
   <div id="footer">
    <div class="footerTop">
      <div class="topInnerDiv">
        <div class="box">
		 <h1>Company</h1>
          <ul>
		  <li><?php echo $this->Html->link('About Us','/pages/company_overview');?></li>
            <li><?php echo $this->Html->link('Privacy Policy','/pages/privacy');?></li>
            <li><?php echo $this->Html->link('Quality Policy','/pages/quality_policy');?></li>
			<li><?php echo $this->Html->link('Terms & Refunds','/pages/terms_refunds');?></li>
			<li><?php echo $this->Html->link('Contact Us','/pages/contact');?></li>
			<li><?php echo $this->Html->link('FAQs','/pages/faq');?></li>
            </ul>
		</div>
		<div class="box">
          <h1>Need Help?</h1>
          <ul>
		  <li><?php echo $this->Html->link('Order a Test','/tests/individual_tests');?></li>
            <li><?php echo $this->Html->link('Terms of Services','/pages/terms_of_service');?></li>
			<li><?php echo $this->Html->link('Lab Test Booking','/pages/faq');?></li>
			<li><a href="http://103.48.196.204:99/NPLOnline/" target="_blank">Franchise Login 1</a></li>
			<li><a href="http://182.73.179.75:99/NPLOnline/" target="_blank">Franchise Login 2</a></li>
			
			
            </ul>
        </div>
		<div class="box">
          <h1>Know Your Tests</h1>
		  <div><a href="http://labtestsonline.org/understanding/SearchForm?Search=&action_ProcessSphinxSearchForm=Go" target="_blank"><?php echo $html->image('niramaya-know-your-test.png');?></a></div>
		  
		  
		  
        </div>
		<div class="box">
          <h1>Contact Us</h1>
          <p class="map"><strong>NirAmaya PathLabs Private Limited</strong><br>
            B-4, New Multan Nagar, <br>
            (Near Paschim Vihar Metro )<br>
            Pillor No. - 233 New Delhi-110056</p>
          <div class="helpNo"> +91-9555009009</div>
          <div class="emailID"><a href="mailto:helpline@niramayapathlabs.com">helpline@niramayapathlabs.com</a></div>
        </div>
		<div class="box" id="ViewReportFooter">
          <h1>View Report</h1>
          <a class="fr loginfooter" href="javascript:void(0);" onClick="login_window_footer('customer');">Patient Login</a>
		  <form method="post" action="<?php echo SITE_URL;?>pages/login_report" class="wid246">
				<h6 class="marbottom">Use your registered Phone No. as username and Test RequestID as password</h6>
				<input type="text" name="data[ViewReport][username]" class="footertextBox" placeholder="Enter Username" />
				<input type="password" name="data[ViewReport][password]" class="footertextBox" placeholder="Enter Request Number" />
				<button class="footerbutton" type="submit">Submit Here</button>
			</form>
           </div>
		<div class="box" id="CustomerFooter" style="display:none;">
          <h1>Patient Login</h1>
          <a class="fr loginfooter" href="javascript:void(0);" onClick="login_window_footer('viewreport');">View Report</a>
		  <?php echo $form->create(null, array('url'=>'/pages/login','id'=>'form3','name'=>'form3','class'=>'wid246','onsubmit'=>'return validationcc(this);')); ?>
			   <h6 class="marbottom">Use your emailID or mobile number as your username</h6>     
            <?php echo $form->text('Login.username', array('class'=>'footertextBox','value'=>'Please Enter Email/Phone','onblur'=>'if(this.value=="")this.value="Please Enter Email/Phone"',' onfocus'=>'if(this.value=="Please Enter Email/Phone")this.value="";')); ?>
			<?php echo $form->password('Login.pass', array('class'=>'footertextBox','value'=>'password','onblur'=>'if(this.value=="")this.value="password"',' onfocus'=>'if(this.value=="password")this.value="";')); ?>
              <button class="footerbutton" type="submit">Submit Here</button>
                  <?php echo $form->end(); ?>
          
        </div>
		
		</div>
		</div>
		<div class="footerBottom">
      <div class="bottomInnerDiv">
        <div class="left">Copyright &copy; Niramaya Health Care.com. All Rights Reserved</div>
        <div class="right">Designed and Developed By <a href="http://www.itcombine.com/" target="_blank">ITCombine</a></div>
      </div>
    </div>
		</div>
   
   
</div>

<?php echo $this->element('sql_dump');?>
<?php echo $javascript->link('jquery-2.1.1.js'); ?>
<?php echo $javascript->link('jquery.lazyload.js'); ?>
<?php echo $javascript->link('skdslider.min.js'); ?>
<?php echo $javascript->link('jquery.bxslider.min.js'); ?>
<?php echo $javascript->link('jquery.flexisel.js'); ?>
<?php echo $javascript->link('script.js'); ?>
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

<!--chat plugin-->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/58ecc996f7bbaa72709c5a95/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->   
</body>
</html>

