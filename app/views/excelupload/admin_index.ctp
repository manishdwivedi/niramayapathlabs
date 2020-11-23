<div class="contentcontainer">
	<div class="headings altheading">
		<h1 >Excel Upload</h1>
    </div>
	<div class="contentbox">
		<form action="" method="post" enctype="multipart/form-data">
			<input type="radio" class="excelType" onclick="changeType(this)" id="withsample" name="withsample" value= "withsample"/> With Sample
			<input type="radio" class="excelType" onclick="changeType(this)" id="withoutsample" name="withoutsample" value= "withoutsample" checked /> Without Sample
			<br>
			<input type="button" value="Download Demo Excel with Sample" name="demo_excel" id="demo_excel_withsample" onclick="excelDownload('withsample')" style="height: 35px;font-size: small;border-radius: 5px;display:none;margin-top:15px;"/>
			<input type="button" value="Download Demo Excel w/o Sample" name="demo_excel" id="demo_excel_withoutsample" onclick="excelDownload('withoutsample')" style="height: 35px;font-size: small;border-radius: 5px;margin-top:15px;"/>
			<br>
			<b>Booked By </b><select name="Pcc" class="input-Search" style="margin-top:20px;width: 170px;height: 35px;font-size:14px;">
				<option style="font-size:14px;" value="">Select PCC</option>
				<?php foreach($labList as $key => $val) {?>
				<option style="font-size:14px;" value="<?php echo $val['Lab']['id'];?>"><?php echo $val['Lab']['pcc_name'];?></option>
				<?php }?>
			</select>

			<br><b>Serviced By</b> <select name="serviced_pcc" class="input-Search" style="margin-top:20px;width: 170px;height: 35px;font-size:14px;">
				<option style="font-size:14px;" value="">Select PCC</option>
				<?php foreach($labList as $key => $val) {?>
				<option style="font-size:14px;" value="<?php echo $val['Lab']['id'];?>"><?php echo $val['Lab']['pcc_name'];?></option>
				<?php }?>
			</select>

			<table width="600">
				<tr>
					<td>Select file</td>
					<td><input type="file" name="file" id="file" /></td>
				</tr>
				<tr>
					<td>Submit</td>
					<td><input type="submit" name="submit" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script>
function excelDownload(doc){
	//$.ajax({url: "/admin/excelupload/sample_excel", success: function(result){
        window.open("/admin/excelupload/sample_excel?excel="+doc,'_blank' );
    //}});
}

function changeType(e)
{
	if(e.id=='withsample')
	{
		$('#withoutsample').attr('checked', false);
		$('#withsample').attr('checked', true);
		$('#demo_excel_withsample').show();
		$('#demo_excel_withoutsample').hide();
	}
	else
	{
		$('#withoutsample').attr('checked', true);
		$('#withsample').attr('checked', false);
		$('#demo_excel_withsample').hide();
		$('#demo_excel_withoutsample').show();
	}

}
</script>
