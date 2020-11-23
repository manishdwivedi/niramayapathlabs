<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Assign City And Tests</h2>
    </div>
    <div class="contentbox">
		<?php echo $this->Session->flash(); ?>
		<?php echo $html->link('Home', '/admin/plab/city_tests', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Assign City And Tests
		<div>&nbsp;</div>
		<?php echo $form->create(array('id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data'));?>
		
		<table border="0" width="100%">
			<tr id="searchcity1">
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Search City</label>
				</td>
				
			</tr>
			<tr id="searchcity2">
				<td colspan="3">
					<table border="0" width="100%">
						<tr>
							<td width="20%">
								<select name="state" id="state" class="input-text" style="width:100%" readonly>
									<option value="">Select State</option>
									<?php foreach($state as $key => $val) {?>
									<option value="<?php echo $val['State']['id'];?>"><?php echo $val['State']['name'];?></option>
									<?php }?>
								</select>
							</td>
							<td width="20%" id="citytd" style="display:none;">
								<select name="city" id="city" class="input-text" style="display:none;width:100%" readonly>
									<option value="">Select City</option>
									<?php foreach($state as $key => $val) {?>
									<option value="<?php echo $val['State']['id'];?>"><?php echo $val['State']['name'];?></option>
									<?php }?>
								</select>
							</td>
							<td>
								<input id="ticketsubmit" class="btn" type="button" onclick="search_city()" value="Search"/>
							</td>
						</tr>
						<tr>
							<td>
								<label id="processingcities" style="display:none;color:green;width:100%;" readonly>Fetching City List</label>
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<div id="pincodelist">
									
								</div>
								<div id="pincode_error" style="color:red;display:none;"></div>
							</td>	
						</tr>
						<tr>
							<td colspan="3">
								<div id="selectedpincode" style="display:none;">
									<label><h3>Selected Pincodes</h3></label>
									<input id="pincodes" name="pincodes" style="font-size:large;border:none;width:100%;" value="" readonly></label>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td colspan="3" id="next" ><input id="nexttest" class="btn" type="button" onclick="nextscreen()" value="Select Tests"/></td></tr>
			<tr id="searchtest1" style="display:none;">
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Search Tests</label>
				</td>
			</tr>
			<tr id="searchtest2" style="display:none;">
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
				<td colspan="3">
					<div id="selectedtest">
					</div>
					<div id="test_error" style="color:red;display:none;"></div>
				</td>
			</tr>
			<tr><td colspan="3"><hr></td></tr>
			<tr id="submittr" style="display:none;">
				<td><input id="ticketsubmit"  class="btn" type="submit" onclick="return save_labinfo()" value="Submit"/></td>
			</tr>
		</table>
		
		<label id="selectedtestcode" style="display:none;"></label>
		<input type="hidden" id="lab_id" name="lab_id" value="<?php echo $lab_id; ?>"/>
	<?php echo $form->end();?>
	</div>
</div>

<script>
	function nextscreen()
	{
		var pincodes = $('#pincodes').val();
		if(pincodes=='')
		{
			$('#pincode_error').html("Atleast one Pincode Should be selected");
			$('#pincode_error').show();
			error++;
		}
		else
		{
			$('#searchcity1').hide();
			$('#searchcity2').hide();
			$('#nexttest').hide();
			$('#searchtest1').show();
			$('#searchtest2').show();
			$('#submittr').show();
		}
	}
	
	function save_labinfo()
	{
		var pincodes = $('#pincodes').val();
		var testlist = $('#selectedtestcode').html();
		var error = 0;

		if(pincodes=='')
		{
			$('#pincode_error').html("Atleast one Pincode Should be selected");
			$('#pincode_error').show();
			error++;
		}
		
		if(testlist=='')
		{
			$('#test_error').html("Atleast one Tests Should be selected");
			$('#test_error').show();
			error++;
		}
		
		if(error > 0)
		{
			return false;
		}
	}
	function search_city(){
		var cityname = $('#city').val();
		var pincodes = $('#pincodes').val();
		//alert(cityname);
		$.ajax({
			type:'POST',
			url:siteUrl+'admin/plab/searchcity',
			data : {
				city : cityname,
				pincodes : pincodes,
			},
			success:function(result){
				$("#pincodelist").html(result);
		//		console.log(result);
			}
		});
	}

	$('#state').on('change', function() {
	  $('#pincode_error').hide();
	  $('#citytd').hide();
	  $("#processingcities").show();
	  $("#city").hide();
	  var state = this.value;
		$.ajax({
			type:'POST',
			url:siteUrl+'admin/plab/getcity',
			data : {
				name : state,
			},
			success:function(result){
				$("#city").html(result);
				$("#processingcities").hide();
				$('#citytd').show();
				$("#city").show();
			}
		});
	});
	
	function checktest(id)
	{
		$('#test_error').hide();
		var testlist = $('#selectedtestcode').html();
		var testcodelist = [];
		if(testlist != '')
			testcodelist = testlist.split(",");
		
		if ($('#'+id).is(':checked')) {
		  testcodelist.push(id);
		}
		else
		{
			var index = testcodelist.indexOf(id.toString());
			if (index > -1) {
			  testcodelist.splice(index, 1);
			}
		}
		$('#selectedtestcode').html(testcodelist.join());
		$.ajax({
			type:'POST',
			url:siteUrl+'admin/plab/testtable',
			data : {
				testlist : testcodelist,
			},
			success:function(result){
				$('#selectedtest').html(result);
	//			console.log(result);
			}
		});
	}
	
	function checkpincode(pin)
	{
		var pincodes = $('#pincodes').val();
		var pincodelist = [];
		if(pincodes != '')
			pincodelist = pincodes.split(",");
					
		if ($('#'+pin).is(':checked')) {
		  pincodelist.push(pin);
		}
		else
		{
			var index = pincodelist.indexOf(pin.toString());
//			console.log(index);
			if (index > -1) {
			  pincodelist.splice(index, 1);
			}
		}
		
		if (typeof pincodelist !== 'undefined' && pincodelist.length > 0) {
			$('#selectedpincode').show();
		}
		else
			$('#selectedpincode').hide();
			
		$('#pincodes').val(pincodelist.join());
	}

	function search_tests()
	{
		var test = $('#stests').val();
		var selectedtest = $('#selectedtestcode').html();
		$.ajax({
			type:'POST',
			url:siteUrl+'admin/plab/searchtest',
			data : {
				test : test,
				selectedtest : selectedtest,
			},
			success:function(result){
				$('#testlist').html(result);
			}
		});
	}
</script>