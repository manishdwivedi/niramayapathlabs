Dear <?php echo $user['User']['username']?>,

To log in to website just copy and paste following url in address bar:
<?php echo SITE_URL.'admin/users/login/';?>

Use the following values when prompted to log in:
Username: <?php echo $user['User']['username']?>
Password: <?php echo $user['User']['password']?>

Thanks
Admin