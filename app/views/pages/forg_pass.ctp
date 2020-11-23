<?php //echo "<pre>gdfgdfgdf"; print_r($userdetail); exit;?>
<style type="text/css">
.submit {
float:left;
margin:10px 10px 0px 0px;
}
.innercontainer_bottom_right_row2{
padding:0;
}

.input-text-css
{
	border: 1px solid #D9D9D9;
    border-radius: 3px 3px 3px 3px;
    color: #666666;
    float: left;
    font: 11px arial;
    height: 25px;
    padding: 3px;
    width: 257px;
}
</style>

<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
  <div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home">Home Page</div>
          <div class="bread"><?php echo $this->Html->link('Forgot Password','/pages/forg_pass');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<!--bodycontainer div start here-->
<!--<h1><?php //echo $data[0]['Pagelocale']['title'];?><span class="green">niramaya</span></h1>-->
<h2>Forgot <span class="green">Password</span></h2>
<?php echo $form->create('ForgotPassword',array('url'=>'/pages/forg_pass'));?>
<table border="0" width="100%" style="float:left;">
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" style="color:#FF0000; font-family:Arial, Helvetica, sans-serif;"><?php echo $alert_mess;?></td>
	</tr>
	<tr>
		<td width="150">Email ID</td>
		<td width="10">:</td>
		<td><?php echo $form->text('User.email',array('class'=>'input-text-css'));?></td>
	</tr>
	<tr>
		<td width="150">Phone Number</td>
		<td width="10">:</td>
		<td><?php echo $form->text('User.phone',array('class'=>'input-text-css'));?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="image" src="<?php echo SITE_URL?>img/frontend/submit-button.gif"></td>
	</tr>
</table>
<?php echo $form->end();?>