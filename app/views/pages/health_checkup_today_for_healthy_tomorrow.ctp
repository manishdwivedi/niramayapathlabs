
<!--bodycontainer div start here-->
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_why_us.jpg',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'))?></div>
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
            <div class="bread"><?php echo $this->Html->link('Health Checkup Today for Healthy Tomorrow','javascript:void(0);');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<h1>Health Checkup Today for Healthy <span class="green">Tomorrow</span></h1>
<div style="clear:both;"></div>
<?php e($html->image('health_checkup_today_for_healthy_tomorrow1.jpg',array('style'=>'margin-top:10px;','width'=>1000))); ?>
<div style="text-align: center;margin-top:10px;"><?php e($html->link($html->image('frontend/enquire-Now.gif'),array('controller'=>'tests','action'=>'my_cart',10,'package'),array('escape'=>false))); ?></div>