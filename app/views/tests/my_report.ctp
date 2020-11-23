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
		document.getElementById('ReportStatus'+val).style.display = 'block';
		document.getElementById('reportStatus'+val).style.display = 'none';
		document.getElementById('reportStatusHide'+val).style.display = 'block';
	}
	if(val2 == 'hide')
	{
		document.getElementById('ReportStatus'+val).style.display = 'none';
		document.getElementById('reportStatus'+val).style.display = 'block';
		document.getElementById('reportStatusHide'+val).style.display = 'none';
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
          <div class="bread"><?php echo $this->Html->link('My Reports','/tests/my_report');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
      <h1>My <span class="green">Account</span></h1>
    <div class="subHeading">
    <h2>My Reports</h2>
    <ul>
    <li><?php echo $html->link('Personal Details',array('controller'=>'tests','action'=>'personal_detail'));?></li>
    <li><?php echo $html->link('My Requests',array('controller'=>'tests','action'=>'my_request'));?></li>
    <li><?php echo $html->link('My Reports','javascript:void(0);',array('class'=>'act'));?></li>
	<li><?php echo $html->link('Payment History',array('controller'=>'tests','action'=>'payment_history'));?></li>
    <li class="borderNone padRightNone"><?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab("loggedout");'));?></li>
    </ul>
    
    
    
    </div>
      <div class="tableDiv">
	  	<?php if(count($get_requests) > 0) {?>
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <th width="70" class="thDiv"><span>S. No.</span></th>
            <th width="120" class="thDiv"><span>Patient Name</span></th>
            <th width="300" class="thDiv"><span>Test/Profile</span></th>
            <!--<th width="143" class="thDiv"><span>Email ID</span></th>
            <th width="143" class="thDiv"><span>Address</span></th>-->
            <!--<th width="80" class="thDiv"><span>Type</span></th>-->
            <th width="100" class="thDiv"><span>Book Date</span></th>
            <th class="thDiv" style="width:100px;"><span>Report</span></th>
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
            <td valign="top">
				<?php //if($val['Health']['patient_report'] != '' && $val['Health']['published'] == 1)  {?>
				<?php if($val['Health']['patient_report'] != '')  {?>
				<p><?php echo $html->link('Download Report',array('controller'=>'tests','action'=>'download_report',base64_encode($val['Health']['patient_report'])));?></p>
				<p><a href="<?php echo PATIENT_REPORT_URL.$val['Health']['patient_report'];?>" target="_blank">View Report</a></p>
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
            <th width="143" class="thDiv"><span>Address</span></th>-->
            <!--<th width="80" class="thDiv"><span>Type</span></th>-->
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