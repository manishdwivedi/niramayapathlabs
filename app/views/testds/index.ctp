<?php /*Sign Up*/ ?>
<script>
function checkphone(tag)
{
  //console.log(tag.value);
  var phone = $('#'+tag.id);
  //console.log(tag.id);
  if(phone.val().length==10)
  {
    jQuery.ajax({
      type:'GET',
      url:siteUrl+'admin/testds/check_phone?contact='+phone.val(),
      success: function(response) {
        //console.log(response);
        if(response.success=='Success')
        {
          $('.'+tag.id+'Error').html("");
          $('.'+tag.id+'Error').hide();
          content = '<label>Relation<span>*</span></label>';
          content += '<select name="data[User][relation]" id="UserRelation" class="input-text" required>';
          content += '<option value="">Select Relation</option>';
          
          jQuery.each(response.relation,function(index, value)
          {
              content += '<option value="'+value.RelationMaster.prefix+'">'+value.RelationMaster.name+'</option>';
          });
          content += '</select>';
          content += '<div id="msg_relation" style="color:#FF0000; font-size:12px;"></div>';
          $('#relation_type').html(content);
        }
        else
        {
          $('#relation_type').html(""); 
        }
        jQuery('#'+tag.id+'Img').hide();
        $('#new_patient').show();
      },
      dataType:"json",
      beforeSend:function(){
        jQuery('#'+tag.id+'Img').show();
      }
    });
  }
  else
  {
    $('#new_patient').hide();
  }
}

function checknum(evt)
{
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;  
}
</script>
<div class="article_in_inner" style="background: #eee;">
    <div class="article_in" >
      <section class="signup">
        <div class="centering centerA">
            <h3 class="centerA">Registration Form </h3>
              <p>Provide all required details for complete the registration.</p>
              <div>
                <?php echo $form->create(null, array('url'=>'/testds/index','id'=>'form1','name'=>'form1','class'=>'','onsubmit'=>'return validationc(this);')); ?>
                <span style="color:#FF0000;"><?php echo $this->Session->flash(); ?></span>
                <fieldset class="fieldset2">
                    <div class="space">
                      <label>Contact No<span>*</span></label>
                      <?php echo $form->text('User.contact',array('class'=>'field', 'maxlength'=>'50','placeholder'=>'Enter Contact No','onkeyup'=>'checkphone(this)','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return checknum(event)'));?>
                      <?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40,'style'=>'margin:0 0 -15px; display:none;','id'=>'UserContactImg'));?>
                      <div id="msg5" class="UserContactError" style="color:#FF0000; font-size:12px;"></div>
                    </div>
                    <div class="space" id="relation_type">
                    </div>
                    <div class="space">
                      <label>First Name<span>*</span></label>
                      <?php echo $form->text('User.first_name',array('placeholder'=>'Enter First Name', 'class'=>'field', 'maxlength'=>'25'));?>
                    </div>

                    <div class="space">
                      <label>Last Name<span>*</span></label>
                      <?php echo $form->text('User.last_name',array('class'=>'','placeholder'=>'Enter Last Name', 'class'=>'field', 'maxlength'=>'25'));?>
                    </div>
                    <div class="space">
                      <label>Email<span>*</span></label>
                      <?php echo $form->text('User.email',array('class'=>'field','placeholder'=>'Enter Email','maxlength'=>'50'));?>
                     
                    </div>
                    
                    <div class="space">
                      <label>Age<span>*</span></label>
                      <?php echo $form->text('User.age',array('placeholder'=>'Enter Your Age', 'class'=>'field', 'maxlength'=>'25','onkeypress'=>'return checknum(event)'));?>
                    </div>
                    <div class="space">
                      <label>Gender<span>*</span></label>
                         <select name="data[User][gender]" class="select" id="UserGender">
                                  <option value="">Select Gender</option>
                                <?php foreach($gender as $key => $val) {?>
                               <option value="<?php echo $val['Gender']['id'];?>" <?php if($this->data['User']['gender'] == $val['Gender']['id']) {?> selected="selected" <?php }?>><?php echo $val['Gender']['name'];?></option>
                               <?php }?>
                          </select> 
                    </div>
                    <div class="space">
                      <label>Address<span>*</span></label>
                       <?php echo $form->textarea('User.address',array('class'=>'field','placeholder'=>'Enter Address','type'=>'textarea', 'maxlength' => '50'));?>
                    </div>
                    <div class="space">
                      <label>Locality<span>*</span></label>
                        <?php echo $form->text('User.locality',array('class'=>'field','placeholder'=>'Enter Locality', 'maxlength' => '50'));?>
                    </div>
                    <div class="space">
                      <label>Pincode<span>*</span></label>
                       <?php echo $form->text('User.pincode',array('class'=>'field','placeholder'=>'Enter Pincode','maxlength'=>'50','onkeypress'=>'return checknum(event)'));?>
                    </div>
                    <div class="space">
                      <label>City<span>*</span></label>
                      <select name="data[User][city]" class="select" id="UserCity">
                            <option value="">Select City</option>
                            <?php foreach($city as $key => $val) {?>
                            <option value="<?php echo $val['City']['id'];?>" <?php if($this->data['User']['city'] == $val['City']['id']) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
                            <?php }?>
                      </select> 
                    </div>
                    <div class="space">
                      <label>State<span>*</span></label>
                      <select name="data[User][state]" class="select" id="UserState">
                                <option value="">Select State</option>
                                  <?php foreach($state as $key => $val) {?>
                                    <option value="<?php echo $val['State']['id'];?>" <?php if($this->data['User']['state'] == $val['State']['id']) {?> selected="selected" <?php }?>><?php echo $val['State']['name'];?></option>
                                  <?php }?>
                      </select> 
                    </div>
                    <div class="space">
                      <label>Landmark<span>*</span></label>
                      <?php echo $form->text('User.landmark',array('class'=>'field', 'maxlength'=>'50', 'placeholder'=>'Enter Landmark'));?>
                     
                    </div>
                    <div class="space">
                      <label class="label2">&nbsp;</label>
                      <input type="submit" id="new_patient" name="" value="Save" class="btn field">
                    </div>
                  </fieldset>
             
            </div>
        </div>
      </section>
    </div>
    <div class="clr"></div>
  </div>
  <div class="clr"></div>