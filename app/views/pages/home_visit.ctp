<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/jquery/ui-lightness/admin/jquery-ui.css" />
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery/jquery.ui.js"></script>
<script type="text/javascript">
function show_tab(val)
{
	window.location.href = siteUrl+'pages/doctor_logout';
}

function change_status(id,appoint)
{
	if(id == 2)
	{
		jQuery.ajax({
		type:'GET',
		url:siteUrl+'pages/appoint_done?id='+appoint,
		success:function(data){
			var rep_div = '';
			rep_div +='<img src="'+siteUrl+'img/change_index/done-btn.jpg">';
			$('#status_'+data).html(rep_div);
			jQuery('#process_'+data).show();
		},
		beforeSend:function(){
			jQuery('#process_'+appoint).show();
		},
		});
	}
	if(id == 3)
	{
		jQuery.ajax({
		type:'GET',
		url:siteUrl+'pages/appoint_cancel?id='+appoint,
		success:function(data){
			var rep_div = '';
			rep_div +='<img src="'+siteUrl+'img/change_index/cancel-btn.jpg">';
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
<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		dateFormat: 'dd-mm-yy'
	});
});
</script>
<style type="text/css">
#bodyPart .bodyInnerDiv .formDiv .row label {
    float: left;
    font-weight: bold;
    margin: 9px 0 0;
    width: 175px;
}
#bodyPart .bodyInnerDiv .formDiv {
    float: left;
    width: 1000px;
}
</style>
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
	<div class="banner"><?php echo $this->Html->image('frontend/niramaya_dr_module_banner.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  	<!--Body Part:Start-->
  <div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread">Home Visit Requests</div>
        </div>
        
      </div>
      <h1>My <span class="green">Account</span></h1>
      
      <div class="appoint"><h3>Home Visit Requests</h3>
      <dl>
      <dt><?php echo $html->link('Personal Details',array('controller'=>'pages','action'=>'doctor_account'));?></dt>
<dt><?php echo $html->link('Proffessional Details',array('controller'=>'pages','action'=>'proffessional_detail'));?></dt>
<dt><?php echo $html->link('Clinics',array('controller'=>'pages','action'=>'clinic'));?></dt>
<dt><?php echo $html->link('Appointments',array('controller'=>'pages','action'=>'appointment'));?></dt>
<dt><?php echo $html->link('Home Visit Request','javascript:void(0);',array('class'=>'act'));?></dt>
<dt class="lastAct"><?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab();'));?></dt>

      
      </dl>
      
      </div>
	  <?php echo $form->create(null,array('url'=>'/pages/home_visit'));?>
      <div class="searchOpt">
    	<div class="box marLeftNone">
	   <div class="dateDiv">
	   <?php if(!empty($appoint_id)) {?>
	   <input name="data[FilterAppointment][appointment_id]" value="<?php echo $appoint_id;?>" type="text" />
	   <?php } else {?>
       	<input name="data[FilterAppointment][appointment_id]" type="text" placeholder="Appointment ID" />
		<?php }?>
	   </div>
	 </div>
     <div class="box">
	   <div class="dateDiv">
	   <?php if(!empty($date_from)) {?>
	   <input name="data[FilterAppointment][date_from]" value="<?php echo $date_from;?>" type="text" class="datepicker" />
	   <?php } else {?>
       	<input name="data[FilterAppointment][date_from]" type="text" placeholder="Enter From Date" class="datepicker" />
		<?php }?>
       	<?php //echo $html->image('change_index/calanderIcon.jpg',array('class'=>'clrIcon'));?>
	   </div>
	 </div>
	 <div class="box">
	   <div class="dateDiv">
	   <?php if(!empty($date_to)) {?>
	   <input name="data[FilterAppointment][date_to]" value="<?php echo $date_to;?>" type="text" class="datepicker" />
	   <?php } else {?>
       	<input name="data[FilterAppointment][date_to]" type="text" placeholder="Enter To Date" class="datepicker" />
		<?php }?>
        <?php //echo $html->image('change_index/calanderIcon.jpg',array('class'=>'clrIcon'));?>
	   </div>
	  </div>
     <div class="box">
		<?php if(!empty($status)) {?>
		<select name="data[FilterAppointment][status]">
			<option value="">Select Status</option>
			<option value="1" <?php if($status == 1) {?> selected="selected" <?php }?>>Pending</option>
			<option value="2" <?php if($status == 2) {?> selected="selected" <?php }?>>Done</option>
			<option value="3" <?php if($status == 3) {?> selected="selected" <?php }?>>Cancel</option>
		</select>
		<?php } else {?>
		<select name="data[FilterAppointment][status]">
			<option value="">Select Status</option>
			<option value="1">Pending</option>
			<option value="2">Done</option>
			<option value="3">Cancel</option>
		</select>
		<?php }?>
	  </div> 
	  <div class="box">
	  	<input type="image" src="<?php echo SITE_URL;?>img/submit-button.gif" alt="Next" class="btn" style="margin: -3px 0 0 15px;" />
	  </div>
     </div>
      <?php echo $form->end();?>
      <div class="tableDiv">
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <th width="100" class="thDiv">AppointmentID</th>
			<th width="200" class="thDiv">Patient Name</th>
            <th width="150" class="thDiv">Contact</th>
			<th width="150" class="thDiv">Home Visit Date</th>
            <th width="300" class="thDiv">Address</th>
            <th class="thDiv">Action</th>
          </tr>
		  <?php if(count($appointments) > 0) {foreach($appointments as $k => $v) {?>
          <tr>
		  	<td><?php echo $v['BookAppointment']['appointment_id'];?></td>
            <td><?php echo $v['BookAppointment']['user_name'];?></td>
            <td>+ 91-<?php echo $v['BookAppointment']['user_contact'];?></td>
            <td><?php echo date('d-M-Y',strtotime($v['BookAppointment']['appoint_date']));?></td>
            <td><?php echo $v['BookAppointment']['user_add1'];?><?php if(!empty($v['BookAppointment']['user_add2'])) {?><br /><?php echo $v['BookAppointment']['user_add2'];?><?php }?></td>
            <td id="status_<?php echo $v['BookAppointment']['id'];?>">
				 <?php if($v['BookAppointment']['status'] == 1){?>
				<select class="select-box-appoint" onchange="change_status(this.value,'<?php echo $v['BookAppointment']['id'];?>');">
					<option value="">Select Action</option>
					<option value="1" selected="selected">Pending</option>
					<option value="2">Done</option>
					<option value="3">Cancel</option>
				</select><br /><br />
				<?php echo $html->image('p_rocess.gif',array('width'=>'65','id'=>'process_'.$v['BookAppointment']['id'],'style'=>'display:none;'));?>
				<?php }?>
				<?php if($v['BookAppointment']['status'] == 2){?>
				<?php echo $html->image('change_index/done-btn.jpg');?>
				<?php }?>
				<?php if($v['BookAppointment']['status'] == 3){?>
				<?php echo $html->image('change_index/cancel-btn.jpg');?>
				<?php }?>
			</td>
			
          </tr>
          <?php }} else {?>
		  <tr>
		  	<td colspan="4" style="text-align:center; color:#FF0000; font-weight:bold;">No Records Found</td>
		  </tr>
		  <?php }?>
    
        </table>
      </div>
      <?php echo $this->element('pagination_test');?>
      <div class="bottomShadow"></div>
    </div>
  </div>
  <!--Body Part:End--> 