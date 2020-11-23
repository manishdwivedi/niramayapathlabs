<?php /* login */ ?>
<script type="text/javascript">

function verify_phone()
{
    var phone = $('#LoginUsername').val();
    
    if(phone.length < 10)
    {
        $('#phone_number_error').html('Enter Correct Phone Number');
        $('#phone_number_error').css('color', 'red');
    }
    else
    {
        $('#verifyphone').hide();
        jQuery.ajax({
            type:'GET',
            url:'/tests/check_phone?req_val='+phone,
            dataType:'json',
            success:function(data){
                if(data.user_info.success == 'success')
                {
                    $('#SearchUserImg').hide();
                    $('.after_otp').show();
                    $('#after_otp_sent').html('OTP sent to Registered Number and will be valid for 5 Minutes.');
                    $('#after_otp_sent').css('color', 'green');
                    $('.before_otp').hide();

                }
                if(data.user_info.success == 'notsuccess')
                {
                    $('#SearchUserImg').hide();
                    $('#phone_number_error').html('Invalid Phone Number. Kindly enter Registered One.');
                    $('#phone_number_error').css('color', 'red');   
                    $('#verifyphone').show();
                }
            },
            beforeSend:function(){
                jQuery('#SearchUserImg').show();
            }, 
        });
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
<div class="guestBox_centring">
        <div class="guestBox">
            <div class="centring">
                <div class="leftGuest">
                    <h2>LOGIN INTO YOUR ACCOUNT</h2>
                     <span style="color:#FF0000;"><?php echo $this->Session->flash(); ?></span>
                    <fieldset>
                        <div>
                          <div>
                            <?php echo $form->create(null, array('url'=>'/testds/login','id'=>'form3','name'=>'form3','class'=>'','onsubmit'=>'return validationcc(this);')); ?>
                                <div class="space before_otp">
                                    <label>Mobile Number</label>
                                    <div class="mobile ">
                                        <?php echo $form->text('Login.username', array('class'=>'fieldMobile3','maxlength'=>'10','value'=>'Please Enter Phone','onblur'=>'if(this.value=="")this.value="Please Enter Phone"',' onfocus'=>'if(this.value=="Please Enter Phone")this.value="";','onkeypress'=>'return checknum(event)')); ?>
                                        <label id="phone_number_error"></label>
                                    </div>
                                </div>
                                <div class="reportbox-fields before_otp">
                                    <input id="verifyphone" type="button" name="" value="Send OTP" class="checkreport" onclick="verify_phone();"/>
                                    <center><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40,'style'=>'margin:0 0 -15px; display:none;','id'=>'SearchUserImg'));?></center>
                                </div>
                                <div class="space after_otp" style="display:none;"> 
                                    <label id="after_otp_sent"></label>
                                    <label>OTP</label>
                                    <?php echo $form->password('Login.pass', array('class'=>'field','value'=>'Enter Password','onblur'=>'if(this.value=="")this.value="password"',' onfocus'=>'if(this.value=="password")this.value="";')); ?>
                                   
                                </div>
                                <div class="space after_otp" style="display:none;">
                                    <input type="submit" value="Verify" class="btn">
                                </div>
                              <?php echo $form->end(); ?>
                            </div>
                            
                         </div>
                          <a style="float:right;" href="<?php echo SITE_URL ?>users/forgot_password">Forgot password</a>
                       
                    </fieldset>
                    <div class="orBox">OR</div>
                </div>
                <div class="rightGuest">
                    <fieldset>
                        <h3>CREATE YOUR ACCOUNT</h3>
                        <p>Get started with Niramaya Pathlab. Quick test booking, online reports and notifications, my bookings and many more, create an account?</p>
                        <div class="space">
                            <a href="/testds/index"><input type="button" value="Register" class="btn"></a>
                        </div>
                    </fieldset>

                    <fieldset>
                        <h3>View Report</h3>
                        <p>Existing user login with the details sent on your email while ordering Test/Profile.
                        </p>
                        <div class="space">
                            <a href="/testds/viewreport"><input type="button" value="View Report" class="btn"></a>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

</div>

<div class="clr"></div>


