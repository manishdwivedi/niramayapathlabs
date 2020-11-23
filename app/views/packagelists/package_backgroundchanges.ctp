<?php ?>
<script language="JavaScript" type="text/javascript">
function content_show(val)
{
	document.getElementById(val).style.display = 'block';
}
$(document).ready(function(){
	$(".test_open_close").click(function(){
		var childID = $(this).attr('lang');
		//$(".test_desc_open_close").hide();
		$("#"+childID).toggle();
	});
});
</script>
<div class="location_div">
<div class="centring">
<div class="graynavigation gap">
  <ul>
     <li><a href="/"><span itemprop="name">Home</span></a></li>
     <li class="list"> <span> Preventive health check up packages</span></li>
  </ul>
</div>
<div class="clr divid"></div>
<br>
<div class="right2 right tabData" style="margin: 0 auto;float: none;"> 
<div class="tableDiv mobhide" id="package_table" style="overflow-x:auto;">
	 <table width="100%" border="0" cellspacing="1" cellpadding="0">
		<?php 
			for($i=0;$i<5;$i++){
				echo "<tr>";
				foreach($packageList as $key=>$value)
				{
					
					if($i==1)
					{
						if($key == 0)
						echo "<td colspan='2'  width='25%' style='font:bold 13px arial;'>Profile / Test code</td>";
						echo "<td width='12%'>".$value['PackageList']['package_code']."</td>";
					}
					if($i==0)
					{
						if($key == 0)
						echo "<td colspan='2' style='font:bold 13px arial;text-align:left;padding:10px;background:none repeat scroll 0 0 #cfea9d;'>nirAmaya Preventive Health Checkup Packages</td>";
						echo "<td style='font:bold 13px arial;padding:0;'>";
						echo $this->Html->image('packagelist/'.$value['PackageList']['package_code'].".jpg", array('width'=>'100%;'));
					
						
						"</td>";
					}
					if($i==2)
					{
						if($key == 0)
						echo "<td colspan='2' style='font:bold 13px arial;text-align:left;padding:10px;background:none repeat scroll 0 0 #cfea9d;'>Test Parameters tested in the package</td>";
						echo "<td class='".$value['PackageList']['package_class']."'>".$value['PackageList']['total_test']."</td>";
					}
					if($i==3)
					{
						if($key == 0)
						echo "<td colspan='2' style='font:bold 13px arial;text-align:left;padding:10px;background:none repeat scroll 0 0 #fff;'>Highlights of the package</td>";
						echo "<td style='text-align:justify;padding:5px;vertical-align:top;background:#fff;'>".$value['PackageList']['highlights']."</td>";
					}
					if($i==4)
					{
						if($key == 0) 
						echo "<td colspan='2' style='font:bold 13px arial;text-align:left;padding:10px;background:none repeat scroll 0 0 #cfea9d;'>Recommendation</td>";
						echo "<td style='text-align:justify;padding:5px;vertical-align:top;' class='".$value['PackageList']['package_class']."'>".$value['PackageList']['recommendation']."</td>";
					}
				}
				echo "</tr>";
			}
			//start of printing test name and its status package wise
			foreach($packageListTest as $key=>$value)
			{
				$bgclass=($key % 2);
				echo "<tr>";
				echo "<td class='bg$bgclass'>".$value['PackageListTest']['sr_no']."</td>";
				echo "<td class='bg$bgclass' style='font:bold 13px arial;'>";
				?>
					<span style="cursor:pointer;text-align:left;" class="test_open_close bullPoint" id="test<?php echo $value['PackageListTest']['id']; ?>" lang="testdiv<?php echo $value['PackageListTest']['id']; ?>"><?php echo $value['PackageListTest']['profile_test']; ?></span>
					<div style="display:none;margin:8px 0 0 10px;" class="test_desc_open_close" id="testdiv<?php echo $value['PackageListTest']['id']; ?>"><?php echo $value['PackageListTest']['profile_description']; ?></div>
				<?php
				echo "</td>";
				foreach($packageList as $key1=>$value1)
				{
					echo "<td class='bg$bgclass'>";
					$test_status="";
					foreach($packageListTestItem as $key2=>$value2)
					{
						if($value['PackageListTest']['id'] == $value2['PackageListTestItem']['package_test_id'] && $value2['PackageListTestItem']['package_id'] == $value1['PackageList']['id'])
						{
							if($value2['PackageListTestItem']['status']==1)
								$test_status="yes.png";
							else
								$test_status="no.png";
						}
						
					}
					if($test_status != "")
						echo $html->image('frontend/'.$test_status);
					echo "</td>";
				}
				echo "</tr>";
			}
			//start of printing price section
			echo "<tr>";
			?>
			<td colspan="2" class="priceBox">
				<div class="blankOne">
					<div class="greenDiv">Special Package Price</div>
					<div class="grayDiv">Worth Rs.</div>
					<div class="greenDiv" style="margin-bottom:15px;">Saving on Spl Package</div>
				</div>
			</td>
			<?php foreach($packageList as $key=>$value){ ?>
			<td>
				<div class="actionDiv">
					<div class="top">
					  <div class="inr">INR<font><?php echo $value['PackageList']['offer_price']; ?></font></div>
					  <div class="inr1"><strike>INR</strike><font><strike><?php echo $value['PackageList']['package_mrp']; ?></strike></font></div>
					  <div class="inr"><font><?php echo $value['PackageList']['saving_percent']; ?></font></div>
					</div>
					<a href="/tests/my_cart/<?php echo $value['PackageList']['id']; ?>/package"><img class="actButt" alt="Enquire Now" src="/img/frontend/enquire-Now.gif"></a>
				</div>
			</td>
			<?php } 
			echo "</tr>";
		?>
	</table>
