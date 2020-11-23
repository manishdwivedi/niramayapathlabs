<script type="text/javascript">
//function show_exp(val)
//{
//	if(val == 'home')
//	{
//		document.getElementById('exp_div').style.display='block';
//		document.getElementById('exp_div1').style.display='none';
//	}
//	if(val == 'visit')
//	{
//		document.getElementById('exp_div1').style.display='block';
//		document.getElementById('exp_div').style.display='none';
//	}
//}
//
//
//
//
//
</script>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'Banner'))?></div>
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
          <div class="bread"><a href="#">Health Collection</a></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<h1>Book <span class="green">A Test</span></h1>
    <p>YOU HAVE OPTED FOR <b class="green">ABSOLUTE LYMPHOCYTE COUNT</b></p>
    <div class="tabDivHeader"><div class="leftHeading green">Home Collection</div> <div class="rightHeading"><?php echo $this->Html->link('Visit A Lab','/tests/book_lab');?></div></div>
     
     <div class="formBox borderNone">
      <?php echo $form->create(null, array('url'=>'#','id'=>'form1','name'=>'form1','class'=>'marTopNone')); ?>
      <p>We accept online request. Please fill in the fields below.</p>
      
      <div class="box left">
         
          <div class="row marTopNone">
           <?php echo $form->text('Health.name', array('class'=>'input-text','value'=>'Full Name','onblur'=>'if(this.value=="")this.value="Full Name"',' onfocus'=>'if(this.value=="Full Name")this.value="";')); ?>
          </div>
          <div class="row">
             <?php echo $form->text('Health.mobile', array('class'=>'input-text','value'=>'Mobile No.','onblur'=>'if(this.value=="")this.value="Mobile No."',' onfocus'=>'if(this.value=="Mobile No.")this.value="";')); ?>
          </div>
          <div class="row">
           <?php echo $form->text('Health.sample_date', array('class'=>'wid165 datepicker','value'=>'Date','onblur'=>'if(this.value=="")this.value="Date"',' onfocus'=>'if(this.value=="Date")this.value="";')); ?>
		   <?php echo $form->text('Health.sample_time', array('class'=>'wid165 right datepicker','value'=>'Time','onblur'=>'if(this.value=="")this.value="Time"',' onfocus'=>'if(this.value=="Time")this.value="";')); ?>
          </div>
          
           <div class="row">
          <?php echo $form->text('Health.address', array('value'=>'Address','onblur'=>'if(this.value=="")this.value="Address"',' onfocus'=>'if(this.value=="Address")this.value="";')); ?>
          </div>
          
        </div>
        <div class="box right">
        
          <div class="row marTopNone">
           <?php echo $form->text('Health.email', array('class'=>'input-text','value'=>'Email','onblur'=>'if(this.value=="")this.value="Email"',' onfocus'=>'if(this.value=="Email")this.value="";')); ?>
          </div>
          <div class="row">
            <?php echo $form->text('Health.landline', array('class'=>'input-text','value'=>'Landline','onblur'=>'if(this.value=="")this.value="Landline"',' onfocus'=>'if(this.value=="Landline")this.value="";')); ?>
          </div>
          <div class="row">
            <select name="data[Health][test_id]" class="input-text">
				<option value="">Select Test</option>
				<?php foreach($tests as $key => $val) {?>
				<option value="<?php echo $val['Test']['id'];?>"><?php echo $val['Test']['test_parameter'];?></option>
				<?php }?>
			</select>
          </div>
          <div class="row">
            <select name="data[Health][city_id]" class="input-text">
				<option value="">Select City</option>
				<?php foreach($city as $key => $val) {?>
				<option value="<?php echo $val['City']['id'];?>"><?php echo $val['City']['name'];?></option>
				<?php }?>
			</select>
          </div>
          </div>
          
          <?php echo $form->textarea('Health.remark', array('class'=>'class-textarea','value'=>'Remark','onblur'=>'if(this.value=="")this.value="Address"',' onfocus'=>'if(this.value=="Address")this.value="";')); ?>
          <?php echo $form->submit('', array('div'=>false, 'class' => 'continue right')); ?>
          
          
            
          </div>
          
          
          
      
      </div>
      <?php //echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
      <?php echo $form->end(); ?>
      
      
      </div>