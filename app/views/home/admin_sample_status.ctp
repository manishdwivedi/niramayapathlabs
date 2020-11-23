<script type="text/javascript">
$(function() {
	$( ".datepicker1" ).datepicker({
		minDate: '-30D',
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
});
</script>

<div class="contentcontainer">
	<div class="headings altheading">
		<h2 >Sample Status Manual</h2>
    </div>
	<div class="contentbox">
		<form target="_blank" action="" method="post" enctype="multipart/form-data">
			<b><label style="width:70px;float:left;margin-top:20px;"> From Date</label></b><input autocomplete="off" type="text" name="req_from_date" class="input-Search datepicker1" style="margin-top:20px;height: 25px;font-size:14px;width:100px;" placeholder="From Date" required/>
			<br>
			<b> <label style="width:70px;float:left;margin-top:20px;">To Date</label></b><input autocomplete="off" type="text" name="req_to_date" class="input-Search datepicker1" style="margin-top:20px;height: 25px;font-size:14px;width:100px;" placeholder="To Date" required/>
			<br>
			<b><label style="width:70px;float:left;margin-top:20px;">Booked By </label></b><select name="Pcc" class="input-Search" style="margin-top:20px;width: 170px;height: 35px;font-size:14px;">
				<option style="font-size:14px;" value="">All</option>
				<?php foreach($labs as $key => $val) {?>
				<option style="font-size:14px;" value="<?php echo $key;?>"><?php echo $val;?></option>
				<?php }?>
			</select>

			<table width="600">
				<tr>
					<td><input class="btn" type="submit" name="submit" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>