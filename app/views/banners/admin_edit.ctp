<style type="text/css">
.class-textarea
{
	border: 1px solid #999999;
    border-radius: 3px 3px 3px 3px;
    color: #666666;
    margin-bottom: 5px;
    padding: 10px;
    width: 300px;
	font-size:13px;
}

.hint-class
{
	color:#999999; 
	font-size:11px; 
	padding:0 0 0 10px;
}
</style>

<script language="JavaScript" type="text/javascript">
function validationc()
{
var str=true;
document.getElementById("msg1").innerHTML="";

document.getElementById("msg3").innerHTML="";
document.getElementById("msg4").innerHTML="";
document.getElementById("msg10").innerHTML="";


if(document.form1.BannerBannerName.value=='')
{
	document.getElementById("msg1").innerHTML="Please enter banner name";
	str=false;
}
if(document.form1.BannerBannerReporting.value=='')
{
	document.getElementById("msg10").innerHTML="Please enter banner reporting time";
	str=false;
}
if(document.form1.BannerBannerCode.value=='')
{
	document.getElementById("msg3").innerHTML="Please enter banner name";
	str=false;
}
if(document.form1.BannerBannerMrp.value=='')
{
	document.getElementById("msg4").innerHTML="Please enter banner name";
	str=false;
}



return str;
}
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit Banner</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Banner(s)', '/admin/banners/index', array('title'=>'Home')); ?> &#187; Edit Banner
	<?php echo $form->create(null, array('url'=>'/admin/banners/edit','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1','enctype'=>'multipart/form-data')); ?>
	<?php echo $form->hidden('Banner.id',array('value'=>$this->data['Banner']['id']));?>
	<?php echo $form->hidden('Banner.add_date',array('value'=>$this->data['Banner']['add_date']));?>
	<?php echo $form->hidden('Banner.status',array('value'=>$this->data['Banner']['status']));?>
	<?php echo $form->hidden('Banner.old_banner_image',array('value'=>$this->data['Banner']['banner_image']));?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	<tr>
		<td colspan="2"><?php echo $html->image(OFFER_IMAGE_THUMB_URL.$this->data['Banner']['banner_image']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Banner Name</td>
		<td>
			<?php echo $form->text('Banner.banner_name', array('class'=>'input-text')); ?>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Banner Code</td>
		<td>
			<?php echo $form->text('Banner.banner_code', array('class'=>'input-text')); ?>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Banner Mrp</td>
		<td>
			<?php echo $form->text('Banner.banner_mrp', array('class'=>'input-text')); ?>
			<div id="msg4" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Market Price</td>
		<td>
			<?php echo $form->text('Banner.banner_market_mrp', array('class'=>'input-text')); ?>
			
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Sequence</td>
		<td>
			<?php echo $form->text('Banner.sequence', array('class'=>'input-text')); ?>
			
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Reporting</td>
		<td>
			<?php echo $form->text('Banner.banner_reporting', array('class'=>'input-text')); ?>
			<div id="msg10" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Banner Image</td>
		<td>
			<?php echo $form->file('Banner.new_banner_image', array('class'=>'input-text')); ?>
			
		</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Add in Slideshow</td>
		<td>
			<input type="radio" name="data[Banner][show_status]" value="yes" <?php if($this->data['Banner']['show_status'] == 'yes') {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[Banner][show_status]" value="no" <?php if($this->data['Banner']['show_status'] == 'no') {?> checked="checked" <?php }?> />&nbsp;&nbsp;No
			
		</td>
	</tr>
	<tr>
                <td width="15%" class="boldText">Category</td>
		<td>
                    <?php e($form->select('Banner.profit_margin_category', $profit_category, null, array('class'=>'','empty'=>'Select Category'),null,false))?>
                </td>
        </tr>
	<tr>
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
			<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>