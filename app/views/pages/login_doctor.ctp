<script type="text/javascript">
function validationcc()
{
var str=true;
document.getElementById("msg11").innerHTML="";
document.getElementById("msg12").innerHTML="";
if(document.form3.LoginDoctorUsername.value=='')
{
	document.getElementById("msg11").innerHTML="Please Enter Email/Phone";
	str=false;
}

if(document.form3.LoginDoctorPass.value=='')
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

<div class="banner"><?php echo $this->Html->image('frontend/niramaya_dr_module_banner.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
  <div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread"><?php echo $this->Html->link('Doctor Login Panel','/pages/login_doctor');?></div>
        </div>
      </div>
<!--bodycontainer div start here-->

<?php echo $form->create(null, array('url'=>'/pages/login_doctor','id'=>'form3','name'=>'form3','class'=>'marTopNone','onsubmit'=>'return validationcc(this);')); ?>
<table border="0" width="100%" style="float:left;">
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><a href="<?php echo SITE_URL;?>pages/become_doctor" style="color:#0099FF; text-decoration:underline;">New Doctor SignUp</a></td>
	</tr>
	
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" style="color:#FF0000; font-family:Arial, Helvetica, sans-serif;"><?php echo $alert_mess;?></td>
	</tr>
	<tr>
		<td width="150">Email/Phone</td>
		<td width="10">:</td>
		<td>
			<?php echo $form->text('LoginDoctor.username',array('class'=>'input-text-css','placeholder'=>'Please enter Email/Phone'));?><br />
			<div id="msg11" style="color:#FF0000; font-size:12px; clear:both;"></div>
		</td>
	</tr>
	<tr>
		<td width="150">Password</td>
		<td width="10">:</td>
		<td>
			<?php echo $form->password('LoginDoctor.pass',array('class'=>'input-text-css','placeholder'=>'Password'));?>
			<div id="msg12" style="color:#FF0000; font-size:12px; clear:both;"></div>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="image" src="<?php echo SITE_URL?>img/frontend/submit-button.gif"></td>
	</tr>
</table>
<?php echo $form->end();?>