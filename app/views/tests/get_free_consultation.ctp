<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	<tr>
		<td colspan="2" style="text-align:left;padding-left:25px;"><img src="<?php echo SITE_URL;?>img/frontend/logo.png" height="80" /></td>
		<td colspan="2" style="text-align:right;padding-right:25px;"><img src="<?php echo SITE_URL;?>img/frontend/app_visit_logo.png" height="80" /></td>
		
	</tr>
	<tr>
		<td colspan="4" style="padding:10px 25px; font-size:15px; font-weight:bold;line-height:23px;">
		You are eligible for a FREE Online Doctor Consultation by an Experienced MBBS doctor, Kindly allow us to share your Report for the Request ID <b><?php echo base64_decode($order_id); ?></b> with the contesting doctor through VISIT App.
		<br/><br/>
		<p style="text-align:center;"><?php echo $this->Html->link('I Agree',array('controller'=>'tests','action'=>'get_free_consultation_agree',$request_id,$order_id),array('escape'=>false,'target'=>'_blank')); ?></p>
		</td>
	</tr>
	
	
	
</table>
