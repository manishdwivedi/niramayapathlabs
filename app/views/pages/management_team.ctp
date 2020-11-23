<?php //echo "<pre>gdfgdfgdf"; print_r($userdetail); exit;?>
<style type="text/css">
.submit {
float:left;
margin:10px 10px 0px 0px;
}
.innercontainer_bottom_right_row2{
padding:0;
}
</style>
<script type="text/javascript">
function listing(){
window.location.href=siteUrl+"members/register";
return false;
}

function upload_resume(user)
{
	//alert(user);
	if(user == 'R')
	{
		jQuery('#resumediv').show();
		jQuery('#aboutdiv').show();
	}
}
</script>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_management_team-2.jpg',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'))?></div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
  
<!--bodycontainer div start here-->
<div id="bodyPart">
    <div class="bodyInnerDiv">
    <div class="breadcrumbs"><div class="left"><div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div><div class="bread"><a href="<?php echo SITE_URL;?>pages/company_overview">About Us</a></div> <div class="bread"><a href="<?php echo SITE_URL;?>pages/management_team">Management Team</a></div></div>    
    <div class="back right"><a href="<?php echo SITE_URL;?>pages/company_overview">Back</a></div>
    </div>
    
    
    <h1>Management <span class="green">Team</span></h1>
  	<!--<div id="advanceSearch"><h4>Search / Book a Test</h4>
			  <?php //echo $form->create(null, array('url'=>'/tests/search_keyword_home','id'=>'form1','name'=>'form1')); ?>
			  <?php //echo $form->text('Search.test_search',array('placeholder'=>'Type Keyword...'));?>
			  <input type="image" src="<?php //echo SITE_URL;?>img/frontend/go.jpg" class="go" style="cursor:pointer;" />
			  <div class="or">Or</div>
			  <div class="advanceSearch"><a href="<?php //echo SITE_URL;?>tests/search" style="color:#EE8012;">Advance Search</a></div>
			  <?php //echo $form->end();?>
		  </div>-->
  
  <div class="magTeam">
  <div class="imgBox"><?php echo $html->image('frontend/members/1.jpg',array('alt'=>'Management Team'));?></div>
  <div class="textbox">
  <h3>Dr. Dinesh Rakheja<br/>
</h3>
  <p>Dr. Dinesh Rakheja - a Gold Medallist for MD (Medicine) and MBBS from LLRM MedicalCollege. Dr.Rakheja has an experience of over thirty years in the field of Medicine. He has been visiting consultant for various Hospitals and Nursing Homes. Currently he is a visiting consultant in International Medicine for Paras Group. NirAmaya is proud to have him as part of their vision of being world class.</p>
  </div>
  
  </div>
  <div class="magTeam">
  <div class="imgBox"><?php echo $html->image('frontend/members/2.jpg',array('alt'=>'Management Team'));?></div>
  <div class="textbox">
  <h3>Dr. Dinesh Pradhan<br/>
</h3>
  <p>Dr. Dinesh Pradhan - is an alumnus of PGI, Chandigarh, where he did his MD and fellowships in varied specialities of pathology. He is also a Diplomate of National Board (D.N.B.), Pathology. He is ECFMG certified from Philadelphia, USA and had received fellowship in advanced molecular cancer detection fromMedinnovation, Gmbh, Berlin, Germany. Dr.Pradhan has garnered expertise in varied areas of Pathology including Histopathology, Cytology and Gynaecological pathology, His work on Renal Cell Carcinoma and Breast carcinoma has received international acclaim.</p>
  </div>
  
  </div>
  <div class="magTeam">
  <div class="imgBox"><?php echo $html->image('frontend/members/3.jpg',array('alt'=>'Management Team'));?></div>
  <div class="textbox">
  <h3>Dr. Priyanka Pathak<br/>
</h3>
  <p>Dr. Priyanka Pathak - MBBS, MD (Gynae) is an alumnus of MKCG and has over ten years of valuable experience in Gynae and overall patient care. Known for her focus on patient management, we are proud to have her as part of NirAmaya team</p>
  </div>
  
  </div>
  <div class="magTeam">
  <div class="imgBox"><?php echo $html->image('frontend/members/4.jpg',array('alt'=>'Management Team'));?></div>
  <div class="textbox">
  <h3>Sanjeev Kumar Malhotra<br/>
</h3>
  <p>Sanjeev Kumar Malhotra - Director of NirAmaya Healthcare with close to seventeen years of experience in managing operations in India and US. He has a very strong focus on implementing and managing cost effective operations with very high Employee / Customer satisfaction. Sanjeev is in charge of managing the core operations at NirAmaya.</p>
  </div>
  
  </div>
  
  <div class="magTeam">
  <div class="imgBox"><?php echo $html->image('frontend/members/5.jpg',array('alt'=>'Management Team'));?></div>
  <div class="textbox">
  <h3>Anish Rakheja<br/>
</h3>
  <p>Anish Rakheja - A visionary having experience of over two decades, Mr.Rakheja as our Director brings to the group his vision of a truly Global company. Having worked with many MNCs, his focus is on ensuring internalization of strong processes that is critical to providing truly unique customer experience with high focus on Quality.</p>
  </div>
  
  </div>
  
  
 
 <div class="bottomShadow"></div>    

    </div>
  </div>