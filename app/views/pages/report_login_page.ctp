<script type="text/javascript">
function validationcc()
{
var str=true;
document.getElementById("msg11").innerHTML="";
document.getElementById("msg12").innerHTML="";
if(document.form3.LoginUsername.value=='Please Enter Email/Phone')
{
	document.getElementById("msg11").innerHTML="Please Enter Email/Phone";
	str=false;
}

if(document.form3.LoginPass.value=='password')
{
	document.getElementById("msg12").innerHTML="Please Enter Password";
	str=false;
}

return str;
}
</script>
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
<div class="banner_res"><?php echo $this->Html->image('frontend/mobilebanner/niramaya_profiles.jpg',array('alt'=>'nirAmaya Heathcare','title'=>'nirAmaya Heathcare'))?></div>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
  <div id="bodyPart" class="inner_nir_page">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread"><?php echo $this->Html->link('View Report','/pages/report_login_page');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<!--bodycontainer div start here-->
<!--<h1><?php //echo $data[0]['Pagelocale']['title'];?><span class="green">niramaya</span></h1>-->
<h1 style="width:100%;">View <span class="green">Report</span></h1>


<?php echo $form->create(null, array('url'=>'/pages/login_report','id'=>'form3','name'=>'form3','class'=>'marTopNone','onsubmit'=>'return validationcc(this);')); ?>
<table border="0" width="100%" style="float:left;">
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	
	<tr>
		<td colspan="3"><p style="text-align:left;">To view report use your Mobile No. as a username and Request No. as a password</p></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<?php if($session->check('Message.flash')){ ?>
	<tr>
		<td colspan="3" style="color:#FF0000; font-family:Arial, Helvetica, sans-serif;"><?php $session->flash();?></td>
	</tr>
	<?php }?>
	<tr>
		<td width="150">Username</td>
		<td width="10">:</td>
		<td><?php echo $form->text('ViewReport.username',array('class'=>'input-text-css','placeholder'=>'Please enter Mobile No.'));?></td>
	</tr>
	<tr>
		<td width="150">Password</td>
		<td width="10">:</td>
		<td><?php echo $form->password('ViewReport.password',array('class'=>'input-text-css','placeholder'=>'Password'));?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>
			<table border="0" width="100%">
				<tr>
					<td width="135"><input type="image" src="<?php echo SITE_URL?>img/frontend/submit-button.gif"></td>
					<td><a href="<?php echo SITE_URL;?>pages/login_page">Customer Login</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php echo $form->end();?>