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
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
<link rel="stylesheet prefetch" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
<?php echo $html->css('css/custom.css'); ?>
<?php echo $html->css('css/responsive.css'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php echo $html->css('css/niramaya.css'); ?>
<?php echo $javascript->link('js/jquery-scrolltofixed.js'); ?>
<?php echo $javascript->link('js/slick.js'); ?>
<?php echo $javascript->link('js/jquery.cookie.js'); ?>
<?php echo $javascript->link('js/home.js'); ?>
<script type="text/javascript">
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
        slidesToShow: 1,
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
                    <a href="tel:+91-9555009009" class="mobhide"><i class="fas fa-mobile-alt"></i>+91-9555009009</a>
                    <a href="/testds/login" class="usericon" style="display:block">Login</a>
                    <span class="user-afterlogin" style="display:none"><span>Hello,</span>
                    <div class="afterlogin-box">
                        <div class="afterlog-links">
                            <a href="#">My Orders</a>
                            <a href="#">My Reports</a>
                            <a href="#">Change Password</a>
                            <a href="#">Log Out</a>
                        </div>
                    </div>
                    </span>
                    
            <?php if(!empty($UserId)) { ?>
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
                <a href='<?php echo SITE_URL;?>tests/my_cart' class="cart">
                        <i class="fas fa-shopping-cart"></i>
                        <div class="cartvalue" id="cartATag"><?php echo $test_cart_count;?></div>
                </a>
                
                <?php   
                }
              }
            ?>




                </div>
            </div>
        </aside>
        <div class="clr"></div>
        <!--nav-->
        <nav id="mySidenav">
            <a href="javascript:void(0)" class="closebtn">&times;</a>
            <ul>
                <li class="hometab"><a href="#">Home</a></li>
                <li><a href="javascript:void(0)" class="desktop-link">Services</a><a href="javascript://" class="small-link">patients</a>
                    <ul>
                        <li><a href="<?php echo MAIN_SITE_URL;?>tests/individual_tests">Tests</a></li>
                        <li><a href="<?php echo MAIN_SITE_URL;?>tests/profile">Profiles</a></li>
                        <li><a href="<?php echo MAIN_SITE_URL;?>packagelists/package">Preventive Health Check Up Package</a></li>
                        <li><a href="<?php echo MAIN_SITE_URL;?>tests/services">Patient Care Services</a></li>
                        <li><a href="<?php echo MAIN_SITE_URL;?>tests/health_check_up_corporate">Corporate Health Checkup</a></li>
                        <li><a href="<?php echo MAIN_SITE_URL;?>pages/buy_home_blood_sample_collection">Home Sample Collection</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo MAIN_SITE_URL;?>tests/offers">Special Offers</a></li>
                <li><a href="<?php echo MAIN_SITE_URL;?>pages/contact">Our Centers</a></li>
                <li><a href="javascript:void(0)" class="desktop-link">FAQ</a><a href="javascript://" class="small-link">doctors</a>
                    <ul>
                        <li><a href="<?php echo MAIN_SITE_URL;?>pages/quality_policy" itemprop="url"><span itemprop="name">Quality</span></a></li>
                        <li><a href="<?php echo MAIN_SITE_URL;?>pages/faq" itemprop="url"><span itemprop="name">FAQ</span></a></li>
                    </ul>
                </li>
                <li><a href="" class="small-link">contact us</a> </li>
            </ul>
        </nav>
        <!--nav-->
    </section>
