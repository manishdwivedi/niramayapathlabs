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

function show_report_status(val,val2)
{
	if(val2 == 'show')
	{
		$('#ReportStatus'+val).show();
		$('#reportStatus'+val).hide();
		$('#reportStatusHide'+val).show();
		//document.getElementById('ReportStatus'+val).style.display = 'block';
//		document.getElementById('reportStatus'+val).style.display = 'none';
//		document.getElementById('reportStatusHide'+val).style.display = 'block';
	}
	if(val2 == 'hide')
	{
		$('#ReportStatus'+val).hide();
		$('#reportStatus'+val).show();
		$('#reportStatusHide'+val).hide();
		//document.getElementById('ReportStatus'+val).style.display = 'none';
//		document.getElementById('reportStatus'+val).style.display = 'block';
//		document.getElementById('reportStatusHide'+val).style.display = 'none';
	}
}

function print_user_receipt(val1,val2)
{
	window.open('<?php echo SITE_URL;?>tests/print_user_receipt/'+val1+'/'+val2,'name','height=500,width=600,scrollbars=yes');
}
</script>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  
  <div id="bodyPart">
    <div class="bodyInnerDiv">
   <div class="breadcrumbs">
        <div class="left">
          <div class="home">Home Page</div>
          <div class="bread"><?php echo $this->Html->link('My Requests','/tests/payment_history');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
      <h1>Payment <span class="green">History</span></h1>
    <div class="subHeading">
    <h2>Payment History</h2>
    <ul>
	<li class="borderNone padRightNone"><?php echo $html->link('My Requests','javascript:void(0);',array('class'=>'act'));?></li>
    </ul>
    
    
    
    </div>
	<div style="width:100%; text-align:center; font-weight:bold; color:#FF0000; margin: 0 0 -22px; padding: 138px 0 0;"><?php echo $this->Session->flash(); ?></div>
      <div class="tableDiv">
	  	<?php if(count($paymenthistory) > 0) {?>
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <th width="70" class="thDiv"><span>S. No.</span></th>
			<th width="80" class="thDiv"><span>Request No.</span></th>
            <th width="120" class="thDiv"><span>Patient Name</span></th>
            <th width="300" class="thDiv"><span>Test/Profile</span></th>
            <th width="100" class="thDiv"><span>Book Date</span></th>
            <th class="thDiv" width="100"><span>Total Amount</span></th>
			<th class="thDiv"><span>Payment Received</span></th>
			<th class="thDiv"><span>Balance Due</span></th>
			<th class="thDiv"><span>Actions</span></th>
          </tr>
		  
		  <?php $k = 1;foreach($paymenthistory as $key => $val) {?>
          <tr>
            <td valign="middle"><?php echo $k;?>)</td>
			<td valign="middle"><?php echo $val['Health']['request_num'];?></td>
            <td valign="middle"><p><?php echo $val['Health']['pat_name'];?></p></td>
            <td valign="top">
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
				
				<?php if(!empty($val['Health']['lab_status'])) {?>
				<br /><br />
				<p><span style="font-weight:bold;">Request Status :</span> <?php echo $val['Health']['lab_status'];?></p>
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
				
			</td>
            <td valign="middle"><div class="price" style="text-align:center; float:none;"><?php echo date('d-m-Y',strtotime($val['Health']['book_date']));?></div></td>
            <?php if($val['Health']['order_status'] == 'not_confirm') {?>
			<td valign="middle"><div class="price" style="text-align:center; float:none;">Pending</div></td>
			<td valign="middle"><div class="price" style="text-align:center; float:none;">Pending</div></td>
			<td valign="middle"><div class="price" style="text-align:center; float:none;">Pending</div></td>
			<?php }?>
			<?php if($val['Health']['order_status'] == 'confirm') {?>
			<td valign="middle"><div class="price" style="text-align:center; float:none;"><?php echo $val['Health']['total_amount'];?></div></td>
			<td valign="middle"><div class="price" style="text-align:center; float:none;"><?php echo $val['Health']['advance_rec'];?></div></td>
			<td valign="middle"><div class="price" style="text-align:center; float:none;"><?php echo $val['Health']['advance_due'];?></div></td>
			<?php }?>
			<td valign="middle" style="padding:5px;">
				<?php if($val['Health']['order_status'] == 'confirm' && $val['Health']['report_status'] == 'not_upload') {?>
					<a href="javascript:void(0);" onclick="print_user_receipt('<?php echo base64_encode($val['Health']['id']);?>','<?php echo base64_encode($val['Health']['request_num']);?>');"><?php //echo $html->image('frontend/print.jpg',array('width'=>80));?>Print Receipt</a>
				<?php }?>
				<?php if($val['Health']['order_status'] == 'confirm' && $val['Health']['report_status'] == 'upload') {?>
					<?php if($val['Health']['patient_report'] != '') {?>
					<a href="<?php echo SITE_URL;?>tests/download_report/<?php echo base64_encode($val['Health']['patient_report']);?>"><?php //echo $html->image('frontend/download_report.jpg',array('width'=>80));?>Download Report</a><br /><br />
					<!--<a href="<?php echo PATIENT_REPORT_URL.$val['Health']['patient_report'];?>" target="_blank">View Report</a>-->
                                        <a href="<?php echo SITE_URL;?>tests/view_report/<?php echo base64_encode($val['Health']['patient_report']);?>" target="_blank">View Report</a>
                                        <br /><br />
					<?php }?>
					<a href="javascript:void(0);" onclick="print_user_receipt('<?php echo base64_encode($val['Health']['id']);?>','<?php echo base64_encode($val['Health']['request_num']);?>');"><?php //echo $html->image('frontend/print.jpg',array('width'=>80));?>Print Receipt</a>
				<?php }?>
				<?php if($val['Health']['order_status'] == 'not_confirm') {?>
					<a href="<?php echo SITE_URL;?>tests/checkout/<?php echo $val['Health']['id'];?>"><?php //echo $html->image('frontend/book_now.png',array('width'=>80));?>Confirm Test</a>
				<?php }?>
				
				
				
			</td>
          </tr>
		  
		  <?php $k++;}?>
		</table>
		<?php } else {?>
		<table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <th width="70" class="thDiv"><span>S. No.</span></th>
            <th width="140" class="thDiv"><span>Patient Name</span></th>
            <th width="350" class="thDiv"><span>Test/Profile</span></th>
            <th width="100" class="thDiv"><span>Book Date</span></th>
            <th class="thDiv"><span>Total Amount</span></th>
			<th class="thDiv"><span>Advance Received</span></th>
			<th class="thDiv"><span>Balance Due</span></th>
          </tr>
		  <tr>
		  	<td colspan="7" style="text-align:center;">Sorry no payment history found.</td>
		  </tr>
		 </table>
		<?php }?>
      </div>
	  <?php if(count($paymenthistory) > 0) {?>
      <div id="pagination"><?php echo $this->element('pagination_test');?></div>
	  <?php }?>
      <div class="bottomShadow"></div>
    </div>
  </div>