</div>


<div class="packageOnMobile">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion({
      heightStyle: "content",
      collapsible: true,
      active: false
    });
  } );
  </script>

<div id="accordion">
  <h3>Nirmaya Vital Health CheckUp (78 Test)</h3>
  <div>
  	   <p><img src="/img/packagelist/P160.jpg" width="100%" alt=""></p>
       <p>Profile / Test code :P160</p>
       <p>Test Parameters tested in the package :78 Tests</p>
       <p>Highlights of the package :Check of vital parameters & Vital organs like Heart, Liver, Kidney, Thyroid of your body & more..</p>
       <p>Recommendation :Once Every 2 Year</p>
       <p>Thyroid (T3 T4 TSH) - 3 Tests</p>
       <p>Heart Risk Profile (Lipid) - 9 Tests</p>
       <p>Liver Function Test (LFT) - 11 Tests</p>
       <p>Kidney Function Test (Basic) - 6 Tests</p>
       <p>Vitals Check (Blood Sugar & BP Check) - 3 Tests</p>
       <p>Complete Haemogram (CBC With P/S & ESR) - 26 Tests</p>
       <p>Complete Urine Routine Analysis (CUE) - 20 Tests</p> 
        
       <p>Worth Rs. - <span>INR 3000</span></p> 
       <p>Saving on Spl Package - 60%</p>
       <p>Special Package Price - <b>INR 1199</b></p> 
       <p><a href="/tests/my_cart/10/package"><img class="actButt" alt="Enquire Now" src="/img/frontend/enquire-Now.gif"></a></p> 
  </div>


  <h3>Nirmaya Wholebody Health CheckUp (103 Test)</h3>
  <div>
  	   <p><img src="/img/packagelist/P159.jpg" width="100%" alt=""></p>
       <p>Profile / Test code :P159</p>
       <p>Test Parameters tested in the package :97 Tests</p>
       <p>Highlights of the package :Complete vital Health Checkup along with Diabetes, HBA1c, Bone profile with RA Factor/ Ionized Calcium & more..</p>
       <p>Recommendation :Once Every Year</p>
       <p>Thyroid (T3 T4 TSH) - 3 Tests</p>
       <p>Heart Risk Profile (Lipid) - 9 Tests</p>
       <p>Liver Function Test (LFT) - 11 Tests</p>
       <p>Kidney Function Test (Basic) - 6 Tests</p>
       <p>Vitals Check (Blood Sugar & BP Check) - 3 Tests</p>
       <p>Complete Haemogram (CBC With P/S & ESR) - 26 Tests</p>
       <p>Complete Urine Routine Analysis (CUE) - 20 Tests</p> 
       <p>Iron Studies (for Anemia Screening) - 5 Tests</p> 
       <p>Electrolyte Plus Profile (Na, K, CL & Ca+) - 4Tests</p> 
       <p>Diabetes Monitoring Profile (with HBA1c) - 5 Tests</p> 
       <p>Arthritis Screen (Bone Profile with RA-Factor) - 4 Tests</p> 

        
       <p>Worth Rs. - <span>INR 6500</span></p> 
       <p>Saving on Spl Package - 69%</p>
       <p>Special Package Price - <b>INR 1999</b></p> 
       <p><a href="/tests/my_cart/11/package"><img class="actButt" alt="Enquire Now" src="/img/frontend/enquire-Now.gif"></a></p> 
  </div>




  <h3>Nirmaya Executive Health CheckUp (103 Test)</h3>
  <div>
  	   <p><img src="/img/packagelist/P161.jpg" width="100%" alt=""></p>
       <p>Profile / Test code :P161</p>
       <p>Test Parameters tested in the package :99 Tests</p>
       <p>Highlights of the package :Complete body with all vital organs & parameters along with Diabetes, HBA1c, Vitamin D / B12, Bone profile with RA Factor/ Ionized Calcium & more...</p>
       <p>Recommendation :Once Every Year</p>
       <p>Thyroid (T3 T4 TSH) - 3 Tests</p>
       <p>Heart Risk Profile (Lipid) - 9 Tests</p>
       <p>Liver Function Test (LFT) - 11 Tests</p>
       <p>Kidney Function Test (Basic) - 6 Tests</p>
       <p>Kidney Function Test (Basic) - 6 Tests</p>
       <p>Diabetes Monitoring Profile (with HBA1c) - 5 Tests</p>
       <p>Arthritis Screen (Bone Profile with RA-Factor) - 4 Tests</p>
       <p>Vitals Check (Blood Sugar & BP Check) - 3 Tests</p>
       <p>Complete Haemogram (CBC With P/S & ESR) - 26 Tests</p>
       <p>Complete Urine Routine Analysis (CUE) - 20 Tests</p> 
       <p>Iron Studies (for Anemia Screening) - 5 Tests</p> 
       <p>Electrolyte Plus Profile (Na, K, CL & Ca+) - 4 Tests</p> 
       <p>Vital Vitamins Profile (B12 & D3 - 25 Hydroxy) - 2 Test</p> 
       <p>Diabetes Monitoring Profile (with HBA1c) - 5 Tests</p> 
       <p>Arthritis Screen (Bone Profile with RA-Factor) - 4 Tests</p> 
       
       <p>Worth Rs. - <span>INR 8500</span></p> 
       <p>Saving on Spl Package - 65%</p> 
       <p>Special Package Price -<b> INR 2999</b></p> 
       <p><a href="/tests/my_cart/12/package"><img class="actButt" alt="Enquire Now" src="/img/frontend/enquire-Now.gif"></a></p> 
  </div>
 


  <h3>Nirmaya Wholebody Comprehensive CheckUp (103 Test)</h3>
  <div>
  	   <p><img src="/img/packagelist/P161.jpg" width="100%" alt=""></p>
       <p>Profile / Test code :P161</p>
       <p>Test Parameters tested in the package :99 Tests</p>
       <p>Highlights of the package :Complete body with all vital organs & parameters along with Diabetes, HBA1c, Vitamin D / B12, Bone profile with RA Factor/ Ionized Calcium & more...</p>
       <p>Recommendation :Once Every Year</p>
       <p>Thyroid (T3 T4 TSH) - 3 Tests</p>
       <p>Heart Risk Profile (Lipid) - 9 Tests</p>
       <p>Liver Function Test (LFT) - 11 Tests</p>
       <p>Kidney Function Test (Basic) - 6 Tests</p>
       <p>Vitals Check (Blood Sugar & BP Check) - 3 Tests</p>
       <p>Complete Haemogram (CBC With P/S & ESR) - 26 Tests</p>
       <p>Complete Urine Routine Analysis (CUE) - 20 Tests</p> 
       <p>Iron Studies (for Anemia Screening) - 5 Tests</p> 
       <p>Electrolyte Plus Profile (Na, K, CL & Ca+) - 4 Tests</p> 
       <p>Vital Vitamins Profile (B12 & D3 - 25 Hydroxy) - 2 Test</p> 
       <p>Diabetes Monitoring Profile (with HBA1c) - 5 Tests</p> 
       <p>Arthritis Screen (Bone Profile with RA-Factor) - 4 Tests</p> 
       <p>Infection Screening (HCV & HBsAg) - 2 Tests</p> 
       <p>Cancer Screening (for Male or Female) -1 Tests</p> 
       <p>Allergy Screening (Total IgE) -1 Tests</p> 

       
       <p>Worth Rs. - <span>INR 12000</span></p> 
       <p>Saving on Spl Package - 50%</p> 
       <p>Special Package Price - <b>INR 5999</b></p> 
       <p><a href="/tests/my_cart/13/package"><img class="actButt" alt="Enquire Now" src="/img/frontend/enquire-Now.gif"></a></p> 
  </div>
 




	
