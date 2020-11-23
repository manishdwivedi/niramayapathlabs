<?php ?>
<script type="text/javascript">
function validationcc()
{
var str=true;
document.getElementById("msg11").innerHTML="";
document.getElementById("msg12").innerHTML="";
if(document.form3.LoginUsername.value=='Please Enter Email/Phone')
{
	document.getElementById("msg11").innerHTML="Please Enter Email/Phone";
	str=false;
}

if(document.form3.LoginPass.value=='password')
{
	document.getElementById("msg12").innerHTML="Please Enter Password";
	str=false;
}

return str;
}
</script>
<div class="guestBox_centring">
        <div class="guestBox">
            <div class="centring">
                <div class="leftGuest">
                    <h2><a href="<?php echo SITE_URL;?>testds/index" style="color:#0099FF; text-decoration:underline;">New User SignUp</a></h2>
                     <span style="color:#FF0000;"><?php echo $this->Session->flash(); ?></span>
                    <fieldset>
                        <div>
                          <div>
                            <?php echo $form->create(null, array('url'=>'/pages/login','id'=>'form3','name'=>'form3','class'=>'marTopNone','onsubmit'=>'return validationcc(this);')); ?>
                                <div class="space">
                                    <label>Email/Mobile Number</label>
                                    <div class="mobile">
                                    	<?php echo $form->text('Login.username',array('class'=>'fieldMobile3','placeholder'=>'Please enter Email/Phone'));?>
                                    </div>
                                </div>
                                <div class="space">
                                    <label>Mobile Number/Password</label>
                                    <?php echo $form->password('Login.pass',array('class'=>'field','placeholder'=>'Password'));?>
                                   
                                </div>
                                <div class="space">
                                    <input type="submit" value="Login" class="btn">
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
                            <a href="/pages/report_login_page"><input type="button" value="View Report" class="btn"></a>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

</div>

<div class="clr"></div>