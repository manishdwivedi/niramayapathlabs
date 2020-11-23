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
          <div class="bread"><?php echo $this->Html->link('About Us','/pages/company_overview');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>

<h1>About <span class="green">US</span></h1>
<h2>Company <span class="green">Overview</span></h2>
<p>Niramaya Healthcare is a Noida based upcoming Diagnostic and Wellness service provider with presence in Noida and Ghaziabad (Indirampuram and Crossings Republik). We are committed to provide services of best quality ( in terms of accuracy, reliability, turnaround time as well as excellent customer care) at a very affordable cost.</p>
<p>The Health check-up packages designed / developed by our team of experts, aims at preserving and promoting good health, preventing diseases and disabilities by facilitating early diagnosis.</p>
<p>At nirAmaya Healthcare, the customer is at the centre of everything that we do.</p>
<h2>Management <span class="green">Team</span></h2>
<p>Dr. Priyanka Pathak MBBS, MD (Gynae) is an alumnus of MKCG and has valuable experience in Gynae and overall patient care. Together the Directors are committed to the cause of Healthcare and bring in their best experience to nirAmaya Healthcare.</p>
<p>Mr. Ashok Pathak is Co-Founder &amp; MD of nirAmaya Healthcare with a vast experience of more than two decades in setting up &amp; managing large infrastructure projects across India for HCL &amp; Tech Mahindra with a passion to deliver &amp; operate world-class infrastructure.</p>
<p>Mr. Sanjeev Malhotra is Co-Founder &amp; CEO of nirAmaya Healthcare with 17+ years of experience of managing operations in India &amp; US for ITeS companies &amp; Hotels spread across multiple locations involving Infrastructure Development, Facility Management, Employee Services &amp; Hotel Management verticals with a strong focus on cost effective operations &amp; ensuring Employee / Guest satisfaction.</p>
<p>Mr. Manoj Kr. Dudeja is Director of nirAmaya Healthcare with a vast experience of more than two decades in setting up &amp; managing large infrastructure projects for different industries viz., IT, ITES, Logistics and Distribution, Media, Manufacturing. He brings to the table a strong work ethic, project focus and excellent man-management skills.</p>
<p>Mr. Prakash Sharma is Director of nirAmaya Healthcare with 9+ years of experience in General Insurance and Telecom companies with expertise in Team Management, People Management, Customer Service, MIS Management, Retail Underwriting, State Operations/Reconciliation and TAT/SLA Management.</p>
<h2>Vision <span class="green">Mission Values </span></h2>
<h2>Mission&nbsp;</h2>
<p>To be the &quot;First Choice&quot;&Acirc;ù  Diagnostic and Wellness Service Provider.</p>
<h2>Vision&nbsp;</h2>
<p>Professional and Caring people dedicated to improve health of all our patients with best in class diagnosis services.</p>
<h2>Values</h2>
<p>Professionalism in all spheres of activities achieved through deployment of 'Experts' in all fields. Develop and maintain the highest standards of professionalism backed by continuous learning and improvement.</p>
<h2>Quality</h2>
<p>The patient comes first in everything we do. We strive to provide every patient and every customer with services and products of uncompromising quality - error free, on time, every time. We do that by dedicating ourselves to the relentless pursuit of excellence in the services we provide.</p>
<h2>Integrity</h2>
<p>Credibility is the key to our success; therefore, all of our processes, decisions and actions ultimately are driven by integrity. We are honest and forthright in all our dealings with our customers and with each other. We are responsible corporate citizens in the community we serve. We strictly comply with the laws and regulations governing our business, not only as a legal obligation and as a competitive necessity, but because it is the right thing to do.</p>
<h2>Innovation</h2>
<p>We constantly seek innovative ways to enhance patient care and provide value to our customers. We support the creativity, courage and persistence that transform information into knowledge, and knowledge into insights. We seek continuous learning through the adaptation of existing knowledge, as well as through experimentation, with the full understanding that we learn from our failures as well as our successes.</p>
<h2>Accountability</h2>
<p>As a company and as individuals, we accept full responsibility for our performance and acknowledge our accountability for the ultimate outcome of all that we do. We strive for continuous improvement, believing that competence, reliability, and rigorous adherence to process discipline are the keys to excellence.</p>
<h2>Collaboration</h2>
<p>We believe in teamwork and the limitless possibilities of collaborative energy. We achieve excellence by putting collective goals ahead of personal interests. We support and encourage open communication and meaningful cooperation among colleagues from varying backgrounds and disciplines. We respect individual differences, and we value diversity.</p>
<h2>Leadership</h2>
<p>We strive to be the best at what we do - both as a company, and as individuals. We embrace the qualities of personal leadership - courage, competence, confidence and a passion for surpassing expectations. We will provide growth opportunities for our employees, quality services and products to our customers and superior returns to our shareholders.</p>
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