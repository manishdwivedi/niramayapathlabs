<?php //echo "<pre>gdfgdfgdf"; print_r($userdetail); exit;?>

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
            <div class="bread"><?php echo $this->Html->link('Affordable Preventive Healthcare for All','javascript:void(0);');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<h1>Affordable Preventive Healthcare <span class="green">for All</span></h1>

<?php e($html->image('affordable_preventive_healthcare.jpg',array('margin-top:10px;'))); ?>
<div style="text-align: center;margin-top:10px;"><?php e($html->link($html->image('frontend/enquire-Now.gif'),array('controller'=>'tests','action'=>'my_cart',921),array('escape'=>false))); ?></div>