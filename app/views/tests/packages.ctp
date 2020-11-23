<!--<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-529730e006a48cea"></script>-->
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
	$("#open01").click(function(){
		$("#openDiv01").toggle();
		$("#openDiv02").hide();
		$("#openDiv03").hide();
		$("#openDiv04").hide();
		$("#openDiv05").hide();
		$("#openDiv06").hide();
		$("#openDiv07").hide();
		$("#openDiv08").hide();
		$("#openDiv09").hide();
		$("#openDiv10").hide();
	});
  	$("#open02").click(function(){
		$("#openDiv02").toggle();
		$("#openDiv01").hide();
		$("#openDiv03").hide();
		$("#openDiv04").hide();
		$("#openDiv05").hide();
		$("#openDiv06").hide();
		$("#openDiv07").hide();
		$("#openDiv08").hide();
		$("#openDiv09").hide();
		$("#openDiv10").hide();
	}); 
	$("#open03").click(function(){
		$("#openDiv03").toggle();
		$("#openDiv01").hide();
		$("#openDiv02").hide();
		$("#openDiv04").hide();
		$("#openDiv05").hide();
		$("#openDiv06").hide();
		$("#openDiv07").hide();
		$("#openDiv08").hide();
		$("#openDiv09").hide();
		$("#openDiv10").hide();
	});
	$("#open04").click(function(){
		$("#openDiv04").toggle();
		$("#openDiv01").hide();
		$("#openDiv02").hide();
		$("#openDiv03").hide();
		$("#openDiv05").hide();
		$("#openDiv06").hide();
		$("#openDiv07").hide();
		$("#openDiv08").hide();
		$("#openDiv09").hide();
		$("#openDiv10").hide();
	});
	$("#open05").click(function(){
		$("#openDiv05").toggle();
		$("#openDiv01").hide();
		$("#openDiv02").hide();
		$("#openDiv03").hide();
		$("#openDiv04").hide();
		$("#openDiv06").hide();
		$("#openDiv07").hide();
		$("#openDiv08").hide();
		$("#openDiv09").hide();
		$("#openDiv10").hide();
	});
	$("#open06").click(function(){
		$("#openDiv06").toggle();
		$("#openDiv01").hide();
		$("#openDiv02").hide();
		$("#openDiv03").hide();
		$("#openDiv04").hide();
		$("#openDiv05").hide();
		$("#openDiv07").hide();
		$("#openDiv08").hide();
		$("#openDiv09").hide();
		$("#openDiv10").hide();
	});
	$("#open07").click(function(){
		$("#openDiv07").toggle();
		$("#openDiv01").hide();
		$("#openDiv02").hide();
		$("#openDiv03").hide();
		$("#openDiv04").hide();
		$("#openDiv05").hide();
		$("#openDiv06").hide();
		$("#openDiv08").hide();
		$("#openDiv09").hide();
		$("#openDiv10").hide();
	});
	$("#open08").click(function(){
		$("#openDiv08").toggle();
		$("#openDiv01").hide();
		$("#openDiv02").hide();
		$("#openDiv03").hide();
		$("#openDiv04").hide();
		$("#openDiv05").hide();
		$("#openDiv06").hide();
		$("#openDiv07").hide();
		$("#openDiv09").hide();
		$("#openDiv10").hide();
	});
	$("#open09").click(function(){
		$("#openDiv09").toggle();
		$("#openDiv01").hide();
		$("#openDiv02").hide();
		$("#openDiv03").hide();
		$("#openDiv04").hide();
		$("#openDiv05").hide();
		$("#openDiv06").hide();
		$("#openDiv07").hide();
		$("#openDiv08").hide();
		$("#openDiv10").hide();
	});
   	$("#open10").click(function(){
		$("#openDiv10").toggle();
		$("#openDiv01").hide();
		$("#openDiv02").hide();
		$("#openDiv03").hide();
		$("#openDiv04").hide();
		$("#openDiv05").hide();
		$("#openDiv06").hide();
		$("#openDiv07").hide();
		$("#openDiv08").hide();
		$("#openDiv09").hide();
	});
  
  
  
}); 
</script>
<?php echo $javascript->link('jquery-1.4.4') ?>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_niramaya-packages-2.jpg',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'))?></div>
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
		  <div class="bread"><a href="<?php echo SITE_URL;?>tests/individual_tests">Services</a></div>
          <div class="bread"><?php echo $this->Html->link('Packages','/tests/packages');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<div style="float:left; position:relative; width:100%;">
