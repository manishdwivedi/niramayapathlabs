<?php /*payment History */ ?>
<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
<script>
function print_user_receipt(val1,val2)
   {
	window.open('<?php echo SITE_URL;?>tests/print_user_receipt_new/'+val1+'/'+val2,'name','height=500,width=600,scrollbars=yes');
   }
</script>
<div class="article_in_inner">
    <div class="article_in">
       <div class="preview">
      <div class="preBox2">Report(s) </div>

      <div class="pacakgeBox list"><table width="100%" cellspacing="0" cellpadding="0" border="0"><thead> 
      	<tr><td valign="middle" align="center" class="yellow2">Collection Date and Time</td>
		<td valign="middle" align="center" class="yellow2">Request No.</td>
		<td valign="middle" align="center" class="yellow2">Patient Name</td>
		<td valign="middle" align="center" class="yellow2">Test/Package Details</td>
		<td valign="middle" align="center" class="yellow2">Total Amount</td>
		<td valign="middle" align="center" class="yellow2">Balance Due</td>
		<td valign="middle" align="center" class="yellow2">Report</td></tr>

     <?php foreach($paymenthistory as $key => $val) {?>
      <tr>
      <td valign="top" align="center" class="gray2">
	  <?php if(!empty($val['Health']['sample_date'])) { 
			echo date('d-m-Y',strtotime($val['Health']['sample_date']))." ".$timelab[$val['Health']['sample_time']]; 
		} 
		else {
			echo date('d-m-Y',strtotime($val['Health']['sample_date1']))." ".$timelab[$val['Health']['sample_time1']]; 
		}?>
	  </td>
	  <td valign="top" align="center" class="gray2"><?php echo $val['Health']['request_num'];?></td>
	  <td valign="top" align="center" class="gray2"><?php echo $val['Health']['pat_name'];?></td>
      <td valign="top" align="left" class="gray2">
      	
          <?php if(!empty($val['Health']['test_name'])) {?>
					<h6><?php echo $val['Health']['test_type'];?></h6>            
					<?php echo $val['Health']['test_name'];?>
				<?php }?>
				<?php if(!empty($val['Health']['profile_name'])) {?>
					<h6><?php echo $val['Health']['profile_type'];?></h6>            
					<?php echo $val['Health']['profile_name'];?>
				<?php }?>
				<?php if(!empty($val['Health']['offer_name'])) {?>
					<h6><?php echo $val['Health']['offer_type'];?></h6>            
					<?php echo $val['Health']['offer_name'];?>
				<?php }?>
				<?php if(!empty($val['Health']['package_name'])) {?>
					<h6><?php echo $val['Health']['package_type'];?></h6>            
					<?php echo $val['Health']['package_name'];?>
				<?php }?>
				<?php if(!empty($val['Health']['service_name'])) {?>
					<h6><?php echo $val['Health']['service_type'];?></h6>            
					<?php echo $val['Health']['service_name'];?>
				<?php }?>
				
				<?php if(!empty($val['Health']['requ_status'])) {?>
				<br /><br />
				<p><span style="font-weight:bold;">Request Status :</span> <?php echo $orderStatus[$val['Health']['requ_status']];?></p>
				<?php }?>
				<?php if(!empty($val['Health']['report_status_final'])) {?>
				<br /><br />
				<p><span style="font-weight:bold;">Report Published :</span> <?php echo $val['Health']['report_status_final'];?></p>
				<?php }?>
				<?php if(!empty($val['Health']['cancel_reason'])) {?>
				<br /><br />
				<p><span style="font-weight:bold;">Cancelled Reason :</span> <?php echo $val['Health']['cancel_reason'];?></p>
				<?php }?>
				<?php if(!empty($val['Health']['lab_message'])) {?>
				<br /><br />
				<p><span style="font-weight:bold;">Lab Message :</span> <?php echo $val['Health']['lab_message'];?></p>
				<?php }?>
				<?php if(!empty($val['Health']['adj_reason'])) {?>
				<br /><br />
				<p><span style="font-weight:bold;">Adjustment Reason :</span> <?php echo $val['Health']['adj_reason'];?></p>
				<?php }?>



      </td>
	  <td valign="middle" align="center" class="gray2"><div class="price" style="text-align:center; float:none;"><?php echo $val['Health']['total_amount'];?></div></td>
	  <td valign="middle" align="center" class="gray2">
		<div class="price" style="text-align:center; float:none;"><?php echo $val['Health']['advance_due'];?></div>
		<?php if($val['Health']['advance_due'] > 0) { ?>
			<br/><div class="price" style="float:none;"><?php e($html->link('Pay Now',array('controller'=>'payment_paytm','action'=>'process_payment',base64_encode($val['Health']['advance_due']),base64_encode($val['Health']['id']),base64_encode($val['Billing']['order_id'])),array('escape'=>false))); ?></div>

		<?php } ?>
	  </td>
      <td valign="top" align="center" class="gray2"> 
      	        <?php if($val['Health']['order_status'] == 'confirm' && $val['Health']['report_status'] == 'not_upload') {?>
					<a href="javascript:void(0);" onclick="print_user_receipt('<?php echo base64_encode($val['Health']['id']);?>','<?php echo base64_encode($val['Health']['request_num']);?>');">Print Receipt</a>
				<?php }?>
				
				
				<?php if($val['Health']['order_status'] == 'confirm' && $val['Health']['report_status'] == 'upload') {?>
					<?php if(!empty($val['Health']['patient_report_with_header'])){?>
						<a href="<?php echo $val['Health']['patient_report_with_header'];?>" target="_blank">View Report</a><br/>	
					<?php } else {?>
						<a href="<?php echo SITE_URL;?>tests/view_report/<?php echo base64_encode(str_replace("?","@@@@",$val['Health']['patient_report']));?>" target="_blank" >View Report</a>
						</br>
					<?php } ?>

					<?php if(!empty($val['Health']['smart_report'])){ ?>
						<a href="<?php echo $val['Health']['smart_report'];?>" target="_blank">View Smart Report</a><br/>	
					<?php } ?>
					
					<!--<a href="<?php echo SITE_URL;?>tests/download_report/<?php echo base64_encode(str_replace("?","@@@@",$val['Health']['patient_report']));?>">Print Report</a><br />
					<a href="<?php echo SITE_URL;?>tests/view_report/<?php echo base64_encode(str_replace("?","@@@@",$val['Health']['patient_report']));?>" target="_blank">View Report</a><br />-->
					<a href="javascript:void(0);" onclick="print_user_receipt('<?php echo base64_encode($val['Health']['id']);?>','<?php echo base64_encode($val['Health']['request_num']);?>');">Print Receipt</a><br/><br/>
					<a href="javascript:void(0);" onclick="get_free_consultation('<?php echo base64_encode($val['Health']['id']);?>','<?php echo base64_encode($val['Health']['request_num']);?>');"><b>Get FREE <br/>Dr. Consultation</b></a>
				<?php }?>
				<?php if($val['Health']['order_status'] == 'not_confirm') {?>
					<a href="<?php echo SITE_URL;?>tests/checkout/<?php echo $val['Health']['id'];?>">Confirm Test</a>
				<?php }?>
	  </td>

       </tr>
      <?php }?>
      </thead></table></div>
              
           
        
    </div>
    </div>
    <div class="clr"></div>  
  </div>
  <div class="clr"></div>
  <br><br>