</header>
<section class="small-search"></section>



  <section class="banner-top">
        <div class="banner-inner">
            <div class="banner-reportbox" id="viewportID">
                <h3>VIEW ALL YOUR TEST REPORTS</h3>
                <form method="post" action="<?php echo SITE_URL;?>pages/login_report">
                 <div class="reportbox-fields">
                    <span class="reportbox-fields-txt">Username</span>
                    <input name="data[ViewReport][username]" type="text" placeholder="Enter username" class="reportbox-fields-style" autocomplete="off" />
                </div>
                <div class="reportbox-fields">
                    <span class="reportbox-fields-txt">Request Number</span>
                    <input name="data[ViewReport][password]" type="password" placeholder="Enter Request Number" class="reportbox-fields-style" autocomplete="off" />
                </div>
                <div class="reportbox-fields">
                    <span class="reportbox-fields-txt">Captcha Code</span>
                    <div class="clr"></div>
                </div>
                <div class="reportbox-fields">
                    <input type="submit" name="" value="check report" class="checkreport" />
                </div>
                 <div class="reportbox-fields">
                 	<a href="javascript:void(0)" onclick="myFunction()"><u>Customer Login</u></a>
                 </div>
                </form> 
            </div>

            <div class="banner-reportbox" id="customerID" style="display: none;">
                <h3>Customer Login</h3>
                <?php echo $form->create(null, array('url'=>'/pages/login','id'=>'form3','name'=>'form3','onsubmit'=>'return validationcc(this);')); ?>
                <div class="reportbox-fields">
                    <span class="reportbox-fields-txt">Email/Phone</span>
                    <?php echo $form->text('Login.username', array('class'=>'reportbox-fields-style','value'=>'Please Enter Email/Phone','onblur'=>'if(this.value=="")this.value="Please Enter Email/Phone"',' onfocus'=>'if(this.value=="Please Enter Email/Phone")this.value="";')); ?>
                </div>
                <div class="reportbox-fields">
                    <span class="reportbox-fields-txt">Password</span>
                    <?php echo $form->password('Login.pass', array('class'=>'reportbox-fields-style','value'=>'password','onblur'=>'if(this.value=="")this.value="password"',' onfocus'=>'if(this.value=="password")this.value="";')); ?>
                   
                </div>
                <div class="reportbox-fields">
                    <span class="reportbox-fields-txt">Captcha Code</span>
                    <div class="clr"></div>
                </div>
                <div class="reportbox-fields">
                    <input type="submit" name="" value="check report" class="checkreport" />
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
                        <a href="#" target="_blank">
                            <div class="bannerimg"><?php echo $this->Html->image('img/slider1.jpg', array('alt'=>'Niramaya PathLab', 'class'=>'scale'))?></div></a>
                    </div>
                    <div>
                        <a href="#" target="_blank">
                            <div class="bannerimg"><?php echo $this->Html->image('img/slider2.jpg', array('alt'=>'Niramaya PathLab', 'class'=>'scale'))?></div></a>
                    </div>
                    <div>
                        <a href="#" target="_blank">
                            <div class="bannerimg"><?php echo $this->Html->image('img/slider3.jpg', array('alt'=>'Niramaya PathLab', 'class'=>'scale'))?></div></a>
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
                <a href="#">
                	<?php echo $this->Html->image('img/t22.jpg', array('alt' =>'Niramaya Pathlab', 'class'=>'scale'))?>
                    <h3>Diabetes </h3></a>
            </div>
            <div class="prog-box2">
                <a href="#">
                	<?php echo $this->Html->image('img/t23.jpg', array('alt'=>'NirAmaya Pathlab', 'class'=>'sclae'))?>
                    <h3>SwasthFit</h3></a>
            </div>
            <div class="clr"></div>
        </aside>
        <aside class="book-collection">
            <h3>Book Home Collection</h3>
            <ul class="book-collec-icons">
                <li>
                    <div class="book-iconimg"><?php echo $this->Html->image('img/b1.png', array('alt' =>'Niramaya Pathlab', 'class'=>'scale'))?></div>
                    <div class="book-icontxt">Convenient &amp;
                        <br>Time Saving</div>
                </li>
                <li>
                    <div class="book-iconimg"><?php echo $this->Html->image('img/b2.png', array('alt' =>'Niramaya Pathlab', 'class'=>'scale'))?></div>
                    <div class="book-icontxt"><a href="">Free Home Collection<br>&amp; Cancellation</a></div>
                </li>
                <li>
                    <div class="book-iconimg"><?php echo $this->Html->image('img/b3.png', array('alt' =>'Niramaya Pathlab', 'class'=>'scale'))?></div>
                    <div class="book-icontxt">Online Access
                        <br>to Reports</div>
                </li>
            </ul>
            <div class="booknow"><a href="">BOOK NOW</a></div>
            <div class="notsure">Not sure about the tests <a href="#">Click here</a></div>
        </aside>
        <div class="clr"></div>
    </section>
    <!--collection pro-->
    <!--health pkgs-->
    <section class="healthpkgs homebody-inner" id="hpDiv" style="height: auto; opacity: 1;">
        <h2 class="headinghome"><span>Packages</span><div class="all"><a href="#">All Packages</a></div></h2>
        <div class="healthpkgs-wrap">
            <div class="healthpkgs-all slick-initialized slick-slider" id="healthPack">
                <div aria-live="polite" class="slick-list draggable">
                    <div class="slick-track niramayaPack" role="listbox">
                        <div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="#" tabindex="0">
                                <div class="healthpkgs-box1">
                                    <h3 class="hpkghead">VITAL HEALTH CHECK-UP</h3> <span class="pkgsubtxt">Check of vital parameters & Vital organs like Heart, Liver, Kidney, Thyroid of your body & more...</span>
                                    <div class="pkgprice"><span>&#8377; 3000</span> &#8377; 1199</div> <span class="arrowlink"></span> </div>
                            </a>
                        </div>
                        <div class="slick-slide slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="#" tabindex="0">
                                <div class="healthpkgs-box1">
                                    <h3 class="hpkghead">WHOLE BODY CHECK-UP</h3> <span class="braj">Blood Sugar Fasting, HbA1c, Thyroid Profile, Hemogram, Urine Routine, Iron Studies, Lipid Profile, Liver Function test,...</span>
                                    <div class="pkgprice"><span>&#8377; 6500</span> &#8377; 1999</div> <span class="arrowlink"></span> </div>
                            </a>
                        </div>
                        <div class="slick-slide  slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="#" tabindex="0">
                                <div class="healthpkgs-box1">
                                    <h3 class="hpkghead">EXECUTIVE HEALTH CHECK-UP</h3> <span class="braj">Complete body with all vital organs & parameters along with Diabetes, HBA1c, Vitamin D / B12, Bone profile with RA Factor/ Ionized Calcium </span>
                                    <div class="pkgprice"><span>&#8377; 8500</span> &#8377; 2999</div> <span class="arrowlink"></span> </div>
                            </a>
                        </div>
                        <div class="slick-slide  slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide40">
                            <a href="#" tabindex="0">
                                <div class="healthpkgs-box1">
                                    <h3 class="hpkghead">COMPREHENSIVE HEALTH CHECK-UP</h3> <span class="braj">Comprihansive Checkup of Complete body with all vitals, Diabetes, Vitamins , Allergy, Infection & Cancer screening &</span>
                                    <div class="pkgprice"><span>&#8377; 12000</span> &#8377; 5999</div> <span class="arrowlink"></span> </div>
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
            <div class="dr-desktopBanner"><?php echo $this->Html->image('niramaya_home_page_bottom_banner_1.png',array('alt' =>'NirAmaya Health Care')); ?>
            </div>
            <div class="bannerNira slider">
                <div>
                    <div class="doctorSlider">
                        <?php echo $this->Html->image('bb1.jpg',array('alt' => 'Niramaya banner'));?>
                    </div>
                </div>
                <div>
                    <div class="doctorSlider">
                    	 <?php echo $this->Html->image('bb2.jpg',array('alt' => 'Niramaya banner'));?>
                    </div>
                </div>
                <div>
                    <div class="doctorSlider">
                    	 <?php echo $this->Html->image('bb3.jpg',array('alt' => 'Niramaya banner'));?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="clear:both;"></div>
    <!--health pkgs-->
    <!--test by condition-->
    <section class="healthpkgs homebody-inner">
        <h2 class="headinghome"><span>Test by Organ</span><div class="all"><a style="display:none;" href="#" target="_blank">All Tests</a></div></h2>
        <div class="test-condition-wrap">
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/p7.PNG', array('class' =>'scale','alt'=>'Diabetes' )); ?></div>
                    <h3 class="testimgs-txt">diabetes</h3>
                </a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/p8.PNG', array('class' =>'scale','alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">kidney</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/p1.PNG', array('class' =>'scale', 'alt'=>'Kidney'))?></div>
                    <h3 class="testimgs-txt">DNA</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/p2.PNG', array('class' =>'scale', 'alt'=>'Lungs'))?></div>
                    <h3 class="testimgs-txt">Lungs</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/img/p3.PNG', array('class' =>'scale', 'alt'=>'infertility'))?></div>
                    <h3 class="testimgs-txt">infertility</h3></a>
            </div>
            <div class="test-condition-box1">
                <a href="#"><div class="testimgs"><?php echo $this->Html->image('img/p4.PNG', array('class' =>'scale', 'alt'=>'heart'));?></div>
                    <h3 class="testimgs-txt">heart</h3></a>
            </div>
        </div>
    </section>
    <section class="homebody-inner">
        <h2 class="headinghome"><span>Tests by Condition</span><div class="all"><a style="display:none;" href="#" target="_blank">All Condition</a></div></h2>
        <div class="conditionTest">
            <ul>
                <li><a href="<?php echo MAIN_SITE_URL;?>tests/search_keyword_home?condition=68" target="_blank">fever</a></li>
                <li><a href="<?php echo MAIN_SITE_URL;?>tests/search_keyword_home?condition=72" target="_blank">heart diseases</a></li>
                <li><a href="<?php echo MAIN_SITE_URL;?>tests/search_keyword_home?condition=77" target="_blank">Hypertension</a></li>
                <li class="list"><a href="<?php echo MAIN_SITE_URL;?>tests/search_keyword_home?condition=114" target="_blank">Viral Infections</a></li>
                <li><a href="<?php echo MAIN_SITE_URL;?>tests/search_keyword_home?condition=8" target="_blank">Allergy</a></li>
                <li><a href="<?php echo MAIN_SITE_URL;?>tests/search_keyword_home?condition=30" target="_blank">Diabetes</a></li>
                <li><a href="<?php echo MAIN_SITE_URL;?>tests/search_keyword_home?condition=26" target="_blank">HIV</a></li>
                <li class="list"><a href="<?php echo MAIN_SITE_URL;?>tests/search_keyword_home?condition=87" target="_blank">Infertility</a></li>
            </ul>
        </div>
    </section>
    <div style="clear:both;"></div>
    <section class="offers-ann homebody-inner">
        <ul class="labOnco">
            <li>
                <a href="#">
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
                <a href="#">
                    <div class="labIcn"><?php echo $this->Html->image('img/13.png', array('alt' => 'National Reference Laboratory')); ?></div>
                    <div class="labtxt">
                        <div class="h1">Our Cancer Portfolio</div>
                        <div id="txtdot2">At LPL, we focus on the latest technologies to help diagnose cancer at an early stage.</div>
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
                <div class="peoplesay">
                    <div class="peoplesay-bg">&#8220;</div>
                    <div class="people-saying">
                        <div>
                            <div class="about-txt">
                                A very good home collection & lab testing service provided by this centre
                                <div class="aboutname">Anit Chauhan </div>
                                <div class="aboutloca">(Bijnor,Uttar Pradesh)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="peoplesay-feedback">
                    <div class="head-feedback">Feedback</div>
                    <div class="feedbacktxt">Query, Questions, Comments about our service?
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
                <h2 class="linkhead">Serives</h2>
                <li><a href="#">Tests</a></li>
                <li><a href="#">Profiles</a></li>
                <li><a href="#">Preventive Health Check Up Package</a></li>
                <li><a href="#">Patient Care Services</a></li>
                <li><a href="#">Corporate Health Checkup</a></li>
                
                <li><a href="#">Home Sample Collection</a></li>
                
            </ul>
            
            <ul class="footer-listlink">
                <h2 class="linkhead">Company</h2>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Privacy Policy </a></li>
    	        <li><a href="#">Quality Policies</a></li>
        	    <li><a href="#">Terms & Refunds</a></li>
             	<li><a href="#">Contact Us</a></li>
              	<li><a href="#">FAQ</a></li>                   
	        </ul>
            
            <ul class="footer-listlink">
                <h2 class="linkhead">Need Help?</h2>
                <li><a href="#">Order a Test</a></li>
                <li><a href="#">Terms Of Services</a></li>
                <li><a href="#">Lab Test Booking</a></li>
                <li><a href="#">Franchise Login 1</a></li>
                <li><a href="#" rel="health">Franchise Login 2</a></li>
                       
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
                    	© <?php echo date('Y'); ?> Niramaya Health Care.com. All Right Reserved.<br class="hide11">
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
     
  
     $(document).ready(function () {  
    		$('.user-afterlogin').click(function(){
    	 	$('.afterlogin-box').stop().slideToggle();
     });
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