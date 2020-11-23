<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script language="JavaScript" type="text/javascript">
function getdata() 
	{ 
		//alert("hello");
		$('#processing').show();
		$('#getrate').hide();
		var ratelist = $('#packageratelist').val();
		var testcode = $('#testcode').val();
		
		if(ratelist!='' && testcode !='')
		{
			$.ajax({
			type: "POST",
			url: siteUrl+"ratelist/getpackageestimate",
			data: {
				rate : ratelist,
				testcodes : testcode,
			},
			cache: false,
			success: function(html)
			{
				var data = html.split("@@@");
				console.log(html);
				$('#processing').hide();
				$('#getrate').show();
				$("#amount").val(data[0]);
				$("#testname").html(data[1]);
				$("#notavailable").html(data[2]);
				$("#notfound").html(data[3]);
			}
			});
		}
		return false;    
	}
</script>

<div class="contentcontainer">
	<div class="headings altheading">
        <h2>Get Package Estimate</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if($usertype != 'Agent') {?>
	<?php echo $html->link('Home', '/admin/ratelist/get_package_rate', array('title'=>'Home')); ?> &#187; Get Package Estimate
	<?php }?>
	
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		<tr>
			<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Rate List<font color="#FF0000">*</font></td>
			<td>
				<select name="packageratelist" id="packageratelist" class="input-text" required>
					<option>Select Rate List</option>
					<?php foreach($ratelist as $key => $val) {?>
					<option value="<?php echo $key;?>"><?php echo $val;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">TestCodes<font color="#FF0000">*</font></td>
			<td>
				<input type="text" class="input-text" required id="testcode" required/>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Test names<font color="#FF0000">*</font></td>
			<td id="testname" style="color:green;line-height: 25px;">
				
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Total Amount<font color="#FF0000">*</font></td>
			<td>
				<input type="text" class="input-text" required id="amount" readonly/>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Not Available<font color="#FF0000">*</font></td>
			<td id="notavailable" style="color:red;">
				
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Not Found<font color="#FF0000">*</font></td>
			<td id="notfound" style="color:red;">
				
			</td>
		</tr>
		<tr>
			<tr>
				<td>
					<span id="processing" style="display:none;font-size:large;color:red;">Processing Please Wait.</span>
					<input value="Get Estimate" type="button" class="btn" id="getrate" onclick="getdata();"/>
				</td>
			</tr>
		</tr>
	</table>
</div>