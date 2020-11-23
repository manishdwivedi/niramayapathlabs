<?php 
//phpinfo(); 
//echo "<pre>"; print_r($this->data); exit;
?>
<script type="text/javascript">
function listing(){
window.location.href=siteUrl+"admin/locales/index";
return false;
}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit Language</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;<?php echo $html->link('Manage Language(s)', '/admin/locales/index', array('title'=>'Language List')); ?>&nbsp;&#187;&nbsp;Edit Language
	<?php echo $form->create('Locale', array('url'=>'#','enctype'=>'multipart/form-data')); ?>
	<?php echo $form->hidden('Locale.id');?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%" style="border: 1px solid #DEDEDE; margin:10px 0px 0px 0px; padding:10px;">
	
	<tr>
		<td colspan="6" style="color:#FF0000; font-weight:bold;">Fields marked with * are mandatory.</td>
	</tr>
	<tr>
		<td class="boldText">Language Title<font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Locale.title',array('class'=>'input-text','onclick'=>'checkname();'));?><br /><span style="font-size:12px; color:#666666;">(Please write Title in that language which will going to add Ex.- For French (Fran&Acirc;&sect;ais))</span>
			<?php 
			echo $form->error('Locale.title', array(
				'notEmpty'=>'Please enter Language Title',
			));?>
		</td>
	</tr>
	<tr>
		<td class="boldText">Language Code<font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Locale.code',array('class'=>'input-text','onclick'=>'checkname();'));?><br /><span style="font-size:12px; color:#666666;">(Please write the language code for language which will going to add Ex.- For French (fr))</span>
			<?php 
			echo $form->error('Locale.code', array(
				'notEmpty'=>'This field can not be empty',
				'custom'=>'Please enter code with 2 characters in small alphabet'
			));?>
		</td>
	</tr>
	<tr>
		<td class="boldText">Currency Abbrevation<font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Locale.curr_abbrevation',array('class'=>'input-text','style'=>'width:60px;'));?>&nbsp;&nbsp;<span style="font-size:12px; color:#666666;">(Please write currency abbrevation for adding language Ex.-JPY,INR)</span>
			<?php 
			echo $form->error('Locale.curr_abbrevation', array(
				'notEmpty'=>'This field can not be empty'
			));?>
		</td>
	</tr>
	<tr>
		<td class="boldText">Exchange Rate<font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Locale.curr_exchange',array('class'=>'input-text','onclick'=>'checkname();'));?><br /><span style="font-size:12px; color:#666666;">(Please write currency exchange rate Ex.-INR45 = $1 So, write $.45 for US Dollar)</span>
			<?php 
			echo $form->error('Locale.curr_exchange', array(
				'notEmpty'=>'This field can not be empty'
			));?>
		</td>
	</tr>

	<tr>
		<td class="boldText">Flag Image<font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->file('Locale.flag',array('class'=>'input-text'));?>
			<?php 
			echo $form->error('Locale.flag', array(
				'notEmpty'=>'This field can not be empty'
			));?>
		</td>
	</tr>
	<?php echo $form->hidden('Locale.oldflag',array('value'=>$this->data['Locale']['flag']));?>
	<tr>
		<td class="boldText">Language File<font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->file('Locale.lang_file', array('class'=>'input-text')); ?><br />
			<?php if($oldfileexists == 'oldfileexists') {?>
			<span style="font-size:14px; color:#333333; font-weight:bold;">(Please first download the previous language file before uploading new file from the link given below.)</span>
			<?php }?><br />
			<span style="font-size:12px; color:#666666;">(This language file totally overwrites the previous language file. Please download previous file and make changes to them after that upload that new file here this will avoid loosing data of old file.)</span>
			
		</td>
	</tr>

	<tr>
		<td class="boldText">Default</td>
		<td><?php echo $form->checkbox('Locale.default'); ?></td>
	</tr>
	<tr>
		<td class="boldText">Status</td>
		<td><?php echo $form->checkbox('Locale.status'); ?></td>
	</tr>
	<?php 
		if(is_dir(LOCALE_PATH.$this->data['Locale']['locale_folder'])) 
		{
			if(is_dir(LOCALE_PATH.$this->data['Locale']['locale_folder'].'/LC_MESSAGES'))
			{
				if(file_exists(LOCALE_PATH.$this->data['Locale']['locale_folder'].'/LC_MESSAGES/default.po'))
				{
	?>
	<tr>
		<td colspan="2"><?php echo $html->link('Download Existing Language File',array('controller'=>'locales','action'=>'edit_file',$this->data['Locale']['id']));?></td>
	</tr>
	<?php 
				}
				else
				{
	?>
	<tr>
		<td colspan="2">No File Exist For Language</td>
	</tr>
	<?php 
				
				}
			}
			else
			{
	?>
	<tr>
		<td colspan="2">No Folder Exist For Language</td>
	</tr>
	<?php 	
			}
		}
		else
		{
	?>
	<tr>
		<td colspan="2">No Folder Exist For Language</td>
	</tr>
	<?php 
		}
		
	?>
	
	<tr>
		<td colspan="2">
			<table border="0" width="100%">
				<tr>
					<td>&nbsp;</td>
					<td style="font-weight:bold; color:red;">Instruction While Editing Language Content In Language File</td>
				</tr>
				<tr>
					<td style="font-weight:bold;">1- </td>
					<td>Download the previous file. If their is no file make new file with name (default.po) and upload that one.</td>
				</tr>
				<tr>
					<td style="font-weight:bold;">2- </td>
					<td>If file exists then download the previous file and make changes in that file.</td>
				</tr>
				<tr>
					<td valign="top" style="font-weight:bold;">3- </td>
					<td>After updating the language file upload the updated file.</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>
		<td><?php echo $form->submit('Submit', array('div'=>false, 'class' => 'btn')); ?>&nbsp;&nbsp;<?php echo $form->submit('Cancel', array('div'=>false, 'class' => 'btn','onclick'=>'return listing();')); ?></td>
	</tr>
	
</table>
<?php echo $form->end(); ?>
</div>