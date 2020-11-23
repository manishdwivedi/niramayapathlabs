<div class="contentcontainer">
	<div class="headings altheading">
		<h1 >Package Estimation Excel</h1>
    </div>
	<div class="contentbox">
		<form action="" method="post" enctype="multipart/form-data">
			<table width="600">
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
