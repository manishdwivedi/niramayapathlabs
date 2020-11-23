<?php
/* SVN FILE: $Id: default.thtml 4409 2007-02-02 13:20:59Z phpnut $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.view.templates.pages
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 4409 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-02-02 07:20:59 -0600 (Fri, 02 Feb 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
 $controller=$this->params['controller'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo WEBSITE_TITLE.' - '.$title_for_layout;?></title>
<link rel="icon" type="img/ico" href="<?php echo SITE_URL;?>img/niramaya_fav_icon.png">

<script type="text/javascript">
<!--
var siteUrl = '<?php echo SITE_URL;?>';
//-->
</script>
<?php 
if($controller=='members')
{
?>
	<?php echo $html->css('jquery/base/jquery.ui.all.css');?>
	<?php echo $javascript->link('jquery/jquery-1.6.2.js');?>
	<?php echo $javascript->link('jquery/jquery-ui-1.8.16.custom.js');?>
	
	<?php echo $javascript->link('jquery/jquery.ui.datepicker.js"');?>
	<?php echo $html->css('jquery/demos.css');?>
	<script>
	jQuery(function() {
		jQuery( "#MemberDob" ).datepicker({
			showOn: "button",
			buttonImage: "<?php echo $this->webroot;?>img/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy/mm/dd'
		});
		
	});
	</script>
<?php	
}
?>


<?php echo $html->css('admin/styles/layout');?>
<?php echo $html->css('admin/themes/green/styles');?>
<?php echo $html->css('admin/styles/login');?>
<?php //echo $javascript->link('jquery');?>
<?php echo $html->css('jquery/ui-lightness/admin/jquery-ui');?>
<?php //echo $javascript->link('prototype/prototype');?>

<?php //echo $javascript->link('admincommon');?>


<?php //echo $javascript->link('fckeditor'); ?>

<?php echo $javascript->link('admin/enhance');?>
<?php echo $javascript->link('admin/excanvas');?>
<?php echo $javascript->link('jquery/jquery.min');?>
<?php echo $javascript->link('jquery/jquery.ui');?>
<?php echo $javascript->link('admin/jquery.wysiwyg');?>
<?php echo $javascript->link('admin/visualize.jQuery');?>
<?php echo $javascript->link('admin/functions');?>
<script type="text/javascript">
<!--
var web_url = '<?php echo SITE_URL?>';
	//jQuery.noConflict();
//-->
function isNumberKey(evt,obj)
{   
	 var str=obj.value
	 var IsAllow=true;
	 var Char; 
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57) ) {  
	   alert('Enter Numeric Data');
	   return false;
	 }
	 return true;
}
</script>
<?php echo $javascript->link('common');?>
</head>

<body id="<?php if($session->check('Admin.id')) echo 'homepage'?>">
<?php echo $this->element('admin/header'); ?>
<?php if($session->check('Admin.id')) {?>

<div style="float:left; width:100%;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr><td width="235" valign="top"><?php echo $this->element('admin/leftnavigation'); ?>  </td>
<td valign="top"><div id="rightside">
<?php
}?>
<div>
	<?php if($this->Html->getCrumbs()){?>
		<div class="breadcrumbs">
			<?php echo $this->Html->getCrumbs(' &raquo; ','Home',array('class'=>'bread'));?>
		</div>
	<?php }?>


</div>
	<?php echo $content_for_layout;?>

</div></td></tr></table>



</div></div>
 <div id="footer">
	<?php echo $this->element('admin/footer'); ?>
</div> 
</body>
</html>
<?php echo $this->element('sql_dump'); ?>