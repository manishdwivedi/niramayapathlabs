<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Assign Tests</h2>
    </div>
    <div class="contentbox">
		<?php echo $this->Session->flash(); ?>
		<?php echo $html->link('Home', '/admin/plab/view_labs', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Assign Tests
		<div>&nbsp;</div>
		<?php echo $form->create(array('id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data','action'=>'/edit_test/'.base64_encode($lab_id)));?>
		
		<table border="0" width="100%">
			<tr id="searchtest1">
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Search Tests</label>
				</td>
			</tr>
			<tr id="searchtest2">
				<td colspan="1">
					<input id="stests" class="input-text" type="text" style="width: 230px;" value=""/>
					<input id="testsubmit" class="btn" type="button" onclick="search_tests()" value="Search"/>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div id="testlist">
						
					</div>
				</td>	
			</tr>
			<tr>
				<td colspan="3" id="excelpincode">
					<input id="excel" class="btn" type="button" onclick="excel_download()" value="Download Excel"/>
				</td>
			</tr>
			<!--<tr id="searchtest3">
				<td colspan="3">
					<div id="selectedtest">
					</div>
					<div id="test_error" style="color:red;display:none;"></div>
				</td>
			</tr>-->
			<tr><td colspan="3"><hr></td></tr>
			<!--<tr id="submittr">
				<td><input id="ticketsubmit" class="btn" type="submit" onclick="return save_labinfo()" value="Submit"/></td>
			</tr>-->
		</table>
		
		<label id="selectedtestcode" style="display:none;"><?php echo $tests; ?></label>
		<input type="hidden" id="lab_id" name="lab_id" value="<?php echo $lab_id; ?>"/>
	<?php echo $form->end();?>
	</div>
</div>

<script>
	
	function search_tests()
	{
		var test = $('#stests').val();
		var plab_id = $('#lab_id').val();
		$.ajax({
			type:'POST',
			url:siteUrl+'admin/plab/searchtest',
			data : {
				test : test,
				plab_id : plab_id,
			},
			success:function(result){
				$('#testlist').html(result);
			}
		});
	}
	
	function edit(id)
	{
		$("input[name= 'test["+id+"][code]']").removeAttr("readonly"); 
		$("input[name= 'test["+id+"][mrp]']").removeAttr("readonly"); 
		$("input[name= 'test["+id+"][net_price]']").removeAttr("readonly"); 
		$("input[name= 'test["+id+"][tat]']").removeAttr("readonly"); 
		
		$("input[name= 'test["+id+"][code]']").css({'background-color' : 'white'});
		$("input[name= 'test["+id+"][mrp]']").css({'background-color' : 'white'});
		$("input[name= 'test["+id+"][net_price]']").css({'background-color' : 'white'});
		$("input[name= 'test["+id+"][tat]']").css({'background-color' : 'white'});
		
		$("#remove_"+id).show();
		$("#save_"+id).show(); 
		$("#cancel_"+id).show(); 
		$("#edit_"+id).hide(); 
	}
	
	function cancel(id)
	{
		$('.test_error').remove();
		$("input[name= 'test["+id+"][code]']").attr("readonly","true"); 
		$("input[name= 'test["+id+"][mrp]']").attr("readonly","true"); 
		$("input[name= 'test["+id+"][net_price]']").attr("readonly","true"); 
		$("input[name= 'test["+id+"][tat]']").attr("readonly","true");
		
		$("input[name= 'test["+id+"][code]']").css({'background-color' : 'lightgray'});
		$("input[name= 'test["+id+"][mrp]']").css({'background-color' : 'lightgray'});
		$("input[name= 'test["+id+"][net_price]']").css({'background-color' : 'lightgray'});
		$("input[name= 'test["+id+"][tat]']").css({'background-color' : 'lightgray'});
		
		$("#remove_"+id).hide();
		$("#save_"+id).hide(); 
		$("#cancel_"+id).hide(); 
		$("#edit_"+id).show(); 
	}
	
	function save(id,status)
	{
		var error=0;
		var test = $('#stests').val();
		$('.test_error').remove();
		var plab_id = $('#lab_id').val();
		
		if(status==1)
		{
			var testcode = $('#code_'+id).val();
			var mrp = $('#mrp_'+id).val();
			var net = $('#net_'+id).val();
			var tat = $('#tat_'+id).val();
			
			if(testcode=="")
			{
				$('#code_'+id).after( "<div class='test_error' style='color:red'>Field can't be Empty</div>" );
				error++;
			}
			
			if(mrp=="")
			{
				$('#mrp_'+id).after( "<div class='test_error' style='color:red'>Field can't be Empty</div>" );
				error++;
			}
			
			if(net=="")
			{
				$('#net_'+id).after( "<div class='test_error' style='color:red'>Field can't be Empty</div>" );
				error++;
			}
			
			if(tat=="")
			{
				$('#tat_'+id).after( "<div class='test_error' style='color:red'>Field can't be Empty</div>" );
				error++;
			}
			
			
			var data = {
				id : id,
				testcode : testcode,
				mrp : mrp,
				net : net,
				tat : tat,
				status : status,
				lab_id : plab_id,
				search_param : test
			};
		}
		else
		{
			var data = {
				id : id,
				status : status,
				lab_id : plab_id,
				search_param : test
			};
		}
		console.log(data);
		if(error==0)
		{
			jQuery.ajax({
				type:'POST',
				url:siteUrl+'/plab/test_action',
				data : data,
				success:function(response){
					console.log(response);
					$('#testlist').html(response);
				}
			});
		}

	}	
	
	function excel_download()
	{
		var plab_id = $('#lab_id').val();
		$('#pincode_error').show();
		$('#pincode_error').html("Preparing Download. Please Wait");
		
		var url = siteUrl+'/plab/test_excel_download?labid='+plab_id;
		
		window.location = url;
		$('#pincode_error').hide();
	}
</script>