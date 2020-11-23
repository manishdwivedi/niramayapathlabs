<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Processing Lab</h2>
    </div>
    <div class="contentbox">
		<?php echo $this->Session->flash(); ?>
		<?php echo $html->link('Home', '/admin/plab/add_labs', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Add Processing Lab
		<div>&nbsp;</div>
		<?php echo $form->create(array('id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data'));?>
		<table border="0" width="100%">
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Name</label>
				</td>
				<td>
					<?php echo $form->text('ProcessingLabs.name', array('class'=>'input-text','style'=>'width:200px;')); ?>
					<label id="name_error" style="color:#FF0000; font-size:12px; clear:both;display:none;">Name Field cannot be empty.</label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Lab Code</label>
				</td>
				<td>
					<?php echo $form->text('ProcessingLabs.lab_code', array('class'=>'input-text','style'=>'width:200px;')); ?>
					<label id="code_error" style="color:#FF0000; font-size:12px; clear:both;display:none;">Code Field cannot be empty.</label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Address</label>
				</td>
				<td>
					<?php echo $form->textarea('ProcessingLabs.address', array('class'=>'input-text','style'=>'width:200px;')); ?>
					<label id="address_error" style="color:#FF0000; font-size:12px; clear:both;display:none;">Address Field cannot be empty.</label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Phone Number</label>
				</td>
				<td>
					<?php echo $form->text('ProcessingLabs.phone_number', array('class'=>'input-text','style'=>'width:200px;','onkeypress'=>'return checkphone(event)','type'=>'tel')); ?>
					<label id="phone_error" style="color:#FF0000; font-size:12px; clear:both;display:none;">Phone Field cannot be empty.</label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Email</label>
				</td>
				<td>
					<?php echo $form->text('ProcessingLabs.email', array('class'=>'input-text','style'=>'width:200px;','type'=>'email')); ?>
					<label id="email_error" style="color:#FF0000; font-size:12px; clear:both;display:none;">Email Field cannot be empty.</label>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<span id="ticketprocessing" style="color:Red;display:none;font-size: x-large;">Lab is Being Saved.</span>
				<span id="ticketcompleted" style="color:Green;display:none;font-size: x-large;">Lab Successfully Saved.</span>
				<td><input id="ticketsubmit" class="btn" type="submit" onclick="return save_labinfo()" value="Submit"/></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>	
	<?php echo $form->end();?>
	</div>
</div>
<script>
	function checkphone(evt)
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
	
	function save_labinfo()
	{
		var name = $('#ProcessingLabsName').val();
		var code = $('#ProcessingLabsLabCode').val();
		var phone = $('#ProcessingLabsPhoneNumber').val();
		var email = $('#ProcessingLabsEmail').val();
		var address = $('#ProcessingLabsAddress').val();
		var error = 0;
		if(name==''){
			$('#name_error').show();
			error++;
		}
		else
			$('#name_error').hide();
			
		if(code==''){
			$('#code_error').show();
			error++;
		}
		else
		{
			$('#code_error').hide();
		}		
		
		if(phone==''){
			$('#phone_error').show();
			error++;
		}
		else
			$('#phone_error').hide();	
			
		if(email==''){
			$('#email_error').show();
			error++;
		}
		else
			$('#email_error').hide();	
			
		if(address==''){
			$('#address_error').show();
			error++;
		}
		else
			$('#address_error').hide();	
			
		if(error>0)
			return false;
		else
			return true;
	}
</script>