<h1>Niramaya <span class="green">Packages</span></h1>
<div id="advanceSearch"><h4>Search / Book a Test</h4>
			  <?php echo $form->create(null, array('url'=>'/tests/search_keyword_home','id'=>'form1','name'=>'form1')); ?>
			  <?php echo $form->text('Search.test_search',array('placeholder'=>'Type Keyword...'));?>
			  <input type="image" src="<?php echo SITE_URL;?>img/frontend/go.jpg" class="go" style="cursor:pointer;" />
			  <div class="or">Or</div>
			  <div class="advanceSearch"><a href="<?php echo SITE_URL;?>tests/search" style="color:#EE8012;">Advance Search</a></div>
			  <?php echo $form->end();?>
		  </div>
<div style="float: right; position: absolute; right: 0px; top: 56px;">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
  	var js, fjs = d.getElementsByTagName(s)[0];
  	if (d.getElementById(id)) return;
  	js = d.createElement(s); js.id = id;
  	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=503403359767475";
  	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="fb-like" data-href="https://www.facebook.com/NiramayaHealthcare" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
</div>
</div>
      <div class="tableDiv">
        <table width="100%" cellspacing="1" cellpadding="0">
          <tr>
            <th width="40">S. No.</th>
            <th width="55">PROFILE &amp; TEST CODE</th>
            <th>Test Profiles &amp; Tests</th>
            <th width="159"><?php echo $html->image('frontend/76off.gif');?></th>
            <th width="159"><?php echo $html->image('frontend/68off.gif');?></th>
            <th width="159"><?php echo $html->image('frontend/55off.gif');?></th>
              </tr>
          <tr>
            <td valign="top" class="borLeft1 bg0"><p class="text">P1</p></td>
            <td valign="top" class="bg0"><p class="text">P090</p></td>
            <td valign="top" class="bg0" style="width: 309px;"><span class="bullPoint">Blood Glucose - Fasting -1 Test</span>
              </td>
            <td class="bg9"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?>
			
			</td>
            <td class="bg3"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg5"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            
          </tr>
          <tr>
            <td class="borLeft1 bg1">P2</td>
            <td class="bg1">P093</td>
            <td class="bg1"><span class="bullPoint" id="open01">Lipid Profile (Heart Risk Profile) 7 Tests</span>
			<div class="contDiv" id="openDiv01">
				<ul>
					<li>Total Cholesterol</li>
					<li>HDL Cholesterol</li>
					<li>LDL Cholesterol</li>
					<li>VLDL Cholesterol</li>
					<li>TC (Total Cholesterol)/HDL Cholesterol Ratio</li>
					<li>LDL / HDL Cholesterol Ratio</li>
					<li>Tryglycerides</li>
				</ul>
			</div>
			</td>
            <td class="bg2"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg4"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg6"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            
          </tr>
           <tr>
            <td class="borLeft1 bg0">P3</td>
            <td class="bg0">P034</td>
            <td class="bg0"><span class="bullPoint" id="open02">Liver Profile ( Liver Function Test ) - 11 Tests</span>
			<div class="contDiv" id="openDiv02">
				<ul>
					<li>Bilirubin-Total</li>
					<li>Bilirubin-Direct</li>
					<li>Bilirubin-Indirect</li>
					<li>SGOT (AST)</li>
					<li>SGPT (ALT)</li>
					<li>Gamma GT/GGT (Gamma Glutamyl Transferase)</li>
					<li>Protein-Total</li>
					<li>Albumin</li>
					<li>Globulin</li>
					<li>Serum Albumin / Globulin Ratio</li>
					<li>Alkaline Phosphatase ( ALP)</li>
				</ul>
			</div>
			</td>
            <td class="bg9"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg3"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg5"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            
          </tr>
          <tr>
            <td class="borLeft1">P4</td>
            <td>P033</td>
            <td class="bg1"><span class="bullPoint" id="open03">Renal Profile ( Kidney Function Test ) - 7 Tests</span>
			<div class="contDiv" id="openDiv03">
				<ul>
					<li>Sodium (Na)</li>
					<li>Potassium</li>
					<li>Chloride-Serum</li>
					<li>Uric Acid</li>
					<li>Blood Urea Nitrogen (BUN)</li>
					<li>Creatinine</li>
					<li>Bun / Creatinine Ratio</li>
				</ul>
			</div>
			</td>
            <td class="bg2"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg4"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg6"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
           	
          </tr>
          <tr>
            <td class="borLeft1 bg0">P5</td>
            <td class="bg0">P039</td>
            <td class="bg0"><span class="bullPoint" id="open04">Thyroid Profile ( Thyroid Function Test ) - 3 Tests</span>
			<div class="contDiv" id="openDiv04">
				<ul>
					<li>Total Tri-Iodothyronine (T3)</li>
					<li>Total Thyroxine (T4)</li>
					<li>Thyroid Stimulating Hormone (TSH)</li>
				</ul>
			</div>
			</td>
            <td class="bg9"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg3"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg5"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
           	
          </tr>
          <tr>
            <td class="borLeft1">P6</td>
            <td>H2030</td>
            <td><span class="bullPoint" id="open05">Complete Hemogram (CBC + ESR) - 15 Tests</span>
			<div class="contDiv" id="openDiv05">
				<ul>
					<li>Hemoglobin (Hb)</li>
					<li>RBC Count</li>
					<li>Haematocrit (HCT)</li>
					<li>MCV</li>
					<li>MCH</li>
					<li>MCHC</li>
					<li>RDW-CV</li>
					<li>Total WBC Count</li>
					<li>Neutrophils</li>
					<li>Lymphocytes</li>
					<li>Monocytes</li>
					<li>Eosinophil</li>
					<li>Basophil</li>
					<li>Platelet Count</li>
					<li>ESR</li>
				</ul>
			</div>
			</td>
            <td class="bg2"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg4"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg6"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            
          </tr>
          <tr>
            <td class="borLeft1 bg0">P7</td>
            <td class="bg0">H2001</td>
            <td class="bg0"><span class="bullPoint" id="open06">Complete Urine Analysis (CUE) - 17 Tests</span>
			<div class="contDiv" id="openDiv06">
				<ul>
					<li>Colour</li>
					<li>Appearance</li>
					<li>Specific Gravity</li>
					<li>Reaction (pH)</li>
					<li>Proteins</li>
					<li>Glucose</li>
					<li>Bile Salts</li>
					<li>Bile Pigments</li>
					<li>Nitrites</li>
					<li>Blood</li>
					<li>Ketones</li>
					<li>Urobilinogen</li>
					<li>PUS (WBC) Cells</li>
					<li>Urine RBC</li>
					<li>U. Epithelial Cells</li>
					<li>Crystals</li>
					<li>Casts</li>
				</ul>
			</div>
			</td>
            <td class="bg9"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg3"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg5"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            
          </tr>
          <tr>
            <td class="borLeft2">P8</td>
            <td>H2001</td>
            <td><span class="bullPoint" id="open07">Diabetes Monitoring Panel- 3 Tests with HBA1c</span>
			<div class="contDiv" id="openDiv07">
				<ul>
					<li>Estimated Average Glucose</li>
					<!--<li>Spot Microalbumin</li>-->
					<li>HbA1C (IFCC) (3 months glucose memory test with Graphic analysis)</li>
					<li>HbA1C (NGSP) (3 months glucose memory test in %)</li>
				</ul>
			</div>
			</td>
            <td class="bg1"><?php echo $html->image('frontend/no.png',array('alt'=>'Yes'));?></td>
            <td class="bg4"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg6"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            
          </tr>
         
          
          
          <tr>
            <td class="borLeft2 bg0">P9</td>
            <td class="bg0">P089</td>
            <td class="bg0"><span class="bullPoint" id="open08">Iron Profile - 4 Tests</span>
			<div class="contDiv" id="openDiv08">
				<ul>
					<li>Serum Iron</li>
					<li>Total Iron Binding Capacity</li>
					<li>Transferrin Saturation</li>
					<li>Serum Transferrin</li>
				</ul>
			</div>
			</td>
            <td class="bg0"><?php echo $html->image('frontend/no.png',array('alt'=>'Yes'));?></td>
            <td class="bg3"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg5"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
           	
          </tr>
          <tr>
            <td class="borLeft2">P10</td>
            <td>C1054</td>
            <td><span class="bullPoint" id="open09">Arthritis Screen (Bone Profile) - 3 Tests</span>
			<div class="contDiv" id="openDiv09">
				<ul>
					<li>Serum Calcium</li>
					<li>Alkaline Phosphatase</li>
					<li>ESR</li>
				</ul>
			</div>
			</td>
            <td class="bg1"><?php echo $html->image('frontend/no.png',array('alt'=>'Yes'));?></td>
            <td class="bg4"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            <td class="bg6"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            
          </tr>
          
          <tr>
            <td class="borLeft4 bg0">P11</td>
            <td class="bg0">P088</td>
            <td class="bg0"><span class="bullPoint" id="open10">Hypertension Panel (Basic) - 5 Tests</span>
			<div class="contDiv" id="openDiv10">
				<ul>
					<li>Calcium- Total</li>
					<li>Chloride-Serum</li>
					<li>Phosphorus</li>
					<li>Potassium</li>
					<li>Sodium (Na)</li>
				</ul>
			</div>
			</td>
            <td class="bg0"><span class="bg2"><?php echo $html->image('frontend/no.png',array('alt'=>'No'));?></span></td>
            <td class="bg0"><span class="bg2"><?php echo $html->image('frontend/no.png',array('alt'=>'No'));?></span></td>
            <td class="bg5"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            
          </tr>
          
          
          <tr>
            <td class="borLeft4">P12</td>
            <td>C1180</td>
            <td><span class="bullPoint">Vitamin - B12</span></td>
            <td class="bg1"><?php echo $html->image('frontend/no.png',array('alt'=>'No'));?></td>
            <td class="bg1"><?php echo $html->image('frontend/no.png',array('alt'=>'Yes'));?></td>
            <td class="bg6"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            
          </tr>
          <tr>
            <td class="borLeft4 bg0">P13</td>
            <td class="bg0">C1189</td>
            <td class="bg0"><span class="bullPoint">Vitamin D (25 - Hydroxy)</span></td>
            <td class="bg0"><?php echo $html->image('frontend/no.png',array('alt'=>'No'));?></td>
            <td class="bg0"><span class="bg4"><?php echo $html->image('frontend/no.png',array('alt'=>'Yes'));?></span></td>
            <td class="bg5"><?php echo $html->image('frontend/yes.png',array('alt'=>'Yes'));?></td>
            
          </tr>
          
          
          
        </table>
        <div class="priceDivBox">
          <div class="blankOne"> </div>
          <div class="blankOne width56"> </div>
          <div class="blankOne width255">
            <div class="greenDiv">Special Package Price</div>
            <div class="grayDiv">Worth Rs.</div>
            
          </div>
          <div class="actionDiv">
            <div class="top">
              <div class="inr">INR<font>999</font></div>
              <div class="inr1"><strike>INR</strike><font><strike>3500</strike></font></div>
              
            </div>
            <a href="<?php echo SITE_URL;?>tests/my_cart/1/package"><?php echo $html->image('frontend/enquire-Now.gif',array('alt'=>'Enquire Now','class'=>'actButt'));?></a></div>
          <div class="actionDiv width160">
            <div class="top">
              <div class="inr">INR<font>1499</font></div>
              <div class="inr1"><strike>INR</strike><font><strike>5500</strike></font></div>
              
            </div>
            <a href="<?php echo SITE_URL;?>tests/my_cart/2/package"><?php echo $html->image('frontend/enquire-Now.gif',array('alt'=>'Enquire Now','class'=>'actButt'));?></a></div>
          <div class="actionDiv width160 borderNone">
            <div class="top">
              <div class="inr">INR<font>2499</font></div>
              <div class="inr1"><strike>INR</strike><font><strike>8500</strike></font></div>
              
            </div>
            
			<a href="<?php echo SITE_URL;?>tests/my_cart/3/package"><?php echo $html->image('frontend/enquire-Now.gif',array('alt'=>'Enquire Now','class'=>'actButt'));?></a>
			</div>
       
        </div>
      </div>
      