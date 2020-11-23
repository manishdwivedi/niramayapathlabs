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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo WEBSITE_TITLE.' - '.$title_for_layout;?></title>
<link rel="icon" href="<?php echo $this->webroot . 'favicon.ico';?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo $this->webroot . 'favicon.ico';?>" type="image/x-icon" />
<script type="text/javascript">
<!--
var siteUrl = '<?php echo SITE_URL;?>';
//-->
</script>
<?php echo $html->css('admin/styles/layout');?>
<?php echo $html->css('admin/themes/green/styles');?>
<?php echo $html->css('admin/styles/login');?>
<?php echo $javascript->link('jquery');?>
<?php //echo $html->css('jquery/ui-lightness/jquery-ui');?>
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

<body id="<?php if($session->check('User.id')) echo 'homepage'?>">
<?php if($session->check('User.id')) {?>
<?php echo $this->element('admin/header'); ?>

<?php echo $this->element('admin/leftnavigation'); ?>  
<div id="rightside">
<?php
}?>
	<?php echo $content_for_layout;?>
    <div id="footer">
       	<?php echo $this->element('admin/footer'); ?>
    </div> 
    </div><!-- closing of content container-->
</div>

 
</body>
</html>