<?php ?>
<script type='text/javascript'>
function passwordValidate()
{
	var password=$("#UserNewPassword").val();
	var confirm_password=$("#UserConfirmPassword").val();
	
	if(password == '' || confirm_password == '') {
		$("#errmsg").html("Password can not be blank.").show();
		return false;
	}
	else if (password != confirm_password)
	{
		$("#errmsg").html("Please enter the same password in both fields below.").show();
		return false;
	}
	
	return true;
}
</script>
<div class="guestBox_centring">
        <div class="guestBox">
            <div class="centring">
                <div class="leftGuest">
                    <h2>Reset Password</h2>
                     <span style="color:#FF0000;"><?php echo $this->Session->flash(); ?></span>
                    <fieldset>
                        <div>
                          <div>
                           <?php echo $form->create(null, array('url'=>'/users/reset_password','id'=>'form1','name'=>'form1','class'=>'bookForm', 'onsubmit'=>'return passwordValidate();')); ?>
                                <div class="space">
                                    <label>New Password</label>
                                    <div>
                                    	<?php echo $form->password('User.new_password', array('maxlength'=>'10', 'class'=>'field')); ?>
											<?php
												echo $form->error('User.new_password', array(
													'between'=>'Please enter password between 6-16 characters long',
													'equalTo'=>'New Password and confirm password are not same'
												));
											?>
                                        
                                    </div>
                                </div>
                                <div class="space">
                                    <label>Confirm Password</label>
                                    <?php echo $form->password('User.confirm_password', array('maxlength'=>'10', 'class'=>'field')); ?>
										<?php
											echo $form->error('User.confirm_password', array(
												'between'=>'Please enter password between 6-16 characters long'
											));
										?>
                                </div>
                                 <?php echo $form->input('User.emailId',array('type' =>'hidden', 'value'=> $emailid));?>
                                <div class="space">
                                	<?php echo $form->submit('Submit', array('div'=>false, 'class' => 'btn')); ?>
                      
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