</div>


<style type="text/css">
.packageOnMobile p{	
	border-left: 1px solid #d5d5da;
    border-right: 1px solid #d5d5da;
    border-top: 1px solid #d5d5da;
    border-bottom: 1px solid #d5d5da;
    padding: 11px;
    text-align: -webkit-center;
}
.packageOnMobile span{
	text-decoration: line-through;
}
	
.priceBox div.greenDiv{
	background: url("../img/frontend/green-arrow-1.jpg") no-repeat scroll right 8px rgba(0, 0, 0, 0);
    clear: both;
    color: #60aa1d;
    float: right;
    font: 18px arial;
    margin: 15px 10px 0 0;
    padding: 0 15px 0 0;
    width: auto;
}
.priceBox div.grayDiv{
	background: url("../img/frontend/bull-Point.png") no-repeat scroll right 8px rgba(0, 0, 0, 0);
    clear: both;
    color: #999999;
    float: right;
    font: 18px arial;
    margin: 20px 10px 0 0;
    padding: 0 15px 0 0;
    width: auto;
}
.tableDiv table td {
    background: #fff;
    padding: 10px 0;
    text-align: center;
    font-size: small;
}
.inr font {
    font: 28px arial;
	margin:0;
	padding:0;
}
.inr {
    font: 16px arial;
	margin:15px 0 0 0px;
	padding:0;
}
.inr1{
	margin:15px 0 0 0px;
	padding:0;
}
.location_div .right ul {
	text-align: -webkit-left;
    color: dimgrey;
}
ul li{
text-align:left;
}
.P170{background:none repeat scroll 0 0 #ffeae9 !important;}
.P171{background:none repeat scroll 0 0 #f4e8ff !important;}
.P172{background:none repeat scroll 0 0 #edffcd !important;}
.P173{background:none repeat scroll 0 0 #fff4d4 !important;}
.P175{background:none repeat scroll 0 0 #e9fbff !important;}
.P177{background:none repeat scroll 0 0 #ffeff9 !important;}
.bullPoint {
    float: left;
    width: auto;
    clear: both;
    font: bold 12px arial;
    background: url(../img/frontend/bull-Point.png) no-repeat 0 3px;
    padding: 0 0 0 10px;
    margin: 5px 0 0 10px;
    cursor: pointer;
}
.bg0 {
    background: #f9f8f8 !important
}
</style>
<div class="clr"></div>
</div>
        
 </div>
</div>
<div class="clr"></div><br>