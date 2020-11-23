<?php
/* SVN FILE: $Id: default.thtml 4409 2007-02-02 13:20:59Z phpnut $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
*                               1785 E. Sahara Avenue, Suite 490-204
*                               Las Vegas, Nevada 89104
*
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright       Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link                http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package         cake
 * @subpackage      cake.cake.libs.view.templates.pages
 * @since           CakePHP(tm) v 0.10.0.1076
 * @version         $Revision: 4409 $
 * @modifiedby      $LastChangedBy: phpnut $
 * @lastmodified    $Date: 2007-02-02 07:20:59 -0600 (Fri, 02 Feb 2007) $
 * @license         http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title><?php echo WEBSITE_TITLE.' - '.$title_for_layout;?></title>
<meta name="description" content="<?php echo $page_description;?>"/>
<meta name="keywords" content="<?php echo $page_keyword;?>" />
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php echo $html->css('css/niramaya.css'); ?>
<?php echo $javascript->link('js/jquery-scrolltofixed.js'); ?>
<?php echo $javascript->link('js/slick.js'); ?>
<?php echo $javascript->link('js/jquery.cookie.js'); ?>
<?php echo $javascript->link('js/home.js'); ?>

<script type="text/javascript">

function verify_phone()
{
    var phone = $('#LoginUsername').val();
    
    if(phone.length < 10)
    {
        $('#phone_number_error').html('Enter Correct Phone Number');
        $('#phone_number_error').css('color', 'red');
    }
    else
    {
        $('#verifyphone').hide();
        jQuery.ajax({
            type:'GET',
            url:'/tests/check_phone?req_val='+phone,
            dataType:'json',
            success:function(data){
                if(data.user_info.success == 'success')
                {
                    $('#SearchUserImg').hide();
                    $('.after_otp').show();
                    $('#after_otp_sent').html('OTP sent to Registered Number');
                    $('#after_otp_sent').css('color', 'green');
                    $('.before_otp').hide();

                }
                if(data.user_info.success == 'notsuccess')
                {
                    $('#SearchUserImg').hide();
                    $('#phone_number_error').html('Invalid Phone Number. Kindly enter Registered One.');
                    $('#phone_number_error').css('color', 'red');   
                    $('#verifyphone').show();
                }
            },
            beforeSend:function(){
                jQuery('#SearchUserImg').show();
            }, 
        });
    }
}

function checknum(evt)
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;    
}

$(document).ready(function () {  
    $(document).on('click','.user-afterlogin',function(){
        $('.afterlogin-box').stop().slideToggle();
    });

    $.get("https://ipinfo.io", function(response) {
        console.log(response);
    }, "jsonp");
});

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

$(document).ready(function() {
    $('.niramayaPack').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('.bannerNira').slick({
        dots: false,
        infinite: true,
        arrows: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        }, {
            breakpoint: 767,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true
            }
        }, {
            breakpoint: 490,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true
            }
        }]
    });
});
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
                    <!--<a href="https://api.whatsapp.com/send?phone=+917042191851" method="get" target="_blank"><i class="fa fa-2x fa-whatsapp"></i></a> -->
                    <a href="tel:+91-9555009009" class="mobhide" style="padding-top: 6px;"> +91-9555009009</a>
                    <a href='<?php echo SITE_URL;?>tests/my_cart' class="cart"><i class="fa fa-2x fa-shopping-cart"></i><div class="cartvalue" id="cartATag"><?php echo $test_cart_count;?></div>
                        </a>
                    <?php if(!empty($UserId)) { ?>
                     <span class="user-afterlogin"><span><i class="fa fa-2x fa-user-circle-o"></i> <i class="fa fa-2x fa-bars" style="color: #a09e9e;"></i></span>
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
                        <li><a href="<?php echo SITE_URL;?>tests/individual_tests">Tests</a></li>
                        <li><a href="<?php echo SITE_URL;?>tests/profile">Profiles</a></li>
                        <li><a href="<?php echo SITE_URL;?>packagelists/package">Preventive Health Check Up Package</a></li>
                        <li><a href="<?php echo SITE_URL;?>tests/services">Patient Care Services</a></li>
                        <li><a href="<?php echo SITE_URL;?>tests/health_check_up_corporate">Corporate Health Checkup</a></li>
                        <li><a href="<?php echo SITE_URL;?>pages/buy_home_blood_sample_collection">Home Sample Collection</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo SITE_URL;?>tests/offers">Special Offers</a></li>
                <li><a href="<?php echo SITE_URL;?>pages/contact">Our Centers</a></li>
                <li><a href="javascript:void(0)">FAQ</a>
                    <ul>
                        <li><a href="<?php echo SITE_URL;?>pages/quality_policy" itemprop="url"><span itemprop="name">Quality</span></a></li>
                        <li><a href="<?php echo SITE_URL;?>pages/faq" itemprop="url"><span itemprop="name">FAQ</span></a></li>
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



  <section class="banner-top">
        <div class="banner-inner">
            <div class="banner-reportbox" id="viewportID">
                <h3>VIEW TEST REPORTS</h3>
                <form method="post" action="<?php echo SITE_URL;?>pages/login_report">
                 <div class="reportbox-fields">
                    <span class="reportbox-fields-txt">Username/Phone Number</span>
                    <input name="data[ViewReport][username]" type="text" placeholder="Enter Phone Number" class="reportbox-fields-style" autocomplete="off" />
                </div>
                <div class="reportbox-fields">
                    <span class="reportbox-fields-txt">Request Number</span>
                    <input name="data[ViewReport][password]" type="password" placeholder="Enter Request Number" class="reportbox-fields-style" autocomplete="off" />
                </div>
                <!--<div class="reportbox-fields">
                    <span class="reportbox-fields-txt">Captcha Code</span>
                    <div class="clr"></div>
                </div>-->
                <div class="reportbox-fields">
                    <input type="submit" name="" value="check report" class="checkreport" />
                </div>
                 <div class="reportbox-fields">
                    <a href="javascript:void(0)" onclick="myFunction()"><u>Login Via OTP</u></a>
                    <a href="http://lis.niramayapathlabs.com/Live/Design/Default.aspx" target="_blank" style="float: right;"><u>LIS Admin Login</u></a>
                 </div>
                </form> 
            </div>

            <div class="banner-reportbox" id="customerID" style="display: none;">
                <h3>Login Via OTP</h3>
                <?php echo $form->create(null, array('url'=>'/pages/login','id'=>'form3','name'=>'form3','onsubmit'=>'return validationcc(this);')); ?>
                <div class="reportbox-fields before_otp">
                    <span class="reportbox-fields-txt">Phone</span>
                    <?php echo $form->text('Login.username', array('class'=>'reportbox-fields-style','value'=>'Please Enter Phone','onblur'=>'if(this.value=="")this.value="Please Enter Phone"','onfocus'=>'if(this.value=="Please Enter Phone")this.value="";','onkeypress'=>'return checknum(event)','maxlength'=>'10','minlength'=>'10')); ?>
                    <center><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40,'style'=>'margin:0 0 -15px; display:none;','id'=>'SearchUserImg'));?></center>
                    <label id="phone_number_error"></label>
                </div>
                <div class="reportbox-fields before_otp">
                    <input id="verifyphone" type="button" name="" value="Send OTP" class="checkreport" onclick="verify_phone();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40,'style'=>'margin:0 0 -15px; display:none;','id'=>'SearchUserImg'));?>
                </div>
                <div class="reportbox-fields after_otp" style="display:none;">
                    <label id="after_otp_sent"></label>
                    <span class="reportbox-fields-txt">OTP</span>
                    <?php echo $form->password('Login.pass', array('class'=>'reportbox-fields-style','value'=>'password','onblur'=>'if(this.value=="")this.value="password"',' onfocus'=>'if(this.value=="password")this.value="";')); ?>
                </div>
                <div class="reportbox-fields after_otp" style="display:none;">
                    <input type="submit" name="" value="Verify" class="checkreport" />
                </div>
                 <div class="reportbox-fields">
                 	<a href="javascript:void(0)" onclick="myFunction()"><u>View Report</u></a> | <a href="/testds/index"><u>New User</u></a> | <a href="/users/forgot_password"><u>Forgot Password</u></a>
                 </div>
                <?php echo $form->end(); ?>
            </div>
            <script>
            function myFunction() {
              var x = document.getElementById("viewportID");
              var y = document.getElementById("customerID");
              if (x.style.display === "none") {
                x.style.display = "block";
                 y.style.display = "none";

              } else {
                x.style.display = "none";
                 y.style.display = "block";
                
              }
            }
            </script>
            <!--slider-->
            <div class="banner-slider">
                    <div class="homebanner" id="banner">
                    <div>
                        <a href="/pages/covid_19" target="_blank">
                            <div class="bannerimg"><?php echo $this->Html->image('img/slider0.jpg', array('alt'=>'Niramaya PathLab', 'class'=>'scale'))?></div></a>
                    </div>    
                    <div>
                        <a href="#" target="_blank">
                            <div class="bannerimg"><?php echo $this->Html->image('img/slider1.jpg', array('alt'=>'Niramaya PathLab', 'class'=>'scale'))?></div></a>
                    </div>
                    <div>
                        <a href="/pages/buy_home_blood_sample_collection" target="_blank">
                            <div class="bannerimg"><?php echo $this->Html->image('img/slider3.jpg', array('alt'=>'Niramaya PathLab', 'class'=>'scale'))?></div></a>
                    </div>     
                    <div>
                        <a href="/pages/quality_policy" target="_blank">
                            <div class="bannerimg"><?php echo $this->Html->image('img/slider2.jpg', array('alt'=>'Niramaya PathLab', 'class'=>'scale'))?></div></a>
                    </div>
                    <div>
                        <a href="#" target="_blank">
                            <div class="bannerimg"><?php echo $this->Html->image('img/slider4.jpg', array('alt'=>'Niramaya PathLab', 'class'=>'scale'))?></div></a>
                    </div>
                   

                    </div>
             </div>
            <div class="clr"></div>
        </div>
    </section>
    <!--banner-->
    <!--collection pro-->
    <section class="pro-collection-wrap homebody-inner">
        <aside class="book-collection-right">
            <div class="prog-box1">
               	<a target="_blank" href="files/log/NirAmaya_NABL_MC-2606.17.19.pdf"><?php echo $this->Html->image('img/nabl.jpg', array('alt' =>'Niramaya Pathlab', 'class'=>'scale'))?></a>
                <!-- <h3>NABL Accredited Laboratory </h3> -->
            </div>
            <div class="prog-box2">
                <a href="/tests/my_cart/120042"><?php echo $this->Html->image('img/goodhealth.jpg', array('alt'=>'NirAmaya Pathlab', 'class'=>'sclae'))?></a>
                <!--  <h3>Gift Of Good <br> Health Packages</h3> -->
            </div>
            <div class="clr"></div>
        </aside>
        <aside class="book-collection">
            <h3>Book your Covid19 RT PCR test online</h3>
            <ul class="book-collec-icons">
                <li>
                    <div class="book-iconimg"><?php echo $this->Html->image('img/b1.png', array('alt' =>'Niramaya Pathlab', 'class'=>'scale'))?></div>
                    <div class="book-icontxt">Convenient &amp;<br>Time Saving</div>
                </li>
                <li>
                    <div class="book-iconimg"><?php echo $this->Html->image('img/b2.png', array('alt' =>'Niramaya Pathlab', 'class'=>'scale'))?></div>
                    <div class="book-icontxt"><a href="/pages/buy_home_blood_sample_collection">Safe Sample Collection <br> at Home or Lab</a></div>
                </li>
                <li>
                    <div class="book-iconimg"><?php echo $this->Html->image('img/b3.png', array('alt' =>'Niramaya Pathlab', 'class'=>'scale'))?></div>
                    <div class="book-icontxt">Online Access<br>to Reports</div>
                </li>
            </ul>
            <div class="booknow"><a href="/tests/my_cart/120045">BOOK NOW</a></div>
            <div class="notsure">Need more information on Tests related to Covid19? <a href="/pages/covid_19">Click here</a></div>
        </aside>
        <div class="clr"></div>
    </section>
    <!--collection pro-->
    <!--health pkgs-->
   <section class="healthpkgs  homebody-inner" id="hpDiv" style="height: auto; opacity: 1;margin-bottom: 2px;">
        <h2 class="headinghome"><span>Health Care Packages</span><div class="all"><a href="/packagelists/package">All Packages</a></div></h2>
        <div class="healthpkgs-wrap">
            <div class="healthpkgs-all slick-initialized slick-slider" id="healthPack">
                <div aria-live="polite" class="slick-list draggable">
                    <div class="slick-track healthpackagesall" role="listbox">
                        <div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="/packagelists/package" target="_blank" tabindex="0">
                                <div class="healthpkgs-box1">
                                <div class="basic-box">
                                    <?php echo $this->Html->image('/img/covid/healthcare/1.png', array('alt'=>'Couple Plan Janaid', 'class'=>'scale'))?>
                                   <!--  <h3 class="hpkghead">Basic Heath Check Up</h3> <span class="pkgsubtxt">84 vital parameters check </span>
                                    <div class="pkgprice"><span>&#8377; 4000</span> &#8377; 999</div> <span class="arrowlink"></span> -->
                                        
                                    </div> 
                               </div>
                            </a>
                        </div>
                        <div class="slick-slide slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="/packagelists/package" target="_blank" tabindex="0">
                                <div class="healthpkgs-box1">
                                    <div class="complete-box">
                                        <?php echo $this->Html->image('/img/covid/healthcare/2.png', array('alt'=>'Couple Plan Janaid', 'class'=>'scale'))?>

                                   <!--  <h3 class="hpkghead">Complete Health Check Up</h3> <span class="braj">84 vital parameters check</span>
                                    <div class="pkgprice"><span>&#8377; 6500</span> &#8377; 1399</div> <span class="arrowlink"></span>  -->
                                </div>
                                </div>
                            </a>
                        </div>
                        <div class="slick-slide  slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="/packagelists/package" target="_blank" tabindex="0">
                                <div class="healthpkgs-box1">
                                    <div class="men-box">
                                         <?php echo $this->Html->image('/img/covid/healthcare/3.png', array('alt'=>'Couple Plan Janaid', 'class'=>'scale'))?>
                                    <!-- <h3 class="hpkghead">Men Health Check Up</h3> <span class="braj">112 vital parameters check  </span>
                                    <div class="pkgprice"><span>&#8377; 12000</span> &#8377; 2999</div> <span class="arrowlink"></span>  --></div>
                                </div>
                            </a>
                        </div>
                        <div class="slick-slide  slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="/packagelists/package" target="_blank" tabindex="0">
                                <div class="healthpkgs-box1">
                                    <div class="boys-box">
                                         <?php echo $this->Html->image('/img/covid/healthcare/4.png', array('alt'=>'Couple Plan Janaid', 'class'=>'scale'))?>
                                  <!--   <h3 class="hpkghead">Boys Health Check Up</h3> <span class="braj">96 vital parameters check </span>
                                    <div class="pkgprice"><span>&#8377; 9000</span> &#8377; 2250</div> <span class="arrowlink"></span> --> </div>
                                </div>
                            </a>
                        </div>
                        <div class="slick-slide  slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="/packagelists/package" target="_blank" tabindex="0">
                                <div class="healthpkgs-box1">
                                    <div class="girl-box">
                                         <?php echo $this->Html->image('/img/covid/healthcare/5.png', array('alt'=>'Couple Plan Janaid', 'class'=>'scale'))?>
                                   <!--  <h3 class="hpkghead">Girls Health Check Up</h3> <span class="braj">96 vital parameters check </span>
                                    <div class="pkgprice"><span>&#8377; 9000</span> &#8377; 2250</div> <span class="arrowlink"></span> --> </div>
                                </div>
                            </a>
                        </div>

                         <div class="slick-slide  slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="/packagelists/package" target="_blank" tabindex="0">
                                <div class="healthpkgs-box1">
                                    <div class="kids-box">
                                         <?php echo $this->Html->image('/img/covid/healthcare/6.png', array('alt'=>'Couple Plan Janaid', 'class'=>'scale'))?>
                                   <!--  <h3 class="hpkghead">Kids Health Check Up</h3> <span class="braj">60 vital parameters check </span>
                                    <div class="pkgprice"><span>&#8377; 5000</span> &#8377; 1299</div> <span class="arrowlink"></span> --> </div>
                                </div>
                            </a>
                        </div>
                         <div class="slick-slide  slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="/packagelists/package" target="_blank" tabindex="0">
                                <div class="healthpkgs-box1">
                                    <div class="kids-box">
                                         <?php echo $this->Html->image('/img/covid/healthcare/7.png', array('alt'=>'Couple Plan Janaid', 'class'=>'scale'))?>
                                   <!--  <h3 class="hpkghead">Kids Health Check Up</h3> <span class="braj">60 vital parameters check </span>
                                    <div class="pkgprice"><span>&#8377; 5000</span> &#8377; 1299</div> <span class="arrowlink"></span> --> </div>
                                </div>
                            </a>
                        </div>

                        


                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="homebody-inner">
        <h2 class="headinghome"><span>Why Niramaya</span><div class="all"></div></h2>
        <div class="dr-banner-imgcontain">
            <div class="dr-desktopBanner"><?php echo $this->Html->image('img/niramaya_home_page_bottom_banner_1.png',array('alt' =>'NirAmaya Health Care')); ?>
            </div>
            <div class="bannerNira slider">
                <div>
                    <div class="doctorSlider">
                        <?php echo $this->Html->image('img/5.1.jpg',array('alt' => 'Niramaya banner'));?>
                    </div>
                </div>
                <div>
                    <div class="doctorSlider">
                    	 <?php echo $this->Html->image('img/5.2.jpg',array('alt' => 'Niramaya banner'));?>
                    </div>
                </div>
                <div>
                    <div class="doctorSlider">
                    	 <?php echo $this->Html->image('img/5.3.jpg',array('alt' => 'Niramaya banner'));?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="clear:both;"></div>
    
    <section class="homebody-inner headinghome1">
         <h2 class="headinghome"><span>Special Offers</span><div class="all"><a style="display:none;" href="#" target="_blank">All Condition</a></div></h2>
        <div class="conditionTest">
            <ul>
                <li><a href="<?php echo SITE_URL;?>tests/offers"><?php echo $this->Html->image('covid/special-offers/1.png', array('alt' => 'Offer', 'class' =>'scale')); ?> </a></li>
                <li><a href="<?php echo SITE_URL;?>tests/offers"><?php echo $this->Html->image('covid/special-offers/5.png', array('alt' => 'Offer', 'class' =>'scale')); ?></a></li>
                <li><a href="<?php echo SITE_URL;?>tests/offers"><?php echo $this->Html->image('covid/special-offers/4.png', array('alt' => 'Offer', 'class' =>'scale')); ?></a></li>
                <li><a href="<?php echo SITE_URL;?>tests/offers"><?php echo $this->Html->image('covid/special-offers/3.png', array('alt' => 'Offer', 'class' =>'scale')); ?></a></li>
                <li><a href="<?php echo SITE_URL;?>tests/offers"><?php echo $this->Html->image('covid/special-offers/2.png', array('alt' => 'Offer', 'class' =>'scale')); ?></a></li>
                <li><a href="<?php echo SITE_URL;?>tests/offers"><?php echo $this->Html->image('covid/special-offers/immunity_shield_main.jpeg', array('alt' => 'Offer', 'class' =>'scale')); ?></a></li>
            </ul>
        </div>
    </section>
    <div style="clear:both;"></div>
    <section class="healthpkgs homebody-inner">
        <h2 class="headinghome"><span>Test by Symptoms</span><div class="all"><a style="display:none;" href="#" target="_blank">All Tests</a></div></h2>
        <div class="test-condition-wrap">
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_kidney.png', array('class' =>'scale','alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">kidney</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_infertility.png', array('class' =>'scale', 'alt'=>'infertility'))?></div>
                    <h3 class="testimgs-txt">infertility</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_heart.png', array('class' =>'scale', 'alt'=>'heart'));?></div>
                    <h3 class="testimgs-txt">heart</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_dna.png', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">Allergy</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_dna.png', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">Antenatal</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_dna.png', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">Arthritis</h3></a>
            </div>
        </div>
        <div class="test-condition-wrap showmore" style="display:none;">
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_dna.png', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">Bones</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_dna.png', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">Cardiac</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_diabetes.png', array('class' =>'scale','alt'=>'Diabetes' )); ?></div>
                    <h3 class="testimgs-txt">diabetes</h3>
                </a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_dna.png', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">Fever</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_lungs.png', array('class' =>'scale', 'alt'=>'Lungs'))?></div>
                    <h3 class="testimgs-txt">Hormones</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_dna.png', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">Thyroid</h3></a>
            </div>
        </div>
        <div class="test-condition-wrap showmore" style="display:none;">
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_dna.png', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">STD</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_dna.png', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">Infection</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/tbo_dna.png', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">Low energy / Immunity</h3></a>
            </div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <a id="show_more" href="javascript:void(0)" style="float:right;padding-top:10px;font-weight:600;font-size:larger;" onclick="showData(1)">Show More</a>
        <a id="show_less" style="display:none;float:right;padding-top:10px;font-weight:600;font-size:larger;" href="javascript:void(0)" onclick="showData(0)">Show Less</a>
    </section>
    <section class="homebody-inner">
        <h2 class="headinghome"><span>Tests by Condition</span><div class="all"><a style="display:none;" href="#" target="_blank">All Condition</a></div></h2>
        <div class="conditionTest">
            <ul>
                <li><a href="<?php echo SITE_URL;?>tests/search_keyword_home?condition=68" target="_blank">fever</a></li>
                <li><a href="<?php echo SITE_URL;?>tests/search_keyword_home?condition=72" target="_blank">heart diseases</a></li>
                <li><a href="<?php echo SITE_URL;?>tests/search_keyword_home?condition=77" target="_blank">Hypertension</a></li>
                <li class="list"><a href="<?php echo SITE_URL;?>tests/search_keyword_home?condition=114" target="_blank">Viral Infections</a></li>
                <li><a href="<?php echo SITE_URL;?>tests/search_keyword_home?condition=8" target="_blank">Allergy</a></li>
                <li><a href="<?php echo SITE_URL;?>tests/search_keyword_home?condition=30" target="_blank">Diabetes</a></li>
                <li><a href="<?php echo SITE_URL;?>tests/search_keyword_home?condition=26" target="_blank">HIV</a></li>
                <li class="list"><a href="<?php echo SITE_URL;?>tests/search_keyword_home?condition=87" target="_blank">Infertility</a></li>
            </ul>
        </div>
    </section>
    <div style="clear:both;"></div>
    <section class="offers-ann homebody-inner">
        <ul class="labOnco">
            <li>
                <a href="<?php echo SITE_URL;?>pages/n_r_l">
                    <div class="labIcn"><?php echo $this->Html->image('img/12.png', array('alt' => 'National Reference Laboratory')); ?>
                    </div>
                    <div class="labtxt">
                        <div class="h1">National Reference Laboratory</div>
                        <div id="txtdot1">NRL is equipped with state-of-the-art technology and best professionals.</div>
                    </div>
                    <span class="knowmor">Read more</span>
                </a>
            </li>
            <li>
                <a target="_blank" href="https://labtestsonline.org/search?keywords">
                    <div class="labIcn"><?php echo $this->Html->image('img/13.png', array('alt' => 'National Reference Laboratory')); ?></div>
                    <div class="labtxt">
                        <div class="h1">Know Your Tests</div>
                        <div id="txtdot2">Read and know all about the Tests ( Lipid Profile,Kidney Profile ...etc)</div>
                    </div>
                    <span class="knowmor">Read more</span>
                </a>
            </li>
        </ul>
    </section>
    <div style="clear:both;"></div>
    <!--about-->
    <section class="people-about homebody-inner">
        <div class="about-wrap">
            <aside class="about-left">
                <h2 class="headinghome"><span>What people are saying About us</span></h2>
                <div class="peoplesay" style="border:8px solid #fff !important;">
                    <div class="peoplesay-bg">&#8220;</div>
                    <div class="people-saying">
                        <div>
                            <div class="about-txt">
                                A very good home collection & lab testing service provided by this centre
                                <div class="aboutname">Anit Chauhan </div>
                                <div class="aboutloca">(CP, New Delhi)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="peoplesay-feedback" style="border:8px solid #fff !important;">
                    <div class="head-feedback">Feedback</div>
                    <div class="feedbacktxt" style="line-height: 30px;">Query, Questions, Comments about our service?
                        <br>We look forward to hearing from you!
                        <a href="" target="_blank"></a>
                    </div>
                </div>
            </aside>
            <aside class="about-right">
                <h2 class="headinghome"><span>About us</span></h2>
                <div class="videocontainer">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/GjVLPwWPUO8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </aside>
            <div class="clr"></div>
        </div>
    </section>
    <!--about-->
    <!--accriditation-->
    <section class="accreditation homebody-inner">
        <div class="accre-wrap">
            <aside class="accre-left">
                <h2 class="headinghome"><span>Our Clients</span></h2>
                <ul class="accre-listing nrlspace">
                    <marquee>
                        <li><?php echo $this->Html->image('img/client_logo/xzeo-logo.jpg', array('alt' =>'xzeo'));?></li>
                        <li><?php echo $this->Html->image('img/client_logo/shipa-logo.jpg', array('alt' =>'shipa-logo'));?></li>
                        <li><?php echo $this->Html->image('img/client_logo/pure-software-logo.jpg', array('alt' =>'pure software'));?></li>
                        <li><?php echo $this->Html->image('img/client_logo//mata-logo.jpg', array('alt' =>'mata logo'));?></li>
                    </marquee>
                    <div class="clr"></div>
                </ul>
                <div class="clr"></div>
            </aside>
            <aside class="accre-right">
                <div class="newsicon"><span></span>Subscribe to our newsletter</div>
                <div class="suscribe-field">
                    <input name="" type="text" id="" class="subscribe-style" placeholder="Enter your email" autocomplete="off" />
                    <span id="" style="display:none;"></span>
                    <input type="submit" name="" value="" id="" class="subsc-btn" />
                </div>
        </div>
        </aside>
        <div class="clr"></div>
        </div>
    </section>
    <!--accriditation-->
    <script>
        $(document).ready(function() {
            $("#txtdot1").text(($("#txtdot1").text()).substring(0, 118) + "...");
            //$("#txtdot2").text(($("#txtdot2").text()).substring(0,130) + "...");
        });
    </script>
    <?php include('footer.php'); ?>
   
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
                        <a href="#" target="_blank">Blog</a> |
                        <a href="#">Terms of Use</a> |
                        <a href="#">Privacy Policy</a> |
                        <a href="#">Statutory Compliance</a> |
                        <a href="#">Sitemap</a>
                       <!-- <span class="footer-second">Only Pathology reports available online. For X-Ray, Ultrasound, ECG, TMT, Echo, PFT, Uroflowmetry reports please visit the concerned center where test has been conducted.
                        </span>-->
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

function showData(check)
{
    if(check==1)
    {
        $('.showmore').show();
        $('#show_less').show();
        $('#show_more').hide();
    }
    else
    {
        $('.showmore').hide();
        $('#show_less').hide();
        $('#show_more').show();
    }
    e.preventDefault();
}
</script>
    
</body>
</html>
