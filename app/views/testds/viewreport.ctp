<?php /* View Report */ ?>
<div class="guestBox_centring">
        <div class="guestBox">
            <div class="centring">
                <div class="leftGuest">
                    <h2>View Report</h2>
                     <span style="color:#FF0000;"><?php echo $this->Session->flash(); ?></span>
                    <fieldset>
                        <div>
                          <div>
                            <?php echo $form->create(null, array('url'=>'/testds/viewreport','id'=>'form3','name'=>'form3','class'=>'','onsubmit'=>'return validationcc(this);')); ?>
                                <div class="space">
                                    <label>Email/Mobile Number</label>
                                    <div class="mobile">
                                         <input type="text" name="data[ViewReport][username]" class="fieldMobile3" placeholder="Enter Username" maxlength=10 />
                                    </div>
                                </div>
                                <div class="space">
                                    <label>Request Number</label>
                                      <input type="password" name="data[ViewReport][password]" class="field" placeholder="Enter Request Number" />
                                    
                                   
                                </div>
                                <div class="space">
                                     <input type="submit" name="submit" value="Submit" class="btn" />
                                </div>
                              <?php echo $form->end(); ?>
                            </div>
                            
                         </div>
                         
                       
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

                    
                </div>
            </div>
        </div>

</div>

<div class="clr"></div>


