<script>
function checknum(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	
	if(charCode > 31 && (charCode < 48 || charCode > 57)){
		console.log('----'+charCode);
		return false;
	} else {
		if($('#ProcessingLabsPhoneNumber').val().length<10)
			return true;
		else
			return false;
	}
}

function check()
{
	var doc_type = $('#doc_type').val();
	console.log(doc_type);
	if(doc_type=='doc')
	{
		$('#DocumentTypeMasterDummyLink').removeAttr('disabled');
	}
	else
	{
		$('#DocumentTypeMasterDummyLink').attr('disabled','true');
	}
}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Doucment Type</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/tests/view_document_list', array('title'=>'Doucment Type List')); ?>&nbsp;&#187;&nbsp;Doucment Type List
	<div>&nbsp;</div>	
	<?php echo $form->create(array('url'=>'/admin/tests/add_document_type','id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data'));?>
	<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
		<table border="0" width="100%">
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Document Type<font color="#FF0000">*</font></label>
				</td>
				<td>
					<select id="doc_type" name="data[DocumentTypeMaster][doc_type]" style="float:left" onchange="check()">
						<option value="">Select a Document Type</option>
						<?php foreach($type as $key => $val) {?>
							<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Name<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->text('DocumentTypeMaster.name', array('class'=>'input-text','style'=>'width:200px;')); ?>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Length<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->text('DocumentTypeMaster.length', array('class'=>'input-text','style'=>'width:200px;','onkeypress'=>'return checknum(event)')); ?>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Dummy Form Upload</label>
				</td>
				<td>
					<?php echo $form->file('DocumentTypeMaster.dummy_link',array('class'=>'input-text','accept'=>'.doc,.docx,.xls,.xlsx,.pdf,.PDF','disabled'=>'true'));?>
					<div id="msgReportFile" style="color:#FF0000; font-size:12px; clear:both;"></div>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<span id="ticketprocessing" style="color:Red;display:none;font-size: x-large;">Ticket is Being Raised.</span>
				<span id="ticketcompleted" style="color:Green;display:none;font-size: x-large;">Ticket submitted successfully.</span>
				<td><input id="ticketsubmit" class="btn" type="submit" onclick="return submit_ticket()" value="Submit"/></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>	
	<?php echo $form->end();?>
</div>
