<?php ?>
<script type='text/javascript'>
function emailValidate() {
	var email = $("#checkemail").val();
	var emailRegExp =/^([a-zA-Z0-9_\.\‘\-\&\(\)\/\,\@\’\\\~\+\*\$\#\<\>\”\?\|\[\]\{\}]{1})+\@(([a-zA-Z0-9_\‘\-\&\(\)\/\,\@\’\\\~\+\*\$\#\<\>\”\?\|\[\]\{\}]{1})+\.)+([a-zA-Z0-9_\.\‘\-\&\(\)\/\,\@\’\\\~\+\*\$\#\<\>\”\?\|\[\]\{\}]{2,4})+$/;
    if(email=="" || email==null) {
		$("#errmsg").html("Fields in * are mandatory Fields").show();
		return false;
	}
	else if(!emailRegExp.test(email))
	{
		$("#errmsg").html("Please enter valid email address").show();
		return false;
	}
	else
	{
		isvalidEmail =  false;
		$.ajax({
                type: "POST",
                url: siteUrl+"users/validate_email_is_exist/"+email,
                dataType: 'Json',
				async: false,
                error: function() {
                    $("#errmsg").html("Unable to process request, try after some time").show();
					isvalidEmail = false;
                },
                success: function(Jdata){
                    if(Jdata.status == 'success')
					{
						isvalidEmail = true;
					}
					else
					{
						$("#errmsg").html("The Email You Have Entered is Not in Our Records").show();
						isvalidEmail = false;
						
					}
                }
            });
			
	}
	
	return isvalidEmail;
}
</script>

<div class="guestBox_centring">
        <div class="guestBox">
            <div class="centring codeOr">
              <div style="color:#FF0000; clear:both;display:none;" id="errmsg">Fields in * are mandatory Fields</div>
              <div style="background: none repeat scroll 0 0 #5ea819;color: #fff;float:left; width:100%;">
              <?php echo $this->Session->flash(); ?>
              </div>
              <?php if(!isset($issend)) { ?>
                 <?php echo $form->create(null, array('url'=>'/users/forgot_password','id'=>'form1','name'=>'form1','class'=>'bookForm', 'onsubmit'=>'return emailValidate(this);')); ?>
                        <div class="space" style="padding: 30px 7px;">
                            <label>Emial ID</label>
                            <?php echo $form->text('User.email',array('class'=>'field', 'style'=>'border: 1px solid #97989a;color: #444!important;height: 30px;padding: 0 7px;width: 287px;', 'id'=>'checkemail'));?>
                        </div>
                        <div class="space">
                          <span class="rightcode" style="float: left;padding-left: 12%;">
                          <?php echo $form->submit('Submit', array('div'=>false, 'class' => 'confirmDiv')); ?>
                          </span>
                        </div>

                  <?php echo $form->end(); ?>
                <?php } ?>  
                
            </div>
        </div>
</div>

<div class="clr"></div><br><br><br><br><br><br><br>


