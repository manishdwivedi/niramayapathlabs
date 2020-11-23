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

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title><?php echo WEBSITE_TITLE.' - '.isset($title_for_layout)?$title_for_layout:'';?></title>
<meta name="description" content="<?php echo isset($page_description)?$page_description:'';?>" />
<meta name="keywords" content="<?php echo isset($page_keyword)?$page_keyword:'';?>" />
<link rel="icon" type="img/ico" href="<?php echo SITE_URL;?>img/niramaya_fav_icon.png">
<link rel="publisher" href="https://plus.google.com/105020569213911001058">
<link rel="author" href="https://plus.google.com/108695454897784287736">
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"> </script><![endif]-->
<meta charset="ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,700|Roboto:300,400,500,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<?php echo $html->css('css/custom.css'); ?>
<?php echo $html->css('css/responsive.css'); ?>
<style>
    .reportbox-fields{
        margin-top:20px;
    }
    
    nav ul li a {
    color: #212121;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 1px;
    padding-bottom: 0px;
    margin-right: 60px;
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php echo $html->css('css/niramaya.css'); ?>
<?php echo $javascript->link('js/jquery-scrolltofixed.js'); ?>
<?php echo $javascript->link('js/slick.js'); ?>
<?php echo $javascript->link('js/jquery.cookie.js'); ?>
<?php echo $javascript->link('js/home.js'); ?>
<?php echo $html->css('jquery/ui-lightness/jquery-ui');?>
<script type="text/javascript">
function show_box()
{
    $('.afterlogin-box').stop().slideToggle();
}

var siteUrl = '<?php echo SITE_URL?>';

function show_tab(val)
{
	if(val == 'sample')
	{
		document.getElementById('SampleRequest').style.display = 'block';
	}
	
	if(val == 'loggedout')
	{
		window.location.href = 'https://www.niramayahealthcare.com/tests/logout';
	}
}

</script>
</head>
<body id="mBody">
<div id="main-wraphome">
<!--header-->
<header>
    <section class="header-inner-home">
        <div class="smallmenu">&#9776;</div>
        <aside class="homelogo">
            <a href="<?php echo SITE_URL;?>"><?php echo $this->Html->image('img/logo.png',array('alt'=>'Niramaya PathLab', 'class'=>'scale'))?></a>
        </aside>
        <div class="home-searchbar">
        <?php echo $form->create(null, array('url'=>'/tests/search_keyword_home','id'=>'form1','name'=>'form1')); ?>
            <div class="location-search"><a href="javascript://" id="cityNameH" style='text-transform:capitalize'>Select City</a></div>
            <div class="location-list-wrap">
                <ul class="location-list" id="mainCity">
                    <li><a href="" onclick="createCookie('delhi');">Delhi</a></li>
                    <li><a href="" onclick="createCookie('gurugram');">Gurugram</a></li> 
                    <li><a href="" onclick="createCookie('noida');">Noida</a></li> 
                    <li><a href="" onclick="createCookie('ghaziabad');">Ghaziabad</a></li> 
                    <li><a href="" onclick="createCookie('faridabad');">Faridabad</a></li> 
                </ul>
            </div>
            <div class="searchbar-top">
            	<?php echo $form->text('Search.test_search',array('class'=>'searchbar-top-style','placeholder'=>'Search for a Test, Health Package, Lab Address', 'autocomplete'=>'off'));?>
               <?php echo $this->Html->image('img/search-img5.jpg',array('alt'=>'Niramaya PathLab', 'align'=>'absmiddle', 'border'=>'0', 'class'=>'homesearch'))?>
                <?php echo $form->button('', array('class' => 'homesearch' )); ?>
               
            </div>
            <div class="clr"></div>
        </form>
        </div>
        <aside class="homeright-wrap">
            <div class="topicons">
                <div class="clr"></div>
            </div>
            <div class="login-mobilewrap">
                <div class="mobile-link">
                    <a href="https://api.whatsapp.com/send?phone=+917042191851" method="get" target="_blank"><i class="fa fa-2x fa-whatsapp"></i></a> 
                    <a href="tel:+91-7042191851" class="mobhide" style="padding-top: 6px;"> +91-7042191851</a>
                    <a href='<?php echo SITE_URL;?>tests/my_cart' class="cart"><i class="fa fa-2x fa-shopping-cart"></i><div class="cartvalue" id="cartATag"><?php echo $test_cart_count;?></div>
                        </a>
                    <?php if(!empty($UserId)) { ?>
					
                    <span class="user-afterlogin" onclick="show_box();"><span><i class="fa fa-2x fa-user-circle-o"></i> <i class="fa fa-2x fa-bars" style="color: #a09e9e;"></i></span>
                    <div class="afterlogin-box">
                        <div class="afterlog-links">
                            <?php echo $html->link('Personal Details',array('controller'=>'tests','action'=>'personal_detail'));?>
                           <?php echo $html->link('My Bookings',array('controller'=>'tests','action'=>'payment_history'));?>
                            <?php echo $html->link('My Enquiry',array('controller'=>'pages','action'=>'enquiry_detail'));?>
                           <?php //echo $html->link('Vitals',array('controller'=>'tests','action'=>'bmi_value'));?>
                           <?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab("loggedout");'));?>
                        </div>
                    </div>
                    </span>
                    <?php } else{  ?>
                    <a href="/testds/login" class="usericon"><i class="fa fa-2x fa-user-circle-o"></i> Login</a>

                    <?php
                       $session_test = $this->Session->read('session_test');
                          if(!empty($session_test))
                         {

                     ?>
                   <?php } 
                }?>     
            </div>
        </div>
        </aside>
        <div class="clr"></div>
        <!--nav-->
        <nav id="mySidenav">
            <a href="javascript:void(0)" class="closebtn">&times;</a>
            <ul>
                <li class="hometab"><a href="/">Home</a></li>
                <li><a href="javascript:void(0)">Services</a>
                    <ul>
                        <li><a href="/tests/individual_tests">Tests</a></li>
                        <li><a href="/tests/profile">Profiles</a></li>
                        <li><a href="/packagelists/package">Preventive Health Check Up Package</a></li>
                        <li><a href="/tests/services">Patient Care Services</a></li>
                        <li><a href="/tests/health_check_up_corporate">Corporate Health Checkup</a></li>
                        <li><a href="/pages/buy_home_blood_sample_collection">Home Sample Collection</a></li>
                    </ul>
                </li>
                <li><a href="/tests/offers">Special Offers</a></li>
                <li><a href="/pages/contact">Our Centers</a></li>
                <li><a href="javascript:void(0)">FAQ</a>
                    <ul>
                        <li><a href="/pages/quality_policy" itemprop="url"><span itemprop="name">Quality</span></a></li>
                        <li><a href="/pages/faq" itemprop="url"><span itemprop="name">FAQ</span></a></li>
                        <li><a href="<?php echo SITE_URL;?>pages/covid_19" itemprop="url"><span itemprop="name">COVID 19 Info</span></a></li>
                    </ul>
                </li>
				<li><a href="<?php echo SITE_URL;?>pages/prescription">Prescription</a></li>
                <li><a href="javascript:void(0)">Enquiry</a>
                    <ul>
                        <li><a href="<?php echo SITE_URL;?>pages/raise_ticket">Raise Ticket</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!--nav-->
    </section>
</header>
<section class="small-search"></section>

 <?php echo $content_for_layout; ?>
<!--footer-->
    <footer>    	
       	<section class="footer-likingwrap homebody-inner">
            <ul class="footer-listlink">
                <h2 class="linkhead">Services</h2>
                <li><a href="/tests/individual_tests">Tests</a></li>
                <li><a href="/tests/profile">Profiles</a></li>
                <li><a href="/packagelists/package">Preventive Health Check Up Package</a></li>
                <li><a href="/tests/services">Patient Care Services</a></li>
                <li><a href="/tests/health_check_up_corporate">Corporate Health Checkup</a></li>
                <li><a href="/pages/buy_home_blood_sample_collection">Home Sample Collection</a></li>
                <li><a href="/pages/pincode_servicibility">Check Pincode Servicibility</a></li>
           </ul>
            
            <ul class="footer-listlink">
                <h2 class="linkhead">Company</h2>
                <li><a href="/pages/company_overview">About Us</a></li>
                <li><a href="/pages/vision_mission">Vision Mission And Values</a></li>
                <li><a href="/pages/our_clients">Our Clients</a></li>
                <li><a href="/pages/career">Career</a></li>
             	<li><a href="/pages/contact">Contact Us</a></li>
                 <li><a href="/pages/why_us">Why Us</a></li>
            </ul>
            
            <ul class="footer-listlink">
                <h2 class="linkhead">Need Help?</h2>
                <li><a href="/pages/terms_of_service">Terms Of Services</a></li>
                <li><a href="/pages/privacy">Privacy Policy </a></li>
                <li><a href="/pages/quality_policy">Quality Policies</a></li>
                <li><a href="/pages/terms_refunds">Terms & Refunds</a></li>
                <li><a href="/pages/faq">FAQ</a></li>
                <li><a href="http://lis.niramayapathlabs.com/Live/Design/Default.aspx">Franchise Login </a></li>
		 <li><a href="/pages/raise_ticket">Raise A Ticket</a></li>
            </ul>
            
            <ul class="footer-listlink">
                <h2 class="linkhead">contact us</h2>
                <li><i class="fa fa-map-marker" aria-hidden="true"></i> NirAmaya PathLabs Private Limited<br>
					B-4, New Multan Nagar, <br>
					(Near Paschim Vihar Metro )<br>
					Pillor No. - 233 New Delhi-110056
				</li>
                <li><a href="tel:+91-9555009009 "><i class="fa fa-phone" aria-hidden="true"></i> +91-9555009009 </a></li>
                <li><a href="mailto:helpline@niramayapathlabs.com"> <i class="fa fa-envelope" aria-hidden="true"></i> helpline@niramayapathlabs.com</a></li>
                     
            </ul>
            <div class="clr"></div>
        </section>
        <section class="footer-bott">
        	<div class="homebody-inner">
            	<aside class="footer-bottleft">
                	<div class="footercopy">
                    	&copy; <?php echo date('Y'); ?> Niramaya Health Care.com. All Right Reserved.<br class="hide11">
                    </div>
                </aside>
                <aside class="footer-bottright">
                	<div class="follow">Follow Us On:</div>
                    <div class="social-icons">
                    	<ul>
                        	<li><a href="https://www.facebook.com/NiramayaHealthcare" target="_blank" class="fblinkicon"></a></li>
                            <li><a href="https://twitter.com/Niramaya_Care" class="twi twilinkicon" target="_blank"></a></li>
                            <li><a href="https://plus.google.com/105020569213911001058/posts" class="gplus gpluslinkicon" target="_blank"></a></li>
                        </ul>
                    </div>
                    <div class="clr"></div>
                </aside>
                <div class="clr"></div>
            </div>
        </section>
    </footer>
    <!--footer-->
    <div class="overlay4"></div>
   
</div>
   
</div>
<script type="text/javascript">

    // Vendor Code to cookie
    if (getQuerystring('vendor') != null) {
        $.cookie('utmVenderCode', getQuerystring('vendor'), { path: '/', expires: 30 });
        $.cookie('utmVenderCodeDT', $.now(), { path: '/', expires: 30 });
    }
    function getQuerystring(key) {
        var query = window.location.search.substring(1);       
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == key) {
                return pair[1];
            }
        }
    }
    // Vendor Code to cookie
    
    var cURL = $(location).attr('href');
    var baseUrl = './';
    var clickatest;
    if (cURL.toLowerCase().indexOf('book-a-test'.toLowerCase()) === -1) {
        clickatest = false;
    }
    else {
        clickatest = true;
    }

    function createCookie(city)
    {
        $(document).ready(function () {
            if (city != 'js') {
                $.cookie('selectedCity', city, { path: '/', expires: 30 });
                $('.past-event-down').attr('style', 'display: none');
            }
        });
        getCookie();
        cityCheckCook();
    }

    getCookiePageLoad();

    function getCookiePageLoad()
    {
        $(document).ready(function ()
        {
            if ($.cookie('selectedCity') === null) {                
                $("#cityNameH").html('delhi');
            }
            else {
             
                $("#cityNameH").html($.cookie('selectedCity'));
            }
        });
    }

    function getCookie() {
        $(document).ready(function () {
            if (!clickatest) {
                if ($.cookie('selectedCity') === null) {
                    $("#cityNameH").html('delhi');
                }
                else {
                    $("#cityNameH").html($.cookie('selectedCity'));
                }
            }
            else {
                if ($.cookie('selectedCity') === null) {
                    $("#cityNameH").html('delhi');
                }
                else {
                    window.location.replace(baseUrl + 'book-a-test/' + $.cookie('selectedCity'));
                }
            }
        });
    }
    cartNumber();
