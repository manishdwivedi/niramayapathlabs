Dear <?php echo trim($data['Member']['user_name']);?>,

Thanks for registering on <?php echo WEBSITE_TITLE;?>,
			
To complete your registration, please click the following link: <?php echo $html->link('Confirm Registration', SITE_URL.'members/confirmation/code:'.$data['Member']['random_string']); ?>

Or you may copy the following text link and enter it into your browser address bar to confirm your registration:
<?php echo SITE_URL.'members/confirmation/code:'.$data['Member']['random_string'];	?>

<!-- Use the following values when prompted to log in:
Username: <?php //echo $data['Member']['user_name']?>
Password: <?php //echo $data['Member']['password']?> -->

Thank you

