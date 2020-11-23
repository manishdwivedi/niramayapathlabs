<script type="text/javascript">
function show_tab(val)
{
	window.location.href = siteUrl+'pages/doctor_logout';
}
</script>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_dr_module_banner.jpg',array('alt'=>'Banner'))?></div>
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
          <div class="bread"><?php echo $this->Html->link($this->data['Doctor']['title'].' '.$this->data['Doctor']['first_name'].' '.$this->data['Doctor']['last_name'],'/pages/doctor_account');?></div>
        </div>
        
      </div>
      <h1>My <span class="green">Account</span></h1>
	  <div class="subHeading">
		<h2>Professional Details</h2>
		<ul>
		<li><?php echo $html->link('Personal Details',array('controller'=>'pages','action'=>'doctor_account'));?></li>
		<li><?php echo $html->link('Proffessional Details','javascript:void(0);',array('class'=>'act'));?></li>
		<li><?php echo $html->link('Clinics',array('controller'=>'pages','action'=>'clinic'));?></li>
		<li><?php echo $html->link('Appointments',array('controller'=>'pages','action'=>'appointment'));?></li>
		<li><?php echo $html->link('Home Visit Request',array('controller'=>'pages','action'=>'home_visit'));?></li>
		<li class="borderNone padRightNone"><?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab();'));?></li>
		</ul>
		
		
		
		</div>

      <?php echo $form->create(null, array('url'=>'/pages/prof_detail','id'=>'form2','name'=>'form2','onsubmit'=>'return validationc(this);')); ?>
	  <?php echo $form->hidden('Doctor.id',array('value'=>$this->data['Doctor']['id']));?>
        <div class="leftDivOne marTopNone">
        <div class="rowNext">
          <label>Services :</label>
          <div class="rightDivForm" style="clear:both;">
          	<?php if(!empty($doc_detail['Doctor']['service1'])) {?>
				<div class="prof-div"><strong>1-</strong> <?php echo $doc_detail['Doctor']['service1'];?></div>
			<?php }?>
           	<?php if(!empty($doc_detail['Doctor']['service2'])) {?>
				<div class="prof-div"><strong>2-</strong> <?php echo $doc_detail['Doctor']['service2'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['service3'])) {?>
				<div class="prof-div"><strong>3-</strong> <?php echo $doc_detail['Doctor']['service3'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['service4'])) {?>
				<div class="prof-div"><strong>4-</strong> <?php echo $doc_detail['Doctor']['service4'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['service5'])) {?>
				<div class="prof-div"><strong>5-</strong> <?php echo $doc_detail['Doctor']['service5'];?></div>
			<?php }?>
          </div>
          
        </div>
        <div class="rowNext right">
          <label>Specializations :</label>
          <div class="rightDivForm" style="clear:both;">
          	<?php if(!empty($doc_detail['Doctor']['special_1'])) {?>
				<div class="prof-div"><strong>1-</strong> <?php echo $doc_detail['Doctor']['special_1'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['special_2'])) {?>
				<div class="prof-div"><strong>2-</strong> <?php echo $doc_detail['Doctor']['special_2'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['special_3'])) {?>
				<div class="prof-div"><strong>3-</strong> <?php echo $doc_detail['Doctor']['special_3'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['special_4'])) {?>
				<div class="prof-div"><strong>4-</strong> <?php echo $doc_detail['Doctor']['special_4'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['special_5'])) {?>
				<div class="prof-div"><strong>5-</strong> <?php echo $doc_detail['Doctor']['special_5'];?></div>
			<?php }?>
          </div>
          
        </div>
        </div>
        
        
         <div class="leftDivOne">
        <div class="rowNext">
          <label>Education :</label>
          <div class="rightDivForm" style="clear:both;">
          	<?php if(!empty($doc_detail['Doctor']['education1'])) {?>
				<div class="prof-div"><strong>1-</strong> <?php echo $doc_detail['Doctor']['education1'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['education2'])) {?>
				<div class="prof-div"><strong>2-</strong> <?php echo $doc_detail['Doctor']['education2'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['education3'])) {?>
				<div class="prof-div"><strong>3-</strong> <?php echo $doc_detail['Doctor']['education3'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['education4'])) {?>
				<div class="prof-div"><strong>4-</strong> <?php echo $doc_detail['Doctor']['education4'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['education5'])) {?>
				<div class="prof-div"><strong>5-</strong> <?php echo $doc_detail['Doctor']['education5'];?></div>
			<?php }?>
          </div>
          
        </div>
        <div class="rowNext right">
          <label>Experience :</label>
          <div class="rightDivForm" style="clear:both;">
          	<?php if(!empty($doc_detail['Doctor']['experience1'])) {?>
				<div class="prof-div"><strong>1-</strong> <?php echo $doc_detail['Doctor']['experience1'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['experience2'])) {?>
				<div class="prof-div"><strong>2-</strong> <?php echo $doc_detail['Doctor']['experience2'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['experience3'])) {?>
				<div class="prof-div"><strong>3-</strong> <?php echo $doc_detail['Doctor']['experience3'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['experience4'])) {?>
				<div class="prof-div"><strong>4-</strong> <?php echo $doc_detail['Doctor']['experience4'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['experience5'])) {?>
				<div class="prof-div"><strong>5-</strong> <?php echo $doc_detail['Doctor']['experience5'];?></div>
			<?php }?>
          </div>
          
        </div>
        </div>
        
         <div class="leftDivOne">
        <div class="rowNext">
          <label>Awards &amp; Recognitions  :</label>
          <div class="rightDivForm" style="clear:both;">
          	<?php if(!empty($doc_detail['Doctor']['award1'])) {?>
				<div class="prof-div"><strong>1-</strong> <?php echo $doc_detail['Doctor']['award1'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['award2'])) {?>
				<div class="prof-div"><strong>2-</strong> <?php echo $doc_detail['Doctor']['award2'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['award3'])) {?>
				<div class="prof-div"><strong>3-</strong> <?php echo $doc_detail['Doctor']['award3'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['award4'])) {?>
				<div class="prof-div"><strong>4-</strong> <?php echo $doc_detail['Doctor']['award4'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['award5'])) {?>
				<div class="prof-div"><strong>5-</strong> <?php echo $doc_detail['Doctor']['award5'];?></div>
			<?php }?>
          </div>
          
        </div>        
        <div class="rowNext right">
          <label>Memberships :</label>
          <div class="rightDivForm" style="clear:both;">
          	<?php if(!empty($doc_detail['Doctor']['member1'])) {?>
				<div class="prof-div"><strong>1-</strong> <?php echo $doc_detail['Doctor']['member1'];?></div>
			<?php }?>
          	<?php if(!empty($doc_detail['Doctor']['member2'])) {?>
				<div class="prof-div"><strong>2-</strong> <?php echo $doc_detail['Doctor']['member2'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['member3'])) {?>
				<div class="prof-div"><strong>3-</strong> <?php echo $doc_detail['Doctor']['member3'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['member4'])) {?>
				<div class="prof-div"><strong>4-</strong> <?php echo $doc_detail['Doctor']['member4'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['member5'])) {?>
				<div class="prof-div"><strong>5-</strong> <?php echo $doc_detail['Doctor']['member5'];?></div>
			<?php }?>
          </div>
          
        </div>
        </div>
        
 <div class="leftDivOne">       
