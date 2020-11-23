<style>
	.td { 
		border-bottom-style: solid;
	    border-width: thin;
	    border-color: black;
	}
</style>

<div class="contentcontainer">
	<div class="headings altheading">
		<h1 >Pincode Master Upload</h1>
    </div>
	<div class="contentbox">
		<?php echo $this->Session->flash(); ?>
		<form action="" method="post" enctype="multipart/form-data">
			<table width="600">
				<tr>
					<td><input type="hidden" name="category" id="category" value="<?php echo $id; ?>"></td>
				</tr>
				<tr>
					<td>Select file</td>
					<td><input type="file" name="file" id="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/></td>
				</tr>
				<tr>
					<td>Submit</td>
					<td><input type="submit" name="submit" /></td>
				</tr>
			</table>
		</form>
		</br>
		<hr>
		</br>
		<a href="<?php echo $html->url('/admin/pincode/pincode_master_download/'); ?>" title="Download Pincode Master List" class="active_link" target="_blank">Download Pincode Master List</a>
		</br>
		</br>
		<label style="color:red;font-size:11px;">*Excel Format And Data Description</label>
		<table style="border-radius: 5px;border-style: solid;border-width: thin;">
			<tr>
				<th style="border-right-style: solid;border-width: thin;">Pincode</th>
				<th style="border-right-style: solid;border-width: thin;">City</th>
				<th style="border-right-style: solid;border-width: thin;">State</th>
				<th style="border-right-style: solid;border-width: thin;">Locality</th>
				<th style="border-right-style: solid;border-width: thin;">Servicable</th>
				<th>Category</th>
			</tr>
			<tr>
				<td style="border-right-style: solid;border-width: thin;">110001</td>
				<td style="border-right-style: solid;border-width: thin;">New Delhi</td>
				<td style="border-right-style: solid;border-width: thin;">Delhi</td>
				<td style="border-right-style: solid;border-width: thin;">Central Delhi</td>
				<td style="border-right-style: solid;border-width: thin;">1 (from table <font style="color:red">Servicable</font>)</td>
				<td>2 (from table <font style="color:lightskyblue">Pincode Category</font>)</td>
			</tr>
		</table>
		<br>
		<div style="float:left;width:200px;">
			<h3 style="color:lightskyblue">Pincode Category</h3>
			<table style="border-radius: 5px;border-style: solid;border-width: thin;">
				<tr>
					<th style="border-right-style: solid;border-width: thin;">Category</th>
					<th>id</th>
				</tr>
				<tr>
					<td class="td" style="border-right-style: solid;">Non Servicable</td>
					<td class="td">0</td>
				</tr>
				<tr>
					<td class="td" style="border-right-style: solid;">Regular</td>
					<td class="td">1</td>
				</tr>
				<tr>
					<td class="td" style="border-right-style: solid;">SPL 25</td>
					<td class="td">2</td>
				</tr>
				<tr>
					<td style="border-right-style: solid;border-width: thin;">Logistics - Extra</td>
					<td>3</td>
				</tr>
			</table>
		</div>
		<div style="float:left;">
			<h3 style="color:red">Servicable Category</h3>
			<table style="border-radius: 5px;border-style: solid;border-width: thin;">
				<tr>
					<th style="border-right-style: solid;border-width: thin;">Servicable Status</th>
					<th>id</th>
				</tr>
				<tr>
					<td class="td" style="border-right-style: solid;">Non Servicable</td>
					<td class="td">0</td>
				</tr>
				<tr>
					<td style="border-right-style: solid;border-width: thin;">Servicable</td>
					<td>1</td>
				</tr>
			</table>
		</div>
	</div>
</div>
