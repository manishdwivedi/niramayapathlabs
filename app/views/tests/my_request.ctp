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
          <div class="bread"><?php echo $this->Html->link('My Requests','/tests/my_request');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
      <h1>My <span class="green">Account</span></h1>
    <div class="subHeading">
    <h2>My Requests</h2>
    <ul>
    <li><?php echo $html->link('Personal Details',array('controller'=>'tests','action'=>'personal_detail'));?></li>
    <li><?php echo $html->link('My Requests','javascript:void(0);',array('class'=>'act'));?></li>
    <li><?php echo $html->link('My Reports',array('controller'=>'tests','action'=>'my_report'));?></li>
	<li><?php echo $html->link('Payment History',array('controller'=>'tests','action'=>'payment_history'));?></li>
    <li class="borderNone padRightNone"><?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab("loggedout");'));?></li>
    </ul>
    
    
    
    </div>
      <div class="tableDiv">
	  	<?php if(count($get_requests) > 0) {?>
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <th width="70" class="thDiv"><span>S. No.</span></th>
            <th width="100" class="thDiv"><span>Patient Name</span></th>
            <th width="300" class="thDiv"><span>Test/Profile</span></th>
            <!--<th width="143" class="thDiv"><span>Email ID</span></th>
            <th width="143" class="thDiv"><span>Address</span></th>
            <th width="80" class="thDiv"><span>Type</span></th>-->
            <th width="100" class="thDiv"><span>Book Date</span></th>
            <th class="thDiv" style="width:100px;"><span>Report Status</span></th>
          </tr>
		  
		  <?php $k = 1;foreach($get_requests as $key => $val) {?>
          <tr>
            <td valign="top"><?php echo $k;?>)</td>
            <td valign="top"><p><?php echo $val['Health']['name'];?></p></td>
            <td valign="top">
            <h6><?php echo $val['Health']['test_type'];?></h6>            
            <?php echo $val['Health']['test_name'];?>
            <h6><?php echo $val['Health']['profile_type'];?></h6>            
            <?php echo $val['Health']['profile_name'];?>
            <h6><?php echo $val['Health']['offer_type'];?></h6>            
            <?php echo $val['Health']['offer_name'];?>
			<h6><?php echo $val['Health']['package_type'];?></h6>            
            <?php echo $val['Health']['package_name'];?>
            </td>
            <!--<td valign="top"><p><?php //echo $val['Health']['email'];?></p></td>
            <td valign="top"><p><?php //echo $val['Health']['address1'];?></p></td>-->
            <!--<td valign="top"><p>Safe</p></td>-->
            <td valign="top"><p><?php echo $val['Health']['book_date'];?></p></td>
			<!--  id="reportStatus<?php //echo $val['Health']['id'];?>"-->
            <td valign="top" id="reportStatus<?php echo $val['Health']['id'];?>">
				<?php if($val['Health']['patient_report'] == '' && $val['Health']['published'] == 0) {?>
				In Process
				<!--<p><a href="javascript:void(0);" onclick="show_report_status('<?php //echo $val['Health']['id'];?>','show');"><img src="<?php //echo SITE_URL;?>img/frontend/view-status.jpg"  alt="View Status" /></a></p>-->
				<?php } if($val['Health']['patient_report'] != '' && $val['Health']['published'] == 0) {?>
				In Process
				<!--<p><a href="javascript:void(0);" onclick="show_report_status('<?php //echo $val['Health']['id'];?>','show');"><img src="<?php //echo SITE_URL;?>img/frontend/view-status.jpg"  alt="View Status" /></a></p>-->
				<?php }?>
			</td>
			<td valign="top" id="reportStatusHide<?php echo $val['Health']['id'];?>" style="display:none;">
				<?php if($val['Health']['patient_report'] == '' && $val['Health']['published'] == 0) {?>
				<p><a href="javascript:void(0);" onclick="show_report_status('<?php echo $val['Health']['id'];?>','hide');"><img src="<?php echo SITE_URL;?>img/frontend/hide-status.jpg"  alt="Hide Status" /></a></p>
				<?php } if($val['Health']['patient_report'] != '' && $val['Health']['published'] == 0) {?>
				<p><a href="javascript:void(0);" onclick="show_report_status('<?php echo $val['Health']['id'];?>','hide');"><img src="<?php echo SITE_URL;?>img/frontend/hide-status.jpg"  alt="Hide Status" /></a></p>
				<?php }?>
			</td>
          </tr>
		  <tr id="ReportStatus<?php echo $val['Health']['id'];?>" style="display:none;">
            <td colspan="8">
            <?php if(($val['Health']['reschduled'] == 1) && ($val['Health']['old_date'] != '0000-00-00') && ($val['Health']['old_time'] != 0)) {?>
			<div class="row">
            	<span>Request Reschduled</span>
            	<div class="dot">:</div>
				<?php if(($val['Health']['sample_date1'] != '' || $val['Health']['sample_date1'] != 'Please select a suitable date') && ($val['Health']['sample_time1'] != '')) {?>
            		<div class="text">Date : <?php echo $val['Health']['sample_date1'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time : <?php echo $val['Health']['sample_time1'];?></div>
				<?php }?>
				<?php if(($val['Health']['sample_date'] != '' || $val['Health']['sample_date'] != 'Please select a suitable date') && ($val['Health']['sample_time'] != '')) {?>
					<div class="text">Date : <?php echo $val['Health']['sample_date'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time : <?php echo $val['Health']['sample_time'];?></div>
				<?php }?>
            </div>
			<?php }?>
			<?php if($val['Health']['cancelled_status'] == 1) {?>
			<div class="row">
				<span>Request Cancelled Reason</span>
            	<div class="dot">:</div>
				<div class="text"><?php echo $val['Health']['cancelled_reason'];?></div>
			</div>
			<?php }?>
			<?php if($val['Health']['published'] == 0 && $val['Health']['published_reason'] != '') {?>
			<div class="row">
				<span>Report Not Published Reason</span>
            	<div class="dot">:</div>
				<div class="text"><?php echo $val['Health']['published_reason'];?></div>
			</div>
			<?php }?>
			<?php if($val['Health']['reschduled'] == 0 && $val['Health']['cancelled_status'] == 0) {?>
			<div class="row" style="text-align:center; width:100%;">
				Sorry no status found
			</div>
			<?php }?>
            </td>
          </tr>
		  <?php $k++;}?>
		</table>
		<?php } else {?>
		<table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <th width="70" class="thDiv"><span>S. No.</span></th>
            <th width="120" class="thDiv"><span>Name</span></th>
            <th width="300" class="thDiv"><span>Test/Profile</span></th>
            <!--<th width="143" class="thDiv"><span>Email ID</span></th>
            <th width="143" class="thDiv"><span>Address</span></th>
            <th width="80" class="thDiv"><span>Type</span></th>-->
            <th width="100" class="thDiv"><span>Book Date</span></th>
            <th class="thDiv" style="width:100px;"><span>Report</span></th>
          </tr>
		  <tr>
		  	<td colspan="8" style="text-align:center;">Sorry no records found.</td>
		  </tr>
		 </table>
		<?php }?>
      </div>
	  <?php if(count($get_requests) > 0) {?>
      <div id="pagination"><?php echo $this->element('pagination_test');?></div>
	  <?php }?>
      <div class="bottomShadow"></div>
    </div>
  </div>