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
<html>
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
<?php echo $javascript->link('jquery');?>
<?php echo $html->css('jquery/ui-lightness/jquery-ui');?>
<?php echo $javascript->link('prototype/prototype');?>
<?php echo $javascript->link('jquery/jquery.min');?>

<script type="text/javascript">
<!--
	jQuery.noConflict();
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
<?php echo $javascript->link('jquery/jquery.ui');?>
<?php echo $javascript->link('common');?>
<?php echo $javascript->link('fckeditor'); ?>
</head>
<body id="homepage" class="<?php echo trim($this->params['controller']).'_'.trim($this->params['action']); ?>">

<?php echo $this->element('admin/header'); ?>
<?php echo $this->element('admin/leftnavigation'); ?>  
	<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
	
		<tr>
			<td valign="top" align="center" id="middle">
				<?php echo $content_for_layout; ?>
			</td>
		</tr>
		<?php echo $this->element('admin/footer'); ?>
	</table>
	<?php //echo $cakeDebug?>
    <script type="text/javascript" src="http://dwpe.googlecode.com/svn/trunk/_shared/EnhanceJS/enhance.js"></script>	
    <script type='text/javascript' src='http://dwpe.googlecode.com/svn/trunk/charting/js/excanvas.js'></script>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js'></script>
	<script type='text/javascript' src='scripts/jquery.wysiwyg.js'></script>
    <script type='text/javascript' src='scripts/visualize.jQuery.js'></script>
    <?php echo $javascript->link('functions');?>
</html>