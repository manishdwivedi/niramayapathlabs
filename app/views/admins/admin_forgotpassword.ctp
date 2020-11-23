<div id="logincontainer">
    	<div id="loginbox">
        	
        	<div id="loginheader">
            	Reset Your Password
            </div>
            <div>
            <?php
		if($session->check('Message.flash')){
			echo $session->flash();
		}
	?>
            </div>
            <div id="innerlogin">
            	<?php echo $form->create('', array('url'=>'/admin/admins/forgotpassword/')); ?>
                	<p>Enter your Email:</p>
                	<?php echo $form->text('Admin.email', array('maxlength'=>'42', 'class'=>'logininput')); ?>
                   <?php
				echo $form->error('Admin.email', array(
					'email'=>'Please enter valid email address',
					'isEmailExists'=>'Invalid email address'
				));
			?>
                    
                  	<?php echo $form->submit('Submit', array('class' => 'loginbtn')); ?>                   	<br />
                    <p><?php echo $html->link('Login', '/admin/admins/login/', array('title'=>'Login Panel?')); ?></p>
                <?php echo $form->end(); ?>
            </div>
        </div>
        <?php echo $html->image('login_fade.png', array()); ?>
       
    </div>