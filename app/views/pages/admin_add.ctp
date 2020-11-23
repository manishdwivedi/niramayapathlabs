<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Page</h2>
    </div>
    <div class="contentbox">
<?php echo $this->Session->flash(); ?>
<?php echo $javascript->link('fckeditor'); ?> 
<?php echo $form->create('', array('url'=>'/admin/pages/add/')); ?>
<script>
	jQuery(function() {
		jQuery("#eventtabs").tabs();
	});
</script>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<tr>
		<td colspan="2" align="left">
			<?php echo $html->link('Home', '/admin/admins/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;<?php echo $html->link('Manage Pages', '/admin/pages/index', array('title'=>'Manage Pages')); ?>
			<?php
				if(isset($breadcrumbs) && count($breadcrumbs) > 0) {
					foreach($breadcrumbs as $k=>$v) {
						if(trim($k)!='' || trim($v)!=''){
							echo "&nbsp;&#187;&nbsp;".$html->link(trim($v), '/admin/pages/index/', array('title'=>'Manage '.trim($v).' Pages'));
						}
					}
				}
			?>&nbsp;&#187;&nbsp;Add Page
		</td>
	</tr>
	<tr>
		<td class="borderTop bgDarkHeader" colspan="2"><h4></h4></td>
	</tr>
	<?php
		if($session->check('Message.flash')){
	?>
	<tr>
		<td colspan="2"><?php $session->flash();?></td>
	</tr>
	<?php			
		}
	?>
	
	<tr>
		<td colspan="2"  valign="top" class="boldText"></td>
        </tr>
        <tr >
		<td colspan="2">

				<div id="eventtabs" style="width:86%;">
        			<ul>
						<?php foreach($locales as $k=>$v) { ?>
							<li><?php if($v['Siteadminlang']['default']=='1') {?><a href="#<?php echo $v['Siteadminlang']['code']; ?>"><?php echo $v['Siteadminlang']['title'];?></a><?php }?></li>
						<?php } ?>
         			</ul>
					<div id="en">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="15%" valign="top" class="boldText">Title</td>
								<td>
									<?php echo $form->text('Page.title1', array('maxlength'=>'128', 'class'=>'input-text')); ?>
									<?php 
										//echo $form->error('title1', array(
											//'notEmpty' => 'Please enter title In both languages',
											//'validate_title'=>'Please enter content In both languages'
										//));
									?>
								</td>
							</tr>
							<tr>
								<td width="15%" valign="top" class="boldText">Description</td>
								<td>
									<?php 
										echo $form->textarea('Page.content1'); 
				 						echo $fck->load('Page.content1'); 
									?>
									<?php 
										//echo $form->error('content1', array(
											//'notEmpty'=>'Please enter content',
											//'ValidContent'=>'Please enter content In both languages'
										//));
										?>
								</td>
							</tr>
						</table>
					</div>
					
    			</div>
			









			<?php //echo $form->textarea('Page.content'); ?>
			<?php //echo $fck->load('Page.content'); ?> 
			<?php
				//echo $form->error('Page.content', array(
				//	'notEmpty'=>'Please enter content'
				//));
			?>
		</td>
	</tr>
	
	
	<tr>
		<td width="15%" valign="top" class="boldText">Status</td>
		<td>
			<?php echo $form->checkbox('Page.status'); ?>
		</td>
	</tr>
	<tr>
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Submit', array('div'=>false, 'class' => 'btn')); ?>
			<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>