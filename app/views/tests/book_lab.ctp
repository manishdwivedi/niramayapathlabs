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
          <div class="bread"><a href="#">Book Lab</a></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>

<h1>Book <span class="green">A Test</span></h1>
    <p>YOU HAVE OPTED FOR <b class="green">ABSOLUTE LYMPHOCYTE COUNT</b></p>
    <?php echo $testlisting['Test']['test_parameter'];?>
    
    
     <div class="tabDivHeader"><div class="leftHeading green">Visit A Lab</div> <div class="rightHeading"><?php echo $this->Html->link('Home Collection','/tests/health_collection');?></div></div>
     <div class="formBox borderNone">
      <?php echo $form->create(null, array('url'=>'#','id'=>'form1','name'=>'form1','class'=>'marTopNone')); ?>
      <p>You may choose to visit any one of the following labs for your sample.</p>
      
      <div class="box left">
       <div class="row">  
         
         <?php if($this->data['Book']['cityname']=='Crossing Republic'){
               $cityname='Crossing Republic';
               $visibility='visible';
           }else{
               $cityname='Indirapuram';
               $visibility='hidden';			}
		 
		
		
          
          
                        $options=array('Crossing Republic'=>'Crossing Republic','Indirapuram'=>'Indirapuram');
           $attributes=array('legend'=>false,'value'=>$cityname);
           echo $this->Form->radio('Book.cityname',$options,$attributes);
           ?>
         
         </div>
          
          <div class="row">
           <?php echo $form->text('Book.date', array('class'=>'wid165 datepicker','value'=>'Date','onblur'=>'if(this.value=="")this.value="Date"',' onfocus'=>'if(this.value=="Date")this.value="";')); ?>
		   <?php //echo $form->text('Book.time', array('class'=>'wid165 right datepicker','value'=>'Time','onblur'=>'if(this.value=="")this.value="Time"',' onfocus'=>'if(this.value=="Time")this.value="";')); ?>
           
           <select name="data[Book][time]" class="input-text" style="width: 175px; margin-left: 12px;">
				<option value="">Select Time</option>
				<?php foreach($time as $key => $val) {?>
				<option value="<?php echo $val['Time']['id'];?>"><?php echo $val['Time']['name'];?></option>
				<?php }?>
			</select>
           
           
          </div>
          <div class="row"><?php echo $form->submit('', array('div'=>false, 'class' => 'right1')); ?></div>
           
          
        </div>
        
          
          
          
          
            
          </div>
          
          
          
      
      </div>
      <?php //echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
      <?php echo $form->end(); ?>
      
      
      </div>