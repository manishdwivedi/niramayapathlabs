<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Assign Pincode</h2>
    </div>
    <div class="contentbox">
		<?php echo $this->Session->flash(); ?>
		<?php echo $html->link('Home', '/admin/plab/view_labs', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Assign Pincode
		<div>&nbsp;</div>
		<?php echo $form->create(array('id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data','action'=>'/edit_citytests/'.base64_encode($lab_id)));?>
		
		<table border="0" width="100%">
			<tr id="searchcity2">
				<td colspan="3">
					<table border="0" width="100%">
						<tr>
							<td>
								<!--<input type="radio" class="excelType" onclick="changeType(this)" id="excelupload" name="excelupload" value= "excelupload"/> Upload Pincode Excel -->
								<input type="radio" class="excelType" onclick="changeType(this)" id="singleentry" name="singleentry" value= "singleentry" checked/> Add Single Pincode
							</td>
						</tr>
						<tr><td style="height: 20px;"></td></tr>
						<!--<tr class="excel_upload" style="display:none;">
							<td>
								<label style="font-size:larger;font-weight:700;width:150px;float:left;">Processing Lab </label>
								<select name="plab" class="input-Search" style="width: 250px;height: 35px;font-size:14px;">
									<?php foreach($plabList as $key => $val) {?>
									<option style="font-size:14px;" value="<?php echo $key;?>"><?php echo $val;?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr class="excel_upload" style="display:none;">
							<td>
								<label style="font-size:larger;font-weight:700;width:150px;float:left;">Select file  </label>
								<input type="file" name="file" id="file" />
							</td>
						</tr>-->
						<tr class="single_entry">
							<td colspan="3">
								<div id="pincodelist">
									<label style="font-size:larger;font-weight:700;width:100px;float:left;">Pincode  </label>
									<input type="tel" id="pincode" onkeypress="return checkpin(this)" name="pincode" value="" placeholder="Enter Pincode" style="height:25px;"/>
									<input id="add" class="btn" type="button" onclick="add_pincode()" value="Search"/>
								</div>
								<div id="pincode_error" style="color:red;display:none;font-size:larger;"></div>
							</td>	
						</tr>
						<tr class="single_entry"><td style="height: 20px;"></td></tr>
						<tr>
							<td colspan="3" id="pincodeaction">
								
							</td>
						</tr>
						<tr class="single_entry"><td style="height: 20px;"></td></tr>
						<tr>
							<td colspan="3" id="excelpincode">
								<input id="excel" class="btn" type="button" onclick="excel_download()" value="Download Excel"/>
							</td>
						</tr>
						
						<!--<tr class="single_entry">
							<td colspan="3">
								<div id="selectedpincode">
									<label><h3>Selected Pincodes</h3></label>
									<?php foreach($pincodes as $val) {?>
										<div style="font-size:large;width:100px;float:left"><?php echo $val; ?><span id="<?php echo $val; ?>" style="cursor:pointer;font-weight:600;color:red;" onclick="remove_pincode(this.id);"> X </span></div>
									<?php } ?>
								</div>
							</td>
						</tr>-->
					</table>
				</td>
			</tr>
			<!--<tr id="submittr">
				<td><input id="ticketsubmit" class="btn" type="submit" onclick="return save_labinfo()" value="Submit"/></td>
			</tr>-->
		</table>
		<input id="pincodeliststring" name="pincodeliststring" type="hidden" value="<?php echo $pincodestring; ?>" />
		<input type="hidden" id="lab_id" name="lab_id" value="<?php echo $lab_id; ?>"/>
	<?php echo $form->end();?>
	</div>
</div>

<script>
	function checkpin(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		
		if(charCode > 31 && (charCode < 48 || charCode > 57)){
			return false;
		} else {
			if($('#pincode').val().length<6)
			{
				return true;
			}
			else
				return false;
		}
	}
	
	function add_pincode()
	{
		var pincode = $('#pincode').val();
		var lab_id = $('#lab_id').val();
		$('#pincode_error').show();
		$('#pincode_error').html("Searching Pincode");
		$('#add').hide();
		
		if(pincode.length == 6)
		{
			console.log(pincode);
			jQuery.ajax({
				type:'GET',
				url:siteUrl+'/plab/pincode_search?pincode='+pincode+'&labid='+lab_id,
				success:function(data){
					console.log(data);
					$('#pincode_error').hide();
					$('#pincodeaction').html(data);
					$('#add').show();
				}
			});
		}
		else
		{
			$('#pincode_error').html("Invalid Pincode has been Entered");
			$('#add').show();
		}
	}
	
	function pincode_action(val)
	{
		var pincode = $('#pincode').val();
		var lab_id = $('#lab_id').val();
		
		var data = {
			pincode : pincode,
			labid : lab_id,
			val : val
		};
				
		var r = confirm("Are You Sure?");
		if (r == true) {
		  jQuery.ajax({
				type:'POST',
				url:siteUrl+'/plab/pincode_action',
				data : data,
				success:function(response){
					console.log(response);
					$('#pincode_action').html(response);
				}
			});
		} else {
		  txt = "You pressed Cancel!";
		}
	}
	
	function excel_download()
	{
		var lab_id = $('#lab_id').val();
		$('#pincode_error').show();
		$('#pincode_error').html("Preparing Download. Please Wait");
		
		var url = siteUrl+'/plab/excel_download?labid='+lab_id;
		
		window.location = url;
		$('#pincode_error').hide();
	}
	
	function changeType(e)
	{
		console.log(e);
		if(e.id=='excelupload')
		{
			$('#excelupload').attr('checked', true);
			$('#singleentry').attr('checked', false);
			$('.excel_upload').show();
			$('.single_entry').hide();
		}
		else
		{
			$('#excelupload').attr('checked', false);
			$('#singleentry').attr('checked', true);
			$('.excel_upload').hide();
			$('.single_entry').show();
		}

	}

	function remove_pincode(id)
	{
		var pincodes = $("#pincodeliststring").val();
		var pincodearray = pincodes.split(',');
		var index = pincodearray.indexOf(id);
		pincodearray.splice(index,1);
		var pincodediv = "<label><h3>Selected Pincodes</h3></label>";
		for(var count=0;count<pincodearray.length;count++)
		{
			pincodediv +='<div style="font-size:large;width:100px;float:left">'+pincodearray[count]+'<span id="'+pincodearray[count]+'" style="cursor:pointer;font-weight:600;color:red;" onclick="remove_pincode(this.id);"> X </span></div>';
		}
		pincodediv += '<input id="pincodeliststring" type="hidden" value="'+pincodearray.join()+'" />';
		console.log(pincodediv);
		$("#pincodeliststring").val(pincodearray.join());
		$("#selectedpincode").html(pincodediv);
	}
</script>