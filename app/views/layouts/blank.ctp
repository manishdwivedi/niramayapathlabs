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
<?php echo $html->css('style');?>
<?php echo $html->css('jquery/ui-lightness/jquery-ui');?>
<?php echo $javascript->link('jquery'); ?>
<?php echo $javascript->link('jquery_002'); ?>
<?php echo $javascript->link('jquery/jquery.ui');?>
<?php echo $javascript->link('jquery.validate.js'); ?>
<script type="text/javascript">
<!--
var web_url = '<?php echo SITE_URL?>';
	//jQuery.noConflict();
//-->
</script>
</head>
	<?php echo $content_for_layout;?>
</html>