</script>

<script>
    $(function () {
        $('input').focusin(function () {
            input = $(this);
            input.data('place-holder-text', input.attr('placeholder'))
            input.attr('placeholder', '');
        });
        $('input').focusout(function () {
            input = $(this);
            input.attr('placeholder', input.data('place-holder-text'));
        });
    });
    $('.smallmenu').click(function () {
        $('#mySidenav').addClass('mywidth');
        $('#mySidenav').removeClass('hidewidth'); 
        $('#myCanvasNav').addClass('overlay-width');
        $('#myCanvasNav').removeClass('overlay-width1');
    });
    $('.closebtn, .overlay3, .closebtn1').click(function () {
        $('#mySidenav').addClass('hidewidth');
        $('#mySidenav').removeClass('mywidth'); 
        $('#myCanvasNav').removeClass('overlay-width');
        $('#myCanvasNav').addClass('overlay-width1');
    });
     	
$(document).ready(function(){
 $('.location-search').click(function(event){
	 event.stopPropagation();
	 $('.location-list-wrap').slideToggle();
 });
 $(".location-list-wrap").on("click", function (event) {
     event.stopPropagation();
 });
 
});
$(document).on("click", function () {
    $(".location-list-wrap").slideUp();
});
	
var myTag = $('.pkgsubtxt, .blogsubtxt').text();
if (myTag.length > 100) {
  var truncated = myTag.trim().substring(0, 100).split(" ").slice(0, -1).join(" ") + "�";
  $('.pkgsubtxt, .blogsubtxt').text(truncated);
}
    
    $(window).scroll(function () {
    var sc = $(window).scrollTop();
    if (sc > 0) {
        $("header").addClass("fixedActive");
$("nav").addClass("nav-fixed");
    } else {
        $("header").removeClass("fixedActive");
$("nav").removeClass("nav-fixed");
    }
});
</script>
    
</body>
</html>
