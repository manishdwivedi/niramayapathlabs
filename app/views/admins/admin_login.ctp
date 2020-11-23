<div id="logincontainer">
    	<div id="loginbox">
        	
        	<div id="loginheader">
            	Login Panel
            </div>
            <div>
            <?php
					if($session->check('Message.flash')){
						echo $session->flash();
					}
			?>
            </div>
            <div id="innerlogin">
            	<?php echo $form->create('', array('url'=>'/admin/admins/login/')); ?>
                	<p>Enter your username:</p>
                	<?php echo $form->text('Admin.userName', array('maxlength'=>'32', 'class'=>'logininput')); ?>
                    <?php
				echo $form->error('Admin.userName', array(
					'required'=>'Please enter username',
					'isUsernameExists'=>'Invalid username'
				));
			?>
                    <p>Enter your password:</p>
                    <?php echo $form->password('Admin.password', array('maxlength'=>'16', 'class'=>'logininput')); ?>
                	<?php
				echo $form->error('Admin.password', array(
					'between'=>'Please enter password between 6-16 characters long',
					'isPassword'=>'Invalid password'
				));
			?>
                   
					<?php echo $form->submit('Login', array('class' => 'loginbtn')); ?>                   	<br />
                    <p><?php echo $html->link('Forgot Password?', '/admin/admins/forgotpassword/', array('title'=>'Forgot Password?')); ?></p>
                <?php echo $form->end(); ?>
            </div>
        </div>
        <?php echo $html->image('login_fade.png', array()); ?>
       
    </div>