<div class="rowNext">
          <label>Registrations :</label>
          <div class="rightDivForm" style="clear:both;">
          	<?php if(!empty($doc_detail['Doctor']['registration1'])) {?>
				<div class="prof-div"><strong>1-</strong> <?php echo $doc_detail['Doctor']['registration1'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['registration2'])) {?>
				<div class="prof-div"><strong>2-</strong> <?php echo $doc_detail['Doctor']['registration2'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['registration3'])) {?>
				<div class="prof-div"><strong>3-</strong> <?php echo $doc_detail['Doctor']['registration3'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['registration4'])) {?>
				<div class="prof-div"><strong>4-</strong> <?php echo $doc_detail['Doctor']['registration4'];?></div>
			<?php }?>
			<?php if(!empty($doc_detail['Doctor']['registration5'])) {?>
				<div class="prof-div"><strong>5-</strong> <?php echo $doc_detail['Doctor']['registration5'];?></div>
			<?php }?>
          </div>
          
        </div>
  <div class="rowNext right">
          <label>Description :</label>
          <div class="rightDivForm" style="clear:both;">
          	<?php echo nl2br($doc_detail['Doctor']['own_desc']);?>
          </div>
          
        </div>      
        
 </div>       
        <div style="float:left; font-weight:bold;"><a href="<?php echo SITE_URL;?>pages/prof_detail">Edit Proffessional Details</a></div>
        
     
      <?php echo $form->end();?>
      <div class="bottomShadow"></div>
    </div>
  </div>