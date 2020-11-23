

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit Doctor Personal Details</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Doctors(s)', '/admin/pages/view_doctor', array('title'=>'View Doctor')); ?> &#187; Edit Doctor Personal Details
	<?php echo $form->create(null,array('url'=>'/admin/pages/edit_personal_detail/'.base64_encode($this->data['Doctor']['id']),'enctype'=>'multipart/form-data'));?>
	<?php echo $form->hidden('Doctor.id',array('value'=>$this->data['Doctor']['id']));?>
	<?php echo $form->hidden('Doctor.old_image',array('value'=>$this->data['Doctor']['image']));?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table border="0" width="100%">
							<tr>
								<td colspan="2" style="padding:10px; font-weight:bold; font-size:15px;">Edit Personal Details of <?php echo $this->data['Doctor']['title'].' '.$this->data['Doctor']['first_name'].' '.$this->data['Doctor']['last_name'];?></td>
							</tr>
							
							<tr>
								<td width="26%" class="boldText">Title</td>
								<td>
									<select name="data[Doctor][title]" class="input-text" style="width:100px;">
										<option value="Dr" <?php if($this->data['Doctor']['title'] == 'Dr') {?> selected="selected" <?php }?>>Dr</option>
										<option value="Mr" <?php if($this->data['Doctor']['title'] == 'Mr') {?> selected="selected" <?php }?>>Mr</option>
										<option value="Mrs" <?php if($this->data['Doctor']['title'] == 'Mrs') {?> selected="selected" <?php }?>>Mrs</option>
										<option value="Ms" <?php if($this->data['Doctor']['title'] == 'Ms') {?> selected="selected" <?php }?>>Ms</option>
									</select>
								</td>
							</tr>
							<tr>
								<td width="26%" class="boldText">First Name</td>
								<td><?php echo $form->text('Doctor.first_name',array('class'=>'input-text'));?></td>
							</tr>
							<tr>
								<td width="26%" class="boldText">Last Name</td>
								<td><?php echo $form->text('Doctor.last_name',array('class'=>'input-text'));?></td>
							</tr>
							<tr>
								<td width="26%" class="boldText">Gender</td>
								<td>
									<select name="data[Doctor][gender]" class="input-text" style="width:150px;">
										<option value="">Select Gender</option>
										<option value="1" <?php if($this->data['Doctor']['gender'] == 1) {?> selected="selected" <?php }?>>Male</option>
										<option value="2" <?php if($this->data['Doctor']['gender'] == 2) {?> selected="selected" <?php }?>>Female</option>
									</select>
								<?php echo $get_doctor_detail['Doctor']['gender'];?></td>
							</tr>
							<tr>
								<td width="26%" class="boldText">Email</td>
								<td><?php echo $form->text('Doctor.email',array('class'=>'input-text'));?></td>
							</tr>
							<tr>
								<td width="26%" class="boldText">Contact</td>
								<td><?php echo $form->text('Doctor.contact',array('class'=>'input-text'));?></td>
							</tr>
							<tr>
								<td width="26%" class="boldText">Upload Image</td>
								<td><?php echo $form->file('Doctor.doc_image',array('class'=>'input-text'));?></td>
							</tr>
							<tr>
								<td width="26%" class="boldText">Consultancy Fee(clinic)</td>
								<td><?php echo $form->text('Doctor.cons_fee',array('class'=>'input-text'));?></td>
							</tr>
							<?php if($this->data['Doctor']['home_fee'] != 0) {?>
							<tr>
								<td width="26%" class="boldText">Consultancy Fee(home Visit)</td>
								<td><?php echo $form->text('Doctor.home_fee',array('class'=>'input-text'));?></td>
							</tr>
							<?php }?>
							<tr>
								<td width="26%" class="boldText">DOB</td>
								<td>
									<select name="data[Doctor][day]" class="input-text" style="width:80px;">
										<option value="01" <?php if($this->data['Doctor']['day'] == '01') {?> selected="selected" <?php }?>>01</option>
										<option value="02" <?php if($this->data['Doctor']['day'] == '02') {?> selected="selected" <?php }?>>02</option>
										<option value="03" <?php if($this->data['Doctor']['day'] == '03') {?> selected="selected" <?php }?>>03</option>
										<option value="04" <?php if($this->data['Doctor']['day'] == '04') {?> selected="selected" <?php }?>>04</option>
										<option value="05" <?php if($this->data['Doctor']['day'] == '05') {?> selected="selected" <?php }?>>05</option>
										<option value="06" <?php if($this->data['Doctor']['day'] == '06') {?> selected="selected" <?php }?>>06</option>
										<option value="07" <?php if($this->data['Doctor']['day'] == '07') {?> selected="selected" <?php }?>>07</option>
										<option value="08" <?php if($this->data['Doctor']['day'] == '08') {?> selected="selected" <?php }?>>08</option>
										<option value="09" <?php if($this->data['Doctor']['day'] == '09') {?> selected="selected" <?php }?>>09</option>
										<option value="10" <?php if($this->data['Doctor']['day'] == '10') {?> selected="selected" <?php }?>>10</option>
										<option value="11" <?php if($this->data['Doctor']['day'] == '11') {?> selected="selected" <?php }?>>11</option>
										<option value="12" <?php if($this->data['Doctor']['day'] == '12') {?> selected="selected" <?php }?>>12</option>
										<option value="13" <?php if($this->data['Doctor']['day'] == '13') {?> selected="selected" <?php }?>>13</option>
										<option value="14" <?php if($this->data['Doctor']['day'] == '14') {?> selected="selected" <?php }?>>14</option>
										<option value="15" <?php if($this->data['Doctor']['day'] == '15') {?> selected="selected" <?php }?>>15</option>
										<option value="16" <?php if($this->data['Doctor']['day'] == '16') {?> selected="selected" <?php }?>>16</option>
										<option value="17" <?php if($this->data['Doctor']['day'] == '17') {?> selected="selected" <?php }?>>17</option>
										<option value="18" <?php if($this->data['Doctor']['day'] == '18') {?> selected="selected" <?php }?>>18</option>
										<option value="19" <?php if($this->data['Doctor']['day'] == '19') {?> selected="selected" <?php }?>>19</option>
										<option value="20" <?php if($this->data['Doctor']['day'] == '20') {?> selected="selected" <?php }?>>20</option>
										<option value="21" <?php if($this->data['Doctor']['day'] == '21') {?> selected="selected" <?php }?>>21</option>
										<option value="22" <?php if($this->data['Doctor']['day'] == '22') {?> selected="selected" <?php }?>>22</option>
										<option value="23" <?php if($this->data['Doctor']['day'] == '23') {?> selected="selected" <?php }?>>23</option>
										<option value="24" <?php if($this->data['Doctor']['day'] == '24') {?> selected="selected" <?php }?>>24</option>
										<option value="25" <?php if($this->data['Doctor']['day'] == '25') {?> selected="selected" <?php }?>>25</option>
										<option value="26" <?php if($this->data['Doctor']['day'] == '26') {?> selected="selected" <?php }?>>26</option>
										<option value="27" <?php if($this->data['Doctor']['day'] == '27') {?> selected="selected" <?php }?>>27</option>
										<option value="28" <?php if($this->data['Doctor']['day'] == '28') {?> selected="selected" <?php }?>>28</option>
										<option value="29" <?php if($this->data['Doctor']['day'] == '29') {?> selected="selected" <?php }?>>29</option>
										<option value="30" <?php if($this->data['Doctor']['day'] == '30') {?> selected="selected" <?php }?>>30</option>
										<option value="31" <?php if($this->data['Doctor']['day'] == '31') {?> selected="selected" <?php }?>>31</option>
									</select>
									<select name="data[Doctor][month]" class="input-text" style="width:100px;">
										<option value="Jan" <?php if($this->data['Doctor']['month'] == 'Jan') {?> selected="selected" <?php }?>>Jan</option>
										<option value="Feb" <?php if($this->data['Doctor']['month'] == 'Feb') {?> selected="selected" <?php }?>>Feb</option>
										<option value="Mar" <?php if($this->data['Doctor']['month'] == 'Mar') {?> selected="selected" <?php }?>>Mar</option>
										<option value="Apr" <?php if($this->data['Doctor']['month'] == 'Apr') {?> selected="selected" <?php }?>>Apr</option>
										<option value="May" <?php if($this->data['Doctor']['month'] == 'May') {?> selected="selected" <?php }?>>May</option>
										<option value="Jun" <?php if($this->data['Doctor']['month'] == 'Jun') {?> selected="selected" <?php }?>>Jun</option>
										<option value="Jul" <?php if($this->data['Doctor']['month'] == 'Jul') {?> selected="selected" <?php }?>>Jul</option>
										<option value="Aug" <?php if($this->data['Doctor']['month'] == 'Aug') {?> selected="selected" <?php }?>>Aug</option>
										<option value="Sep" <?php if($this->data['Doctor']['month'] == 'Sep') {?> selected="selected" <?php }?>>Sep</option>
										<option value="Oct" <?php if($this->data['Doctor']['month'] == 'Oct') {?> selected="selected" <?php }?>>Oct</option>
										<option value="Nov" <?php if($this->data['Doctor']['month'] == 'Nov') {?> selected="selected" <?php }?>>Nov</option>
										<option value="Dec" <?php if($this->data['Doctor']['month'] == 'Dec') {?> selected="selected" <?php }?>>Dec</option>
									</select>
									<select name="data[Doctor][year]" class="input-text" style="width:100px;">
										<?php for($i=1950;$i<=2050;$i++){?>
										<option value="<?php echo $i;?>" <?php if($this->data['Doctor']['year'] == $i) {?> selected="selected" <?php }?>><?php echo $i;?></option>
										<?php }?>
									</select>
								</td>
							</tr>
							<tr>
								<td width="26%" class="boldText">Address</td>
								<td><?php echo $form->text('Doctor.address1',array('class'=>'input-text'));?></td>
							</tr>
							<?php if(!empty($this->data['Doctor']['address2'])){?>
							<tr>
								<td width="26%" class="boldText">&nbsp;</td>
								<td><?php echo $form->text('Doctor.address2',array('class'=>'input-text'));?></td>
							</tr>
							<?php }?>
							<tr>
								<td width="26%" class="boldText">Locality</td>
								<td><?php echo $form->text('Doctor.locality',array('class'=>'input-text'));?></td>
							</tr>
							<tr>
								<td width="26%" class="boldText">State</td>
								<td>
									<select name="data[Doctor][state]" class="input-text">
										<option value="">Select State</option>
										<?php foreach($states as $k => $v) {?>
										<option value="<?php echo $v['State']['id'];?>" <?php if($v['State']['id'] == $this->data['Doctor']['state']) {?> selected="selected" <?php }?>><?php echo $v['State']['name'];?></option>
										<?php }?>
									</select>
								</td>
							</tr>
							<tr>
								<td width="26%" class="boldText">City</td>
								<td><?php echo $form->text('Doctor.city',array('class'=>'input-text'));?></td>
							</tr>
							<tr>
								<td width="26%" class="boldText">Zipcode</td>
								<td><?php echo $form->text('Doctor.zipcode',array('class'=>'input-text'));?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><?php echo $form->submit('Update Detail',array('class'=>'btn'));?></td>
							</tr>
						</table>
					</td>
					<td style="text-align:center; vertical-align:top;">
						<?php if(!empty($this->data['Doctor']['image'])) {?>
							<?php echo $html->image(DOCTOR_IMAGE_SMALL_URL.$this->data['Doctor']['image'],array('style'=>'border:1px solid #999999;'));?>
						<?php } else {?>
							<?php if($this->data['Doctor']['gender'] == 1) {?>
								<?php echo $html->image('frontend/default_male.jpg',array('width'=>120,'style'=>'border:1px solid #999999;'));?>
							<?php }?>
							<?php if($this->data['Doctor']['gender'] == 2) {?>
								<?php echo $html->image('frontend/default_female.jpg',array('width'=>120,'style'=>'border:1px solid #999999;'));?>
							<?php }?>
						<?php }?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	
	<?php echo $form->end();?>
</table>

</div>
<script type="text/javascript">
function verify_doctor(val)
{
	window.location.href=siteUrl+"admin/pages/verify_doctor/"+val;
}
function feature_verify(val)
{
	window.location.href=siteUrl+"admin/pages/feature_verify/"+val;
}
</script>

<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>