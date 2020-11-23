<div id="layout">
	<div class="absolute" style="left:0;">
      <?php echo $form->create(null, array('url'=>'/tests/search_keyword_home','id'=>'form1','name'=>'form1')); ?>
	  <?php echo $form->text('Search.test_search',array('class'=>'other','placeholder'=>'1000+ Routine & Advance Blood, Urine & Pathology tests to choose from'));?>
	  <?php //echo $form->submit('frontend/go_button.jpg',array('alt'=>'Go','style'=>'margin-top: 10px; margin-left: 15px;'));?>
	  <?php echo $form->button(''); ?>
        <!--<button></button>-->
		<?php echo $form->end(); ?>
	 </form>
	 <div class="span-search"><a href="http://www.niramayahealthcare.com/tests/search">advance search</a></div>
      <div class="delhi-ncr-tag"><?php echo $this->Html->image('delhi-ncr-tag.png',array('alt'=>'delhi-ncr','title'=>'delhi-ncr'))?></div>
    </div>
  </div>
  </div>
  <!--Banner Part:End-->
  <!--Body Part:Start-->
  <div id="bodyPart">
    <section id="form_part">
      
      <div class="form-part-background">
        <div class="bodyInnerDiv">
          <div class="form-region">
            <div class="left-view-form">
              <div class="leftBox" id="customerLogin" style="display:none;">
                <h1>Customer <span>Login</span></h1>
                <a class="fr linkonA" href="javascript:void(0);" onClick="login_window(&#39;partner&#39;);">View Report</a>
                <p>Use your emailID or mobile number as your username</p>
				<?php echo $form->create(null, array('url'=>'/pages/login','id'=>'form3','name'=>'form3','class'=>'marTopNone','onsubmit'=>'return validationcc(this);')); ?>
			        
            <?php echo $form->text('Login.username', array('class'=>'textBox','value'=>'Please Enter Email/Phone','onblur'=>'if(this.value=="")this.value="Please Enter Email/Phone"',' onfocus'=>'if(this.value=="Please Enter Email/Phone")this.value="";')); ?>
			<?php echo $form->password('Login.pass', array('class'=>'textBox','value'=>'password','onblur'=>'if(this.value=="")this.value="password"',' onfocus'=>'if(this.value=="password")this.value="";')); ?>
                
                  
                  <script type="text/javascript">
			function show_tooltip(val)
			{
				if(val == 0)
				{
					document.getElementById('tooltip1').style.display = 'none';
				}
				if(val == 1)
				{
					document.getElementById('tooltip1').style.display = 'block';
				}
			}
			</script>
                  
                  <button class="button" type="submit">Submit Here</button>
                  <span> 
                          <a class="color-on-link2" href="<?php SITE_URL?>testds/index">New User SignUp</a>
                   <!-- <a class="color-on-link2" href="<?php SITE_URL?>tests/become_member">New User SignUp</a>--> <br>
                  <a class="color-on-link2 fr margin-top-link" href="<?php SITE_URL?>users/forgot_password">Forgot password</a></span>
                <?php echo $form->end(); ?>
              </div>
              <div class="leftBox" id="partnerLogin">
                <h1>View Report</h1>
                <a class="fr linkonA" href="javascript:void(0);" onClick="login_window('customer');">Patient Login</a>
				
				<form method="post" action="<?php echo SITE_URL;?>pages/login_report">
				<p>Use your registered Phone No. as username and Test RequestID as password</p>
				<input type="text" name="data[ViewReport][username]" class="textBox other" placeholder="Enter Username" />
				<input type="password" name="data[ViewReport][password]" class="textBox other" placeholder="Enter Request Number" />
				<button class="button" type="submit">Submit Here</button>
			</form>
				                
              </div>
            </div>
            <div class="offer">
              <h3><!--Special Offers of the Month-->Our Centres</h3>
              <div class="slider-fade-out">
                <ul id="demo1">
				<?php //foreach($show_banner as $key => $val) 
				
				//for($i=1;$i<=8;$i++)
				{ ?>
				<li> <?php echo $this->Html->link($this->Html->image('contactmap/Map-1.jpg', array('alt'=>'Banner')),'/pages/contact', array('escape' => false));?></li>
				<li> <?php echo $this->Html->link($this->Html->image('contactmap/Map-2.jpg', array('alt'=>'Banner')),'/pages/contact', array('escape' => false));?></li>
				<li> <?php echo $this->Html->link($this->Html->image('contactmap/Map-3.jpg', array('alt'=>'Banner')),'/pages/contact', array('escape' => false));?></li>
				<li> <?php echo $this->Html->link($this->Html->image('contactmap/Map-4.jpg', array('alt'=>'Banner')),'/pages/contact', array('escape' => false));?></li>
				<li> <?php echo $this->Html->link($this->Html->image('contactmap/Map-5.jpg', array('alt'=>'Banner')),'/pages/contact', array('escape' => false));?></li>
				<li> <?php echo $this->Html->link($this->Html->image('contactmap/Map-6.jpg', array('alt'=>'Banner')),'/pages/contact', array('escape' => false));?></li>
				<li> <?php echo $this->Html->link($this->Html->image('contactmap/Map-7.jpg', array('alt'=>'Banner')),'/pages/contact', array('escape' => false));?></li>
				<li> <?php echo $this->Html->link($this->Html->image('contactmap/Map-8.jpg', array('alt'=>'Banner')),'/pages/contact', array('escape' => false));?></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="health_check">
      <div id="layout">
        <div class="checkup">
          <h1 style="color:#2aad0d;">This Monsoon Season protect Your family from deadly viruses<br> 
& illnesses like Dengue, Chikungunya, Malaria without<br> Burning a big hole in your pocket</h1>
          <div class="health-check-up-para">
            <p style="color:#f03b4e;">nirAmaya is pleased to offer these vital tests below the Government Capped Rates under its Corporate Social Responsibility Program up to 30th Sep 2017</p>
            <?php echo $this->Html->image('blessing.png',array('alt'=>'blessing','title'=>'blessing'))?>
			</div>
          <div class="health-background">
            <div class="circle-div-text">
					<center><?php echo $this->Html->image('circle-bg.png',array('alt'=>'','title'=>'','class'=>'fr'))?></center>
			
			<!--<a href="http://www.niramayahealthcare.com/packagelists/package">FOR MORE DETAILS
              <h6>CLICK HERE</h6>
              </a>--></div>
			  
            <div class="box-first-item1"> 
			<?php echo $this->Html->image('vital-health-checkup-img.png',array('alt'=>'vital health checkup','title'=>'vital health checkup','class'=>'fr'))?>
			
              <div class="content-box">
			  <br>
			
                <div class="content-left-box">
                  <h3>47 Tests</h3>
                  <h5>Worth &#x20B9; 900/- for</h5>
                  <h1>&#x20B9;. 350/-</h1>
                </div>
                <div class="content-right-box">
                  <p>CBC with P/S & ESR,Malarial Antigen, Widal for typhoid & Urine Routine </p>
                  <!--<div class="button-health-chekup" style="width:157px !important;"><?php echo $this->Html->link('NPL MRP Rs 600/-','/tests/my_cart/32/banner');?></div>-->
				  
				   <div class="button-health-chekup" style="width:157px !important;"><?php echo $this->Html->link('BOOK NOW','/tests/my_cart/32/banner');?></div>
				  
                </div>
              </div>
            </div>
            <div class="box-first-item2"> 
			<?php echo $this->Html->image('whole-body-health-checkup-img.png',array('alt'=>'whole-body-health-checkup','title'=>'whole-body-health-checkup','class'=>'fl'))?>
			    <div class="content-box1">
				<br>
				
                <div class="content-left-box1">
                  <h3>1 Test</h3>
                  <h5>Worth &#x20B9;  800/-for </h5>

                  <h1>&#x20B9; 450/-</h1>
                </div>
                <div class="content-right-box1">
                  <p>Chikungunya lgM is a rapid
 sensitive, Qualitative test for
the detection of specific lgM antibodies in humans(Govt Rate &#x20B9; 600/-)</p>
                 <!-- <div class="button-health-chekup2" style="width:157px !important;"><?php// echo $this->Html->link('NPL MRP Rs 600/-','/tests/my_cart/31/banner');?></div>-->
				  <div class="button-health-chekup2" style="width:157px !important;"><?php echo $this->Html->link('BOOK NOW','/tests/my_cart/31/banner');?></div>				 
				 
                </div>
              </div>
            </div>
			
            <div class="box-first-item3">
			<br>
			   <div class="content-box2">
                <div class="content-left-box2">
                  <h3>3 Tests</h3>
                  <h5>Worth &#x20B9; 2400/- for </h5>
                  <h1>&#x20B9; 1350/-</h1>
                </div>
                <div class="content-right-box2">
                  <p>Include Dengue NS1 Antigen,lgG & lgM (for detection NS1 Antegen & antibodies produced by the body in response to a dengue fever infection, lgG and lgM) (Govt Rate &#x20B9; 1800/-)</p>
                <!--  <div class="button-health-chekup3" style="width:157px !important;"><?php echo $this->Html->link('NPL MRP Rs 1800/-','/tests/my_cart/28/banner');?></div>-->
				<div class="button-health-chekup3" style="width:157px !important;"><?php echo $this->Html->link('BOOK NOW','/tests/my_cart/28/banner');?></div>
				
                </div>
              </div>              
			  <?php echo $this->Html->image('executive-health-checkup.png',array('alt'=>'executive-health-checkup','title'=>'executive-health-checkup','class'=>'fr'))?>
			  </div>
            <div class="box-first-item4">
			<br>
			<br>
              <div class="content-box3">
                <div class="content-left-box3">
                  <h3>2 Tests</h3>
                  <h5>Worth &#x20B9; 4000/-for </h5>
                  <h1>&#x20B9; 2250/-</h1>
                </div>
                <div class="content-right-box3">
                  <p>Molecular PSR testing to test detects the genitic material of the Dengue & Chikungunya virus in the blood after symtoms appear(fever)(Govt Rate &#x20B9;3000/-)</p>
                 <!-- <div class="button-health-chekup4" style="width:157px !important;"><?php echo $this->Html->link('NPL MRP Rs 3000/-','/tests/my_cart/27/banner');?></div>-->
				   <div class="button-health-chekup4" style="width:157px !important;"><?php echo $this->Html->link('BOOK NOW','/tests/my_cart/27/banner');?></div>
                </div>
              </div>
			  <?php echo $this->Html->image('comprehensive-health-checkup.png',array('alt'=>'comprehensive-health-checkup','title'=>'comprehensive-health-checkup','class'=>'fl'))?>
              </div>
          </div>
        </div>
      </div>
    </section>	
	<section style="text-align:center;">
	<style>
		.bx{display:inline-block; font-size:18px; line-height:25px; }
		.bx.bx1 {	width:16%;	border: 1px solid #ccc;	padding: 20px; color:red;}
		.bx.bx2 { font-size:20px;
	width: 50%;
}
.bx.bx3 {
	padding: 20px;
	border: 1px solid #ccc;
	width: 16%;
	 color:red;
}
	</style>
	<!--<div class="bx bx1">
		Home Sample collection Services avaliable
across Delhi NCR
	</div>-->
	<div class="bx bx2">
		Note:- Molecular tests of blood are not likely to detect the virus after<br> 7 days of illness if the result
of a PCR test is negative<br> an antibody test can be used to help establish diagnosis
	</div>
	<!--<div class="bx bx3">
		Note :-
Home Sample Collection Rs 100/- per patient  charges extra
	</div>-->
	<div class="bx bx4">
	Home Sample collection Services avaliable
across Delhi NCR</br>
		Note :-
Home Sample Collection Rs 100/- per patient  charges extra
	</div>
	
	
	</section>
    <section id="our_achvment_slider">
      <div class="achievement-slider">
        <ul class="bxslider" id="slider1">
          <li><?php echo $this->Html->image('niramaya_home_page_bottom_banner_1.png',array('alt'=>'Banner1'))?>
            <div class="slider-text">
              <h1><span>Why</span> Niramaya</h1>
              <ul>
                <li class="list-item-slider">
                  <div class="on-slider-left circle-box1 our_circle_icon1"></div>
                  <div class="on-slider-right">
                    <p>Youngest <span class="color-text">NABL</span> Accredited Lab in India</p>
                  </div>
                </li>
                <li class="list-item-slider">
                  <div class="on-slider-left circle-box2 our_circle_icon2"></div>
                  <div class="on-slider-right">
                    <p><span class="color-text">30,000 </span> Plus Health Checkups</p>
                  </div>
                </li>
                <li class="list-item-slider">
                  <div class="on-slider-left circle-box1 our_circle_icon3"></div>
                  <div class="on-slider-right">
                    <p>More than <span class="color-text">20,000</span> Investigations</p>
                  </div>
                </li>
                <li class="list-item-slider">
                  <div class="on-slider-left circle-box2 our_circle_icon4"></div>
                  <div class="on-slider-right">
                    <p>Serving more than<span class="color-text"> 100 </span>Corporates</p>
                  </div>
                </li>
                <li class="list-item-slider">
                  <div class="on-slider-left circle-box1 our_circle_icon5"></div>
                  <div class="on-slider-right">
                    <p><span class="color-text">5 Patient Care </span>Centers across Delhi/NCR</p>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          <li><?php echo $this->Html->image('niramaya_home_page_bottom_banner_2.png',array('alt'=>'Banner2'))?></li>
          <li><?php echo $this->Html->image('niramaya_home_page_bottom_banner_3.png',array('alt'=>'Banner3'))?></li>
          <li><?php echo $this->Html->image('niramaya_home_page_bottom_banner_4.png',array('alt'=>'Banner4'))?></li>
		  <li><?php echo $this->Html->image('niramaya_home_page_bottom_banner_5.png',array('alt'=>'Banner4'))?></li>
		  <li><?php echo $this->Html->image('niramaya_home_page_bottom_banner_6.png',array('alt'=>'Banner4'))?></li>
        </ul>
      </div>
    </section>
    <section id="scrolling-text">
      <div class="scrolling-text-background" style="padding: 0px 0px;">
        <div id="layout">
          <div class="scroll-text-left">
            <h1>Recent News : </h1>
          </div>
          <div class="scroll-text-right">
            <marquee>
            nirAmaya PathLabs corporate camp @ IGT, Gurgaon on 16th & 17th June'15  |  nirAmaya PathLabs corporate camp @ Imergy, Gurgaon on 16th June'15  |  nirAmaya PathLabs corporate camp @ LBF Travel, Gurgaon on 11th, 12th & June'15  |  nirAmaya PathLabs corporate camp @ Hytech Pro, Noida on 22nd & 23rd June'15  |  nirAmaya PathLabs corporate camp @ Exzeo Software, Noida on 24th & 25th June'15  |  nirAmaya PathLabs corporate camp @ Shipra Group, Noida on 26th June'15  |  nirAmaya PathLabs corporate camp @ TechAhead, Noida on 30th June & 1st July'15  |  nirAmaya PathLabs corporate camp @ Smart Cube, Noida on 22nd , 23th & 24th April'15  |  nirAmaya PathLabs corporate camp @ Edifecs, Gurgaon on 28th April'15  |  nirAmaya PathLabs corporate camp @ UEM, Noida on 29th & 30th April'15  |  nirAmaya PathLabs corporate camp @ Infogain, Noida on 29th & 30th April'15  |  nirAmaya PathLabs corporate camp @ Jaarwis, Gurgaon on 5th May'15  |  nirAmaya PathLabs corporate camp @ Compunnel, Noida on 11th , 12th & 13th May'15  |  nirAmaya PathLabs corporate camp @ TPF, Noida on 13th May'15  |  nirAmaya PathLabs corporate camp @ RightWave, Noida on 17th March'15...
            </marquee>
          </div>
        </div>
      </div>
    </section>
    <section id="logo-slider-bottom">
      <div id="layout">
        <div class="logo-slider-cantt">
          <ul id="flexiselDemo3">
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-1.jpg" alt="" title=""/></li>
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-2.jpg" alt="" title="" /></li>
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-3.jpg" alt="" title=""/></li>
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-4.jpg" alt="" title="" /></li>
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-5.jpg" title="" alt="" /></li>
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-6.jpg" title="" alt="" /></li>
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-7.jpg" title="" alt="" /></li>
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-8.jpg" title="" alt="" /></li>
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-9.jpg" title="" alt="" /></li>
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-10.jpg" title="" alt="" /></li>
            <li><img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-11.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-12.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-13.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-14.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-15.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-16.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-17.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-18.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-19.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-20.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-21.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-22.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-23.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-24.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-25.jpg"  title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-26.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-27.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-28.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-29.jpg"  title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-30.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-31.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-32.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-33.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-34.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-35.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-36.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-37.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-38.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-39.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-40.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-41.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-42.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-43.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-44.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-45.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-46.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-47.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-48.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-49.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-50.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-51.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-52.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-53.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-54.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-55.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-56.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-57.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-58.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-59.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-60.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-61.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-62.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-63.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-64.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-65.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-66.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-67.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-68.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-69.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-70.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-71.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-72.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-73.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-74.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-75.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-76.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-77.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-78.jpg"  title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-79.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-80.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-81.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-82.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-83.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-84.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-85.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-86.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-87.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-88.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-89.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-90.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-91.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-92.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-93.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-94.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-95.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-96.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-97.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-98.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-99.jpg" title="" alt="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-100.jpg" alt="" title=""/></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-101.jpg" alt="" title="" /></li>
            <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-102.jpg" alt="" title=""/></li>
			      <li> <img class="lazy" src="https://www.niramayahealthcare.com/img/logos/logo-103.jpg" alt="" title=""/></li>

          </ul>
        </div>
      </div>
    </section>
  </div>