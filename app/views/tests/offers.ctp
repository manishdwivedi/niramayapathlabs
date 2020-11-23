<?php /*Offers*/ ?>
<div class="location_div CurrentOpenings">
<div class="centring">
<div class="graynavigation">
  <ul>
     <li><a href="/"><span itemprop="name">Home</span></a></li>
     <li class="list"> <span> Special Offers</span></li>
  </ul>
</div>
<div class="sliderOpening"> <img src="/img/covid/special-offer.jpg" alt="career" class="list"></div><div class="clr"></div><br>
<div class="clr divid"></div>
<div class="right2 right"> 
  <ul id="ulpaging">
    <div>
    <?php $counter=0; foreach($banners as $key => $val) { ?>
    <li>
    <div class="greyBox">
      <h3><?php echo ++$counter; ?>. <?php echo $val['Banner']['banner_name'];?></h3>
      <div class="bot">
        <div class="ReportParameter">
          <p title="Banner"><a href="<?php SITE_URL;?>/tests/my_cart/<?php echo $val['Banner']['id'];?>/banner"><?php echo $this->Html->image('/img/offers/'.$val['Banner']['banner_image'],array('alt'=>'JanAid Offers','title'=>'JanAid Offers', 'width'=>'100%'))?> </a></p>
          <p title="Code"><i class="fa fa-barcode"></i> <?php echo $val['Banner']['banner_code']; ?></p>
          <p title="Name/Description"><i class="fa fa-info-circle"></i> <?php echo $val['Banner']['banner_name']; ?></p>
          <p title="Reporting Time"><i class="fa fa-history"></i> <?php echo $val['Banner']['banner_reporting']; ?></p>
        </div>
        <div class="IncludesBorder2">
        <div class="pretestBoxz"></div>
        <div class="phelp"><span><i class="fa fa-inr"></i><?php echo $val['Banner']['banner_mrp']; ?></span></div>
        <?php if(!empty($val['Banner']['banner_market_mrp'])) { ?>
        <div class="biggerPrice"><span class="bigger"><i class="fa fa-inr"></i> <?php echo $val['Banner']['banner_market_mrp']; ?>
        </span></div>
        <?php } ?>
        <div class="LabBtn">
          <?php echo $html->link('Add to Cart',array('controller'=>'tests','action'=>'my_cart',$val['Banner']['id'],'banner'),array('escape'=>false)); ?></div> 
        </div>
    </div>
    </div>
  
</li>
<?php $i++; } ?>
<li>
    <div class="greyBox">
      <h3>6. Covid19 IMMUNITY SHIELD 1</h3>
      <div class="bot">
        <div class="ReportParameter">
          <p title="Banner"><a href="<?php SITE_URL;?>/tests/my_cart/120060"><?php echo $this->Html->image('/img/covid/special-offers/immunity_shield.jpeg',array('alt'=>'JanAid Offers','title'=>'JanAid Offers', 'width'=>'100%'))?> </a></p>
          <p title="Code"><i class="fa fa-barcode"></i> COV105</p>
          <p title="Name/Description"><i class="fa fa-info-circle"></i> Covid19 IMMUNITY SHIELD 1 (COV2IgG, Vitamin D & B12)</p>
          <p title="Reporting Time"><i class="fa fa-history"></i> 24 Hrs</p>
        </div>
        <div class="IncludesBorder2">
        <div class="pretestBoxz"></div>
        <div class="phelp"><span><i class="fa fa-inr"></i>1499</span></div>
        <div class="biggerPrice"><span class="bigger"><i class="fa fa-inr"></i> 2999</span></div>
        <div class="LabBtn">
          <?php echo $html->link('Add to Cart',array('controller'=>'tests','action'=>'my_cart','120060'),array('escape'=>false)); ?></div> 
        </div>
    </div>
    </div>
  
</li>
</div>
</ul>
<div class="clr"></div>
</div>
 <style>
  .CurrentOpenings .right2 p {
    margin-bottom: 0px;
    line-height: 1.2em;
}
 </style>    
 </div>
</div>
<div class="clr"></div> <br> <br>  
        
         
      