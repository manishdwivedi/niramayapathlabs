<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
function show_tab(val)
{
	if(val == 'sample')
	{
		document.getElementById('SampleRequest').style.display = 'block';
	}
	
	if(val == 'loggedout')
	{
		window.location.href = siteUrl+'tests/logout';
	}
}

function change_status(id,appoint)
{
	if(id == 3)
	{
		jQuery.ajax({
		type:'GET',
		url:siteUrl+'pages/appoint_cancel?id='+appoint,
		success:function(data){
			var rep_div = '';
			rep_div +='<img src="'+siteUrl+'img/change_index/cancel-btn_user.jpg">';
			$('#status_'+data).html(rep_div);
			jQuery('#process_'+data).show();
		},
		beforeSend:function(){
			jQuery('#process_'+appoint).show();
		},
		});
	}
}
</script>
      </div>
    </div>
  </div>
  
   <div class="article_in_inner" style="padding-bottom: 60px;">
    <div class="article_in">
      <div class="preview">
      <div class="preBox2">Appointment(s) </div>
		  <div class="pacakgeBox list">
			<?php if(count($book_appointment) > 0) {?>
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
			  <tr>
				<th width="80" valign="middle" align="center" class="yellow2"><span>AppointmentID</span></th>
				<th width="150" valign="middle" align="center" class="yellow2"><span>Doctor Name</span></th>
				<th width="300" valign="middle" align="center" class="yellow2"><span>Clinic Name</span></th>
				<th width="100" valign="middle" align="center" class="yellow2"><span>Date</span></th>
				<th valign="middle" align="center" class="yellow2" width="100"><span>Day</span></th>
				<th valign="middle" align="center" class="yellow2"><span>Time</span></th>
				<th valign="middle" align="center" class="yellow2"><span>Status</span></th>
			  </tr>
			  
			  <?php $k = 1;foreach($book_appointment as $key => $val) {?>
			  <tr>
				<td valign="middle"><?php echo $val['BookAppointment']['appointment_id'];?></td>
				<td valign="middle"><?php echo $val['BookAppointment']['doctor_name'];?></td>
				<td valign="middle"><?php echo $val['BookAppointment']['clinic_name'];?></td>
				<td valign="middle"><?php echo date('d-M-Y',strtotime($val['BookAppointment']['appoint_date']));?></td>
				<td valign="middle"><?php echo $val['BookAppointment']['appoint_day'];?></td>
				<td valign="middle"><?php echo $val['BookAppointment']['time_slot'];?></td>
				<td valign="middle" id="status_<?php echo $val['BookAppointment']['id'];?>">
					<?php if($val['BookAppointment']['status'] == 1) {?>
						<select class="select-box-appoint" onchange="change_status(this.value,'<?php echo $val['BookAppointment']['id'];?>');">
							<option value="">Select Action</option>
							<option value="1" selected="selected">Pending</option>
							<option value="3">Cancel</option>
						</select><br /><br />
						<?php echo $html->image('p_rocess.gif',array('width'=>'65','id'=>'process_'.$val['BookAppointment']['id'],'style'=>'display:none;'));?>
					<?php }?>
					<?php if($val['BookAppointment']['status'] == 2) {?>
						<?php echo $html->image('change_index/done-btn_user.jpg');?>
					<?php }?>
					<?php if($val['BookAppointment']['status'] == 3) {?>
						<?php echo $html->image('change_index/cancel-btn_user.jpg');?>
					<?php }?>
				</td>
			  </tr>
			  
			  <?php $k++;}?>
			</table>
			<?php } else {?>
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
			  <tr>
				<th width="80" valign="middle" align="center" class="yellow2"><span>AppointmentID</span></th>
				<th width="150" valign="middle" align="center" class="yellow2"><span>Doctor Name</span></th>
				<th width="300" valign="middle" align="center" class="yellow2"><span>Clinic Name</span></th>
				<th width="100" valign="middle" align="center" class="yellow2"><span>Date</span></th>
				<th valign="middle" align="center" class="yellow2" width="100"><span>Day</span></th>
				<th valign="middle" align="center" class="yellow2"><span>Time</span></th>
				<th valign="middle" align="center" class="yellow2"><span>Status</span></th>
			  </tr>
			  <tr>
				<td colspan="9" style="text-align:center;">Sorry no appointments found.</td>
			  </tr>
			 </table>
			<?php }?>
		</div>
      </div>
	  <?php if(count($book_appointment) > 0) {?>
      <div id="pagination"><?php echo $this->element('pagination_test');?></div>
	  <?php }?>
      <div class="bottomShadow"></div>
    </div>
  </div>