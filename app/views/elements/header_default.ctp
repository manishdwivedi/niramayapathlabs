<script type="text/javascript">
function language(id)
{
	//alert(id);
	document.getElementById('langcode').value =  id;
	document.forms["form1"].submit();
}
</script>
<style type="text/css">
.languages img {
    float: left;
    padding: 3px;
}

</style>

<!-- Dialog Login Box Starts -->

<script type="text/javascript">

function open_dialog()
{
	jQuery('#logindialog').show();
}

function close_dialog()
{
	jQuery('#logindialog').hide();
}

</script>

<!-- Dialog Login Box Ends -->

<!--header div start here-->

<div class="header">
	<div class="header_inner">
    
    	<div class="header_inner_row1">
            <div class="logo">
				<?php echo $html->link($html->image("logo.png"), SITE_URL , array('escape' => false));?>
            </div>
			
				<?php if(!empty($sessionuser)) {?>
				<div style="padding:22px 0px 0px 313px; float:left; color:#fff;">
					 <?php echo __('WELCOME',true);?> <?php echo $html->link(ucwords($membername),array('controller'=>'members','action'=>'profile'),array('style'=>'color:#FF0000;'));?><?php //echo $membername;?>
					|
					<?php //echo $html->link(__('MY_ACCOUNT',true),array('controller'=>'members','action'=>'profile'),array('style'=>'color:#fff;'));?>
					<?php echo $html->link(__('LOGOUT',true),array('controller'=>'members','action'=>'logout'),array('style'=>'color:#fff;'));?>
				</div>
				<?php } else {?>
				
				<div style="padding:20px 0px 0px 391px; float:left; color:#fff;">
					<?php //echo $html->link(__('LOGIN',true),array('controller'=>'members','action'=>'login'),array('style'=>'color:#fff;'));?>
					<?php echo $html->link(__('LOGIN',true),'#',array('style'=>'color:#fff;','onclick'=>'open_dialog();'));?> 
					| 
				<?php echo $html->link(__('SIGN_UP',true),array('controller'=>'members','action'=>'register'),array('style'=>'color:#fff;'));?>
				<div id="logindialog" class="login_dialog" style="display:none; color:#000;">
				
				<?php echo $form->create('Member',array('url'=>array('controller'=>'members','action'=>'login')));?>
				<table border="0" width="100%">
					<tr>
						<td colspan="2">
							<table border="0" width="100%">
								<tr>
									<td style="font-size:11px;" align="right"><?php echo __('CLOSE',true);?></td>
									<td width="5px;"><?php echo $html->link($html->image("close_icon.png"), '#' , array('escape' => false,'onclick'=>'close_dialog();'));?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="font-size:12px; width:100px;"><?php echo __('EMAIL',true);?></td>
						<td>
							<?php if(!empty($cookieuser)) {?>
							<?php echo $form->text('Member.email',array('class'=>'login-input-text','value'=>$cookieuser));?>
							<?php } else {?>
							<?php echo $form->text('Member.email',array('class'=>'login-input-text'));?>
							<?php }?>
						</td>
					</tr>
					<tr>
						<td style="font-size:12px; width:100px;"><?php echo __('PASSWORD',true);?></td>
						<td>
							<?php if(!empty($cookiepass)) {?>
							<?php echo $form->password('Member.password',array('class'=>'login-input-text','value'=>$cookiepass));?>
							<?php } else {?>
							<?php echo $form->password('Member.password',array('class'=>'login-input-text'));?>
							<?php }?>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<?php if($this->Session->read('Locale.locale_folder') == 'eng') {?>
						<td>
							<?php echo $this->Form->submit(__('SUBMIT',true),array('value'=>'Submit','class'=>'button_css')); ?>
						</td>
						<?php } else {?>
						<td>
							<?php echo $this->Form->submit(__('SUBMIT',true),array('value'=>'Submit','class'=>'button_css')); ?>
						</td>
						<?php }?>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td style="font-size:12px;">
							<?php echo $this->Form->checkbox('Member.remember', array('value' =>1)); ?>&nbsp;&nbsp;<?php echo __('KEEP_ME_LOGGED_IN_ON_THIS_COMPUTER',true);?>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td style="font-size:12px;">
							<?php echo $html->link(__('FORGOT_PASSWORD',true),array('controller'=>'members','action'=>'forgotpass'),array('style'=>'float:left; line-height:28px; color:#000;')); ?>
							
							<div style="float:left; margin:7px 0 0 20px;"><?php echo $html->link(__('REGISTER',true),array('controller'=>'members','action'=>'register')); ?></div>
						</td>
					</tr>
				</table>
				<?php echo $form->end();?>
			</div>
				</div>
				<?php }?>
			
            <div class="search_bar">
                <div class="search_bar_inner">
					<?php echo $form->create('Art',array('url'=>array('controller'=>'arts','action'=>'search')));?>
					<?php echo $form->text('Search.searchtext',array('value'=>__('SEARCH_BY_ARTWORK_NAME',true), 'onblur'=>'if(this.value==""){ this.value="'.__('SEARCH_BY_ARTWORK_NAME',true).'"}','onfocus'=>'if(this.value=="'.__('SEARCH_BY_ARTWORK_NAME',true).'"){ this.value=""}'));?>
					<?php if($this->Session->read('Locale.locale_folder') == 'eng') {?>
						<?php echo $this->Form->submit('/img/search_btn.png',array('div'=>false)); ?>
					<?php } else {?>
						<?php echo $this->Form->submit('/img/search_btn_jpn.png',array('div'=>false)); ?>
					<?php }?>
					<?php echo $form->end();?>
				</div>
			</div>
			<?php //echo "<pre>"; print_r($locale); exit;?>
			<!--<div style="clear: both; color: #FFFFFF; float: right; margin: 0 22px 0 0;"><?php echo $html->link(__('ADVANCE_SEARCH?',true),array('controller'=>'arts','action'=>'advancesearch'),array('style'=>'color:#fff;'));?></div>-->
        </div>
		<?php 
			if($this->params['controller'] == 'members'  && $this->params['action'] == 'index' )
			{ 
				$active1 = 'active';
				$active2= '';
				$active3= '';
				$active4= '';
				$active5= '';
				$active6= '';
			}
			elseif($this->params['controller'] == 'pages'  && $this->params['action'] == 'index' )
			{
				$active2 = 'active';
				$active1= '';
				$active3= '';
				$active4= '';
				$active5= '';
				$active6= '';
			}
			elseif($this->params['controller'] == 'pages'  && $this->params['action'] == 'aboutus' )
			{
				$active3 = 'active';
				$active1= '';
				$active2= '';
				$active4= '';
				$active5= '';
				$active6= '';
			}
			elseif($this->params['controller'] == 'pages'  && $this->params['action'] == 'contact' )
			{
				$active4 = 'active';
				$active1= '';
				$active2= '';
				$active3= '';
				$active5= '';
				$active6= '';
			}
			elseif($this->params['controller'] == 'events'  && $this->params['action'] == 'eventinfo' )
			{
				$active4 = '';
				$active1= '';
				$active2= '';
				$active3= '';
				$active5= 'active';
				$active6= '';
			}
			elseif($this->params['controller'] == 'pages'  && $this->params['action'] == 'sta' )
			{
				$active4 = '';
				$active1= '';
				$active2= '';
				$active3= '';
				$active5= '';
				$active6= 'active';
			}
			else
			{
				$active1= '';
				$active2= '';
				$active3= '';
				$active4= '';
				$active5= '';
				$active6= '';
			}
			?>
        <div class="header_inner_row2">
        	<div class="top_menu">
            	<ul>     

                	<li class="<?php echo $active2;?>"><a href="<?php echo SITE_URL;?>"><span><?php echo __('HOME',true);?></span></a></li>
                    <li class="<?php echo $active1;?>"><a href="<?php echo SITE_URL.'members';?>"><span><?php echo __('ARTISTS',true);?></span></a></li>
					
					
					<li class="<?php echo $active5;?>"><a href="<?php echo SITE_URL.'events/eventinfo';?>"><span><?php echo __('EVENTS',true);?></span></a></li>
                    
					
					<li class="<?php echo $active3;?>"><a href="<?php echo SITE_URL.'pages/aboutus';?>"><span><?php echo __('ABOUT_US',true);?></span></a></li>
                    <li class="<?php echo $active4;?>"><a href="<?php echo SITE_URL.'pages/contact';?>"><span><?php echo __('CONTACT_US',true);?></span></a><span></li>
					<li class="<?php echo $active6;?>"><a href="<?php echo SITE_URL.'pages/sta';?>"><span><?php echo __('Anjali_static',true);?></span></a><span></li>
					
                </ul>
            </div>
            <div class="languages">
				<?php echo $form->create('Locale',array('name'=>'form1','id'=>'form1','url'=>SITE_URL));?>
            	
				<label><?php echo __('SELECT_LANGUAGE',true);?></label>
				
				<?php foreach($localelist as $key => $value) {?>
				<?php if($this->Session->read('Locale.title') == $value['Locale']['title']) {?>
				<?php echo $html->image(FLAG_IMAGE_URL.$value['Locale']['flag'],array('title'=>$value['Locale']['title']));?>
				<?php } else {?>
				<a href="#" onclick="language(<?php echo $value['Locale']['id'];?>);">
				<?php echo $html->image(FLAG_IMAGE_URL.$value['Locale']['flag'],array('title'=>$value['Locale']['title']));?>
				</a>
				<?php }?>
				<?php }?>
				<?php echo $form->hidden('Locale.id',array('id'=>'langcode'))?>
				<?php $form->end();?>
            </div>
        </div>
        
    </div>
</div>
<!--header div end   here-->

