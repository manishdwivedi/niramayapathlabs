<?php 
//phpinfo();
?>
<script type="text/javascript">
function listing(){
window.location.href=siteUrl+"admin/locales/index";
return false;
}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Language</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;<?php echo $html->link('Manage Language(s)', '/admin/locales/index', array('title'=>'Language List')); ?>&nbsp;&#187;&nbsp;Add Language
	<?php echo $form->create('Member', array('url'=>'#','enctype'=>'multipart/form-data')); ?>
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
		<td class="boldText">Folder Name<font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Locale.locale_folder',array('class'=>'input-text','onclick'=>'checkname();'));?><br /><span style="font-size:12px; color:#666666;">(Please write the Folder Name for language which will going to add Ex.- For French (fra))</span>
			<?php 
			echo $form->error('Locale.locale_folder', array(
				'notEmpty'=>'This field can not be empty',
				'custom'=>'Please enter code with 3 characters in small alphabet'
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
			<?php echo $form->file('Locale.flag', array('class'=>'input-text')); ?>
			<?php 
			echo $form->error('Locale.flag', array(
				'notEmpty'=>'This field can not be empty'
				
			));?>
		</td>
	</tr>

	<tr>
		<td class="boldText">Language File<font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->file('Locale.lang_file', array('class'=>'input-text')); ?>
			<?php 
			echo $form->error('Locale.lang_file', array(
				'notEmpty'=>'This field can not be empty'
			));?>
			
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
	<tr>
		<td colspan="2"><?php echo $html->link('Download Language Sample File',array('controller'=>'locales','action'=>'download_file'));?></td>
	</tr>

	
	<tr>
		<td colspan="2">
			<table border="0" width="100%">
				<tr>
					<td>&nbsp;</td>
					<td style="font-weight:bold; color:red;">Instruction While Adding Language Content In Language File</td>
				</tr>
				<tr>
					<td style="font-weight:bold;">1- </td>
					<td>Save any language file only and only with name (default.po).</td>
				</tr>
				<tr>
					<td style="font-weight:bold;">2- </td>
					<td>In language file (msgid) indicates the english word and (msgstr) indicates the converted string in a particular language.</td>
				</tr>
				<tr>
					<td valign="top" style="font-weight:bold;">3- </td>
					<td>While adding language just copy the english word and write in msgid (Ex.- msgid "HOME") and in next line write the converted name of (Home) in particular language which you are going to add for this particular language folder (Ex.- msgstr "Converted Language String").</td>
				</tr>
				<tr>
					<td style="font-weight:bold;">4- </td>
					<td>In this way just make a language file for particular and meaningful words which you want to shown in particular language in website.</td>
				</tr>
				<tr>
					<td style="font-weight:bold;">5- </td>
					<td>Please write the folder name with 3 characters in lower case and this is specific for each language.</td>
				</tr>
				<tr>
					<td style="font-weight:bold;">6- </td>
					<td>Please write the language code with 2 characters in lower case and this is specific for each language.</td>
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