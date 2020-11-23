Dear <?php echo trim($data['Member']['first_name']).' '.trim($data['Member']['last_name']);?>

To log in website copy and paste the link <?php echo SITE_URL.'/members/login'; ?> in your browser and then enter your e-mail address and password.

Use the following values when prompted to log in:
E-mail: <?php echo $data['Member']['email']?>
Password: <?php echo $data['Member']['password']?>

Thanks,
Admin