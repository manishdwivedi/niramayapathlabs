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
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'))?></div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
  <div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><?php echo $this->Html->link('Home Page','/pages/index');?></div>
          <div class="bread"><?php echo $this->Html->link('Testimonials','/pages/testimonials');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<!--bodycontainer div start here-->
<h1>Testimonials</h1>

<!--<div id="advanceSearch"><h4>Search / Book a Test</h4>
			  <?php //echo $form->create(null, array('url'=>'/tests/search_keyword_home','id'=>'form1','name'=>'form1')); ?>
			  <?php //echo $form->text('Search.test_search',array('placeholder'=>'Type Keyword...'));?>
			  <input type="image" src="<?php //echo SITE_URL;?>img/frontend/go.jpg" class="go" style="cursor:pointer;" />
			  <div class="or">Or</div>
			  <div class="advanceSearch"><a href="<?php //echo SITE_URL;?>tests/search" style="color:#EE8012;">Advance Search</a></div>
			  <?php //echo $form->end();?>
		  </div>-->
<?php echo $data['Pagelocale']['content'];?>