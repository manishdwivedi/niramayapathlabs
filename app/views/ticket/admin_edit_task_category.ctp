<script>
	function check_type()
	{
		var type= $('#tc_type').val();
		
		if(type=="sc")
		{
			$('#c_type').show();
		}
		else
		{
			$('#c_type').hide();
		}
	}

	function checklist()
	{
		var checkBox = document.getElementById("TaskCategoryChecklist");
		
		if (checkBox.checked == true){
			$('#check_list').show();
			$('.check').attr("required", true);
	    } else {
			$('#check_list').hide();
			$('.check').attr("required", false);
	    }
	}

	function req_doc()
	{
		var checkBox = document.getElementById("TaskCategoryRequiredDocs");
		
		if (checkBox.checked == true){
			$('#doc_list').show();
			$('.doc').attr("required", true);
	    } else {
			$('#doc_list').hide();
			$('.doc').attr("required", false);
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
    <?php echo $html->link('Home', '/admin/ticket/task_category', array('title'=>'Create Task')); ?>&nbsp;&#187;&nbsp;Create Task Category
	<div>&nbsp;</div>	
	<?php echo $form->create(array('url'=>'/admin/ticket/edit_task_category/'.base64_encode($this->data['TaskCategory']['id']),'id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data'));?>
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
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Type</label>
				</td>
				<td>
					<select name="data['TaskCategory']['c_type']" id="tc_type" onchange="check_type()" required>
						<option value="c" <?php if($this->data['TaskCategory']['c_type']=="c") echo "selected"; ?>>Category</option>
						<option value="sc" <?php if($this->data['TaskCategory']['c_type']=="sc") echo "selected"; ?>>Sub Category</option>
					</select>
				</td>
			</tr>
			<?php if($this->data['TaskCategory']['c_type']=="sc"){?>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Parent Category<font color="#FF0000">*</font></label>
				</td>
				<td>
					<select name="data['TaskCategory']['c_type']" id="category_type">
						<?php  foreach($p_cat as $key=>$val){ ?>
							<option value="<?php echo $key; ?>" <?php if($key==$this->data['TaskCategory']['parent_id']) echo "selected"; ?>><?php echo $val; ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<?php } ?>
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
			
			<tr id="check_list" style="display:<?php if(empty($this->data['TaskCategory']['checklist'])) echo 'none';?>">
				<td></td>
				<td>
					<div id="check_files" style="float:left">
						<?php $checks = explode('@@@',$this->data['TaskCategory']['checklist']);
						$count = 1;
						foreach($checks as $val){
						?>
						<input type="text" id="checklist<?php echo $count;?>" name="check[list][<?php echo $count;?>]" value="<?php echo $val; ?>" class="input-text check" style="display: list-item;margin-bottom:10px;width:200px;">
						<?php $count++; } ?>
					</div>
					<a href="javascript:void(0);" onclick="addmorechecklist()" style="margin-left: 10px;font-size:14px;float:left; background-color: #b5d438;color: aliceblue;padding: 10px;">+ Add More</a>
					<a href="javascript:void(0);" id="removecheck" onclick="removechecklist()" style="display:<?php if(count($checks)< 2 ) echo 'none';?>;margin-left: 10px;font-size:14px;float:left; background-color: #bdd756;color: aliceblue;padding: 10px;"> Remove Last</a>
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

			<tr id="doc_list" style="display:<?php if(empty($this->data['TaskCategory']['required_docs'])) echo 'none';?>">
				<td></td>
				<td>
					<div id="doc_files" style="float:left">
					<?php $docs = explode('@@@',$this->data['TaskCategory']['required_docs']);
						$count = 1;
						foreach($docs as $val){
						?>
						<input type="text" id="doclist<?php echo $count;?>" name="doc[list][<?php echo $count;?>]" value="<?php echo $val; ?>" class="input-text doc" style="display: list-item;margin-bottom:10px;width:200px;">
						<?php $count++; } ?>
					</div>
					<a href="javascript:void(0);" onclick="addmoredoc()" style="margin-left: 10px;font-size:14px;float:left; background-color: #b5d438;color: aliceblue;padding: 10px;">+ Add More</a>
					<a href="javascript:void(0);" id="removedoc" onclick="removedoc()" style="display:<?php if(count($docs)< 2 ) echo 'none';?> ;margin-left: 10px;font-size:14px;float:left; background-color: #bdd756;color: aliceblue;padding: 10px;"> Remove Last</a>
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<span id="ticketprocessing" style="color:Red;display:none;font-size: x-small;">Ticket is Being Raised.</span>
				<span id="ticketcompleted" style="color:Green;display:none;font-size: x-small;">Ticket submitted successfully.</span>
				<td><input id="ticketsubmit" class="btn" type="submit" value="Submit"/></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>	
	<?php echo $form->end();?>
</div>
