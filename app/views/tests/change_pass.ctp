<?php //echo "<pre>gdfgdfgdf"; print_r($userdetail); exit;?>
<style type="text/css">
.submit {
float:left;
margin:10px 10px 0px 0px;
}
.innercontainer_bottom_right_row2{
padding:0;
}


.input-text {
    background: url("../img/bg_fade_sml.png") repeat-x scroll center top transparent;
    border: 1px solid #999999;
    border-radius: 3px 3px 3px 3px;
    color: #666666;
    margin-bottom: 5px;
    padding: 10px;
    width: 300px;
}

.btn, .btnalt {
   
    border: 1px solid #859C27 !important;
    color: #859C27;
    font-size: 12px;
    font-weight: 700;
    padding: 7px 10px;
	float:left;
}

.table-head{
	text-transform:uppercase; 
	font-size:12px; 
	text-align:center; 
	border:1px solid #999; 
	border-radius:3px; 
	background: none repeat scroll 0 0 #EDEDED; 
	padding:3px;
}

.loop-row-center
{
	font-weight:normal; 
	border-right:1px solid #999; 
	border-bottom:1px solid #999; 
	height:25px; 
	text-align:center; 
	padding:5px;
}

.loop-row-notcenter
{
	font-weight:normal; 
	border-right:1px solid #999; 
	border-bottom:1px solid #999; 
	height:25px; 
	padding:5px;
}
</style>
<script type="text/javascript">
function listing(){
window.location.href=siteUrl+"members/register";
return false;
}

function show_tab(val)
{
	if(val == 'loggedout')
	{
		window.location.href = siteUrl+'tests/logout';
	}
}
</script>
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
          <div class="bread"><?php echo $this->Html->link('My Account','/tests/my_account');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<!--bodycontainer div start here-->

<h2><?php echo $UserName."'s";?> <span class="green">Account</span></h2>

<div style="padding:100px 0px 0px 0px; font-weight:bold; font-size:12px;">
	<?php echo $form->create('ChangePassword',array('url'=>'/tests/change_pass'));?>
	<?php echo $form->hidden('User.user_id',array('value'=>$UserId));?>
	<table border="0" width="100%" style="border:1px solid #999; border-radius:3px;">
		<tr id="SampleRequest" style="display:block;">
			<td width="150" style="border-right:1px solid #999;" valign="top">
				<table border="0" width="100%">
					<tr>
						<td style="font-weight:normal; padding:5px 5px 5px 0; border-bottom:1px solid #999;" height="20"><a href="<?php echo SITE_URL;?>tests/my_account">Sample Requests</a></td>
					</tr>
					<tr>
						<td style="font-weight:normal; padding:5px 5px 5px 0; border-bottom:1px solid #999;" height="20"><a href="<?php echo SITE_URL;?>tests/change_pass">Change Password</a></td>
					</tr>
					<tr>
						<td style="font-weight:normal; padding:5px 5px 5px 0; border-bottom:1px solid #999;" height="20"><a href="javascript:void(0);" onclick="show_tab('loggedout');">Logout</a></td>
					</tr>
				</table>
			</td>
			<td valign="top">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="3" style="padding:10px; width:813px;"><h2 style="margin:0; text-align:center; text-decoration:underline; width:100%;">Change Password</h2></td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<?php if(!empty($mess_fail) && empty($mess_success)) {?>
					<tr height="50">
						<td style="font-size:12px; color:#FF0000; padding:0px 0px 0px 217px; font-weight:bold;" colspan="3"><?php echo $mess_fail;?></td>
					</tr>
					<?php }?>
					<?php if(empty($mess_fail) && !empty($mess_success)) {?>
					<tr height="50">
						<td style="font-size:12px; color:green; padding:0px 0px 0px 217px; font-weight:bold;" colspan="3"><?php echo $mess_success;?></td>
					</tr>
					<?php }?>
					<tr height="50">
						<td style="font-size:12px; width:152px; padding:10px; font-weight:bold;">Old Password</td>
						<td style="padding:10px; font-weight:bold;">:</td>
						<td><?php echo $form->password('User.old_pass',array('style'=>'width:300px; border-radius:5px; border:1px solid #999; height:35px;'));?></td>
					</tr>
					<tr height="50">
						<td style="font-size:12px; width:152px; padding:10px; font-weight:bold;">New Password</td>
						<td style="padding:10px; font-weight:bold;">:</td>
						<td style="font-size:12px;"><?php echo $form->password('User.new_pass',array('style'=>'width:300px; border-radius:5px; border:1px solid #999; height:35px;'));?></td>
					</tr>
					<tr height="50">
						<td style="font-size:12px; width:152px; padding:10px; font-weight:bold;">Confirm Password</td>
						<td style="padding:10px; font-weight:bold;">:</td>
						<td style="font-size:12px;"><?php echo $form->password('User.conf_pass',array('style'=>'width:300px; border-radius:5px; border:1px solid #999; height:35px;'));?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><?php echo $form->submit('submit-button.gif',array('alt'=>'Submit'));?></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
	</table>
</div>
