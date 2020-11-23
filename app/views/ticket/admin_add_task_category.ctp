<script>
	function checklist()
	{
		var checkBox = document.getElementById("TaskCategoryChecklist");
		
		if (checkBox.checked == true){
			$('#check_list').show();
	    } else {
			$('#check_list').hide();
	    }
	}

	function req_doc()
	{
		var checkBox = document.getElementById("TaskCategoryRequiredDocs");
		
		if (checkBox.checked == true){
			$('#doc_list').show();
	    } else {
			$('#doc_list').hide();
	    }
	}

	function addmorechecklist()
	{
		var html = $('#check_files input');
		var htmldata = $('#check_files').html();
		var count = html.length;
		count++;
		if(count>1)
			$('#removecheck').show();

		htmldata += "<input type='text' name='check[list]["+count+"]' id='checklist"+count+"' class='input-text' style='display: list-item; margin-bottom:10px;width:200px;' required>";
		$('#check_files').html(htmldata);

	}

	function removechecklist()
	{
		var html = $('#check_files input');
		var htmldata = $('#check_files').html();
		var count = html.length;
		if(count<=2)
			$('#removecheck').hide();

		$( "#checklist"+count).remove();
	}

	function addmoredoc()
	{
		var html = $('#doc_files input');
		var htmldata = $('#doc_files').html();
		var count = html.length;
		count++;
		if(count>1)
			$('#removedoc').show();

		htmldata += "<input type='text' name='doc[list]["+count+"]' id='doclist"+count+"' class='input-text' style='display: list-item; margin-bottom:10px;width:200px;' required>";
		$('#doc_files').html(htmldata);
	}

	function removedoc()
	{
		var html = $('#doc_files input');
		var htmldata = $('#doc_files').html();
		var count = html.length;
		if(count<=2)
			$('#removedoc').hide();

		$( "#doclist"+count).remove();
	}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Create Task Category</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/ticket/index', array('title'=>'Create Task')); ?>&nbsp;&#187;&nbsp;Create Task Category
	<div>&nbsp;</div>	
	<?php echo $form->create(array('url'=>'/admin/ticket/add_task_category','id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data'));?>
		<table border="0" width="100%">
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Name<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->text('TaskCategory.name', array('class'=>'input-text','style'=>'width:200px;')); ?>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Description<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->textarea('TaskCategory.description', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Instructions<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->textarea('TaskCategory.instructions', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Checklist<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->checkbox('TaskCategory.checklist', array('class'=>'','onclick'=>'checklist()')); ?>
				</td>
			</tr>
			
			<tr id="check_list" style="display:none;">
				<td></td>
				<td>
					<div id="check_files" style="float:left">
						<input type="text" id="checklist11" name="check[list][1]" class="input-text" style="display: list-item;margin-bottom:10px;width:200px;" required>
					</div>
					<a href="javascript:void(0);" onclick="addmorechecklist()" style="margin-left: 10px;font-size:14px;float:left; background-color: #b5d438;color: aliceblue;padding: 10px;">+ Add More</a>
					<a href="javascript:void(0);" id="removecheck" onclick="removechecklist()" style="display:none;margin-left: 10px;font-size:14px;float:left; background-color: #bdd756;color: aliceblue;padding: 10px;"> Remove Last</a>
				</td>
			</tr>
			
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Support Documents<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->checkbox('TaskCategory.required_docs', array('class'=>'','onclick'=>'req_doc()')); ?>
				</td>
			</tr>

			<tr id="doc_list" style="display:none;">
				<td></td>
				<td>
					<div id="doc_files" style="float:left">
						<input type="text" id="doclist11" name="doc[list][1]" class="input-text" style="display: list-item;margin-bottom:10px;width:200px;" required>
					</div>
					<a href="javascript:void(0);" onclick="addmoredoc()" style="margin-left: 10px;font-size:14px;float:left; background-color: #b5d438;color: aliceblue;padding: 10px;">+ Add More</a>
					<a href="javascript:void(0);" id="removedoc" onclick="removedoc()" style="display:none;margin-left: 10px;font-size:14px;float:left; background-color: #bdd756;color: aliceblue;padding: 10px;"> Remove Last</a>
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<span id="ticketprocessing" style="color:Red;display:none;font-size: x-small;">Ticket is Being Raised.</span>
				<span id="ticketcompleted" style="color:Green;display:none;font-size: x-small;">Ticket submitted successfully.</span>
				<td><input id="ticketsubmit" class="btn" type="submit" onclick="return submit_ticket()" value="Submit"/></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>	
	<?php echo $form->end();?>
</div>
