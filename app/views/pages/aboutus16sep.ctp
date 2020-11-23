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
<?php echo $data[0]['Pagelocale']['content'];?>
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