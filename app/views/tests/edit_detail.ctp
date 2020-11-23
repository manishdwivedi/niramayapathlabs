<?php /* Edit Details */ ?>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
    $(".datepicker").datepicker({
        maxDate: '+0D',
        dateFormat: 'dd-mm-yy'
    });
});
function open_pass()
{
    if(ChangePassCheck.checked == 1)
    {
        $('#ChangePass').toggle('fast');
    }
    if(ChangePassCheck.checked == 0)
    {
        $('#ChangePass').toggle('slow');
    }
}

function getcitystate()
{
    var pin = $('#UserPincode').val();
    if(pin.length==6)
    {
        document.getElementById("msg11").innerHTML="";
        jQuery.ajax({
            type:'GET',
            url:siteUrl+'admin/samples/getcitystate?pin='+pin,
            success: function(response) {
                $('#UserCity option[value='+response["city"]+']').attr('selected','selected');                        
                $('#UserState option[value='+response["state"]+']').attr('selected','selected');
            },
             dataType:"json"
        });
        
    }
    else{
        document.getElementById("msg11").innerHTML="Please Enter valid Pincode";
    }
}
</script>
<div class="ContactUs">
<div class="centring">
    <div class="graynavigation">
        <ul>
	     <li><a href="/"><span>Home</span></a></li>
         <li><a href="<?php print $_SERVER['HTTP_REFERER'];?>"><span>Personal Details</span></a></li>
	     <li class="list"> <span>Edit Details</span></li>
	  </ul>
	</div>
            <div class="clr"></div>
            <div class="contactDiv teamDoctors">
                <div class="left">
                   
                </div>
                <div class="right">
                    <div class="general_enquiry">
                        <p>Edit Your Personal Details</p>
    <?php echo $form->create('ChangePassword',array('url'=>'#'));?>
    <?php echo $form->hidden('User.id',array('value'=>$member_detail['User']['id']));?>
                          <?php if(!empty($mess_fail) && empty($mess_succ_pass) && empty($mess_succ)) {?>
                          <div style="color:#FF0000;"><?php echo $mess_fail;?></div>
                          <?php }?>
                          <?php if(empty($mess_fail) && !empty($mess_succ_pass) && empty($mess_succ)) {?>
                          <div style="color:green;"><?php echo $mess_succ_pass;?></div>
                          <?php }?>
                          <?php if(empty($mess_fail) && empty($mess_succ_pass) && !empty($mess_succ)) {?>
                          <div style="color:green;"><?php echo $mess_succ;?></div>
                          <?php }?>
                        <fieldset>
                            <div class="space nospace"><label>&nbsp;</label></div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>First Name<span></span></label>
                                <?php echo $form->text('User.first_name',array('value'=>$member_detail['User']['first_name'], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>Last Name<span></span></label>
                                <?php echo $form->text('User.last_name',array('value'=>$member_detail['User']['last_name'], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>Gender<span></span></label>
                                <input type="radio" name="data[User][gender]" value="1" <?php if($member_detail['User']['gender'] == 1) {?> checked="checked" <?php }?> />&nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="data[User][gender]" value="2" <?php if($member_detail['User']['gender'] == 2) {?> checked="checked" <?php }?> />&nbsp;Female
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>DOB<span></span></label>
                                <?php echo $form->text('User.dob',array('class'=>'field datepicker', 'style'=>'width:100px;','required'=>'true'));?>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>Age<span></span></label>
                                <?php echo $form->text('User.age',array('value'=>$member_detail['User']['age'], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                             <div class="space">
                                <label>Contact Number<span></span></label>
                                <?php echo $form->text('User.contact',array('value'=>$member_detail['User']['contact'], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>Email ID<span></span></label>
                                <?php echo $form->text('User.email',array('value'=>$member_detail['User']['email'], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                            <?php $explode_add = explode('*',$member_detail['User']['address']);?>
                            <?php if(!empty($explode_add[0]) && empty($explode_add[1])) {?>
                             <div class="space">
                                <label>Address<span></span></label>
                                <?php echo $form->text('User.address1',array('value'=>$member_detail['User']['address1'], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>&nbsp;<span></span></label>
                                <?php echo $form->text('User.address2',array('value'=>$member_detail['User']['address2'], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                           <?php } ?>
                           <?php if(!empty($explode_add[0]) && !empty($explode_add[1])) {?>
                             <div class="space">
                                <label>Address<span></span></label>
                                <?php echo $form->text('User.address1',array('value'=>$explode_add[0], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>&nbsp;<span></span></label>
                                <?php echo $form->text('User.address2',array('value'=>$explode_add[1], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                           <?php } ?>
                            
                            <div class="space">
                                <label>Locality<span></span></label>
                                <?php echo $form->text('User.locality',array('value'=>$member_detail['User']['locality'], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>Pincode<span></span></label>
                                <?php echo $form->text('User.pincode',array('value'=>$member_detail['User']['pincode'], 'class'=>'field', 'autocomplete'=>'off','required'));?>
                                <label id="msg11" style="color:red;"></label>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>City<span></span></label>
                                <select name="data[User][city]" class="select" id="UserCity">
                                    <option value="">Please Select City</option>
                                    <?php foreach($city as $key => $val) {?>
                                    <option value="<?php echo $val['City']['id'];?>" <?php if($member_detail['User']['city'] == $val['City']['id']) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>state<span></span></label>
                                <select name="data[User][state]" class="select" id="UserState">
                                    <option value="">Please Select State</option>
                                    <?php foreach($state as $key => $val) {?>
                                    <option value="<?php echo $val['State']['id'];?>" <?php if($member_detail['User']['state'] == $val['State']['id']) {?> selected="selected" <?php }?>><?php echo $val['State']['name'];?></option>
                                    <?php }?>
                                </select> 
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>Landmark<span></span></label>
                                <?php echo $form->text('User.landmark',array('value'=>$member_detail['User']['landmark'], 'class'=>'field', 'autocomplete'=>'off'));?>
                            </div>
                            <div class="clr"></div>
                           <div class="space">
                                <label>Change Password<span></span></label>
                                <input name="" type="checkbox" id="ChangePassCheck" onclick="open_pass();" />
                            </div>
                            <div class="clr"></div>
                        <div id="ChangePass" <?php if(empty($mess_fail) && !empty($mess_succ_pass) && empty($mess_succ)) {?> style="display:block;" <?php } else {?> style="display:none;" <?php }?>>
                            
                            <div class="space">
                                <label>Old Password<span></span></label>
                                <?php echo $form->password('User.old_pass_user',array('value'=>'','placeholder'=>'Enter Old Password', 'class'=>'field' ));?>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>New Password<span></span></label>
                                <?php echo $form->password('User.new_pass',array('value'=>'','placeholder'=>'Enter Old Password', 'class'=>'field' ));?>
                            </div>
                            <div class="clr"></div>
                            <div class="space">
                                <label>Confirm Password<span></span></label>
                                <?php echo $form->password('User.conf_pass',array('value'=>'','placeholder'=>'Enter Confirm Password', 'class'=>'field'));?>
                            </div>
                            <div class="clr"></div>
                        </div>
                            
                           
                            <div class="clr"></div>
                            <div class="space">
                                <label>&nbsp;</label>
                                <input type="submit" value="Submit" class="btn">
                            </div>
                            
                        </fieldset>
 <?php echo $form->end();?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="clr"></div>
       
<div class="clr"></div>
<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>