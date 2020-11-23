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
<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		//minDate: 0,
		//maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		//minDate: 0,
		//maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
});
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Get Printout</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/samples/home', array('title'=>'Home')); ?>&#187;Get Printout
	<?php echo $form->create(null, array('url'=>'/admin/samples/printout','id'=>'form1','name'=>'form1')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	
	<tr>
		<td width="15%" class="boldText">Member</td>
		<td>
			<select name="data[Health][user_id]" class="input-text">
				<option value="0">Not a Member</option>
				<?php foreach($users as $key=>$val) {?>
				<option value="<?php echo $val['User']['id'];?>"><?php echo $val['User']['email'].' ('.$val['User']['username'].')';?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	
	
	<tr id="submit_div" style="display:none;">
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
			<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>