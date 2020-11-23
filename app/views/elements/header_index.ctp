<div class="navbar_outer">
          <div class="navbar">
          		<div class="top_logo">
					<?php echo $html->link($html->image("top_logo.png"), SITE_URL , array('escape' => false));?>
                </div>
				<?php 
				$pagee = $this->action;
				if($pagee == 'about')
				{
					$aboutclass = 'active';
				}
				
				if($pagee == 'guide')
				{
					$guideclass = 'active';
				}
				
				if($pagee == 'contact')
				{
					$contactclass = 'active';
				}
				
				?>
                <div class="top_links">
                	<ul>                                            
                    	<li><?php echo $this->Html->link('About',array('controller'=>'pages','action'=>'about'),array('class'=>$aboutclass));?></li>
                        <li><?php echo $this->Html->link('Guide',array('controller'=>'pages','action'=>'guide'),array('class'=>$guideclass));?></li>
                        <li><?php echo $this->Html->link('Manage Properties','#');?></li>
                        <li><?php echo $this->Html->link('Browse Properties','#');?></li>
                        <li><?php echo $this->Html->link('Contact',array('controller'=>'pages','action'=>'contact'),array('class'=>$contactclass));?></li>
                    </ul>
                </div>
               
                <div class="navbar_right">
                    <ul>
                        <li><?php echo $this->Html->link('Account','#');?></li>
                        <li>|</li>
                        <li><?php echo $this->Html->link('Login','#',array('id'=>'loginButton'));?></li>
                    </ul> 
                </div>
                
                <div class="login_box" id="login_box_id">
                <div class="login_box_top">
                    <h1>MEMBERS LOGIN</h1>
                    <p>
						<?php echo $form->text('User.new_password', array('value'=>'Username', 'onblur'=>'if(this.value==""){ this.value="Username"}','onfocus'=>'if(this.value=="Username"){ this.value=""}')); ?>
                    </p>
                    <p>
						<?php echo $form->password('User.old_password', array('value'=>'Password', 'onblur'=>'if(this.value==""){ this.value="Password"}','onfocus'=>'if(this.value=="Password"){ this.value=""}')); ?>
                    </p>
                    <div class="login_btn">
						<?php echo $this->Form->submit('/img/login_btn.png',array('div'=>false)); ?>
                        <?php echo $this->Form->checkbox('', array('div'=>'true', 'label' => 'Remember'));?>
                        <span>remember me</span>
                    </div>
                    <div class="login_link">
                        <?php echo $this->Html->link('(trouble logging in?)','#',array('id'=>'loginButton'));?>
                    </div>
                </div>
                <div class="login_box_bottom"></div>
            </div>
            
            </div>

        </div>