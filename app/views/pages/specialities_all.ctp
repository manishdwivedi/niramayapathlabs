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

<!--bodycontainer div start here-->
<!--<h1><?php //echo $data[0]['Pagelocale']['title'];?><span class="green">niramaya</span></h1>-->
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_contact_us-2.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
  <div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home">Home Page</div>
          <div class="bread"><?php echo $this->Html->link('Specialities','/pages/specialities_all');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>

<h1>Specialities</h1>
<div class="row">
<div class="left">Dentist</div>
<div class="middle">Gynecologist/obstetrician</div>
<div class="right">General Physician</div>
</div>
<div class="row">
<div class="left">Homeopath</div>
<div class="middle">Pediatrician</div>
<div class="right">Orthopedist</div>
</div>
<div class="row">
<div class="left">Ophthalmologist</div>
<div class="middle">Dermatologist/cosmetologist</div>
<div class="right">General Surgeon</div>
</div>
<div class="row">
<div class="left">Ear-nose-throat (ent) Specialist</div>
<div class="middle">Physiotherapist</div>
<div class="right">Cardiologist</div>
</div>
<div class="row">
<div class="left">Ayurveda</div>
<div class="middle">Spa</div>
<div class="right">Oral Surgeon</div>
</div>
<div class="row">
<div class="left">Psychiatrist</div>
<div class="middle">Cosmetic/plastic Surgeon</div>
<div class="right">Radiologist</div>
</div>
<div class="row">
<div class="left">Urologist</div>
<div class="middle">Gastroenterologist</div>
<div class="right">Anesthesiologist</div>
</div>
<div class="row">
<div class="left">Neurologist</div>
<div class="middle">Internal Medicine</div>
<div class="right">Pathologist</div>
</div>
<div class="row">
<div class="left">Veterinarian</div>
<div class="middle">Pulmonologist</div>
<div class="right">Oncologist</div>
</div>
<div class="row">
<div class="left">Dietitian/nutritionist</div>
<div class="middle">Surgeon</div>
<div class="right">Diabetologist</div>
</div>
<div class="row">
<div class="left">Nephrologist</div>
<div class="middle">Neurosurgeon</div>
<div class="right">Psychologist</div>
</div>
<div class="row">
<div class="left">Saloon</div>
<div class="middle">Alternative Medicine</div>
<div class="right">Endocrinologist</div>
</div>
<div class="row">
<div class="left">Speech Therapist</div>
<div class="middle">Hair Transplant Surgeon</div>
<div class="right">Acupuncturist</div>
</div>
<div class="row">
<div class="left">Wellness</div>
<div class="middle">Sexologist</div>
<div class="right">Bariatric Surgeon</div>
</div>
<div class="row">
<div class="left">Audiologist</div>
<div class="middle">Emergency & Critical Care</div>
<div class="right">Gynecologic Oncologist</div>
</div>
<div class="row">
<div class="left">Rheumatologist</div>
<div class="middle">Spine And Pain Specialist</div>
<div class="right">Vascular Surgeon</div>
</div>
<div class="row">
<div class="left">Yoga And Naturopathy</div>
<div class="middle">Venereologist</div>
<div class="right">Rehab & Physical Medicine Specialist</div>
</div>
<div class="row">
<div class="left">Occupational Therapist</div>
<div class="middle">Obesity Specialist</div>
<div class="right">Aesthetic Surgeon</div>
</div>
<div class="row">
<div class="left">Sports Medicine Specialist</div>
<div class="middle">Allergist/immunologist</div>
<div class="right">Oral Pathologist</div>
</div>
<div class="row">
<div class="left">Unani</div>
<div class="middle">Podiatrist</div>
<div class="right">Oral Medicine And Radiology</div>
</div>
<div class="row">
<div class="left">Integrated Medicine</div>
<div class="middle">Anesthesia And Pain Medicine</div>
<div class="right">Nuclear Medicine Physician</div>
</div>
<div class="row">
<div class="left">Toxicologist</div>
<div class="middle">Somnologist</div>
<div class="right">Hematologist</div>
</div>
<div class="row">
<div class="left">Geneticist</div>
<div class="middle">Geriatrician</div>
<div class="right">Tcm Physician (traditional Chinese Medicine)</div>
</div>
<div class="row">
<div class="left">Derma</div>
<div class="middle">Aesthetic Medicine </div>
</div>

<?php /*?><div class="bodycontainer">

	<div class="bodycontainer_inner"> 
    
    <!--Artist page div start here--> 
    
    	<div class="innercontainer">
        
        	<div class="innercontainer_top">
            	<h1><?php //echo ucwords($userdetail['Member']['name']);?></h1>
            </div>
            
            <div class="innercontainer_bottom">
            	<div class="innercontainer_bottom_left">
                	<?php echo $this->element('artistuser');?>
                </div>
                <div class="innercontainer_bottom_right">
                
                	
                    
                    <div class="innercontainer_bottom_right_row2">
                    	<div class="innercontainer_bottom_right_row2_top">
                        	<div class="innercontainer_bottom_right_row2_top_left" style="width:196px;">
                            	<h1><?php echo $data[0]['Pagelocale']['title'];?></h1>
                            </div>
                            <div class="innercontainer_bottom_right_row2_top_right">
                            	&nbsp;
                            </div>
                        </div>
                        <div class="innercontainer_bottom_right_row2_bottom">
							<?php echo $data[0]['Pagelocale']['content'];?>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
            
        </div>
     
    <!--Artist page div end here-->
    
    </div>
    
</div><?php */?>

<!--bodycontainer div end   here-->