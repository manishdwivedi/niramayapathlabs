<?php //echo "<pre>gdfgdfgdf"; print_r($userdetail); exit;?>
<style type="text/css">
.submit {
float:left;
margin:10px 10px 0px 0px;
}
.innercontainer_bottom_right_row2{
padding:0;
}


.input-text {
    background: url("../img/bg_fade_sml.png") repeat-x scroll center top transparent;
    border: 1px solid #999999;
    border-radius: 3px 3px 3px 3px;
    color: #666666;
    margin-bottom: 5px;
    padding: 10px;
    width: 300px;
}

.btn, .btnalt {
   
    border: 1px solid #859C27 !important;
    color: #859C27;
    font-size: 12px;
    font-weight: 700;
    padding: 7px 10px;
	float:left;
}

.table-head{
	text-transform:uppercase; 
	font-size:12px; 
	text-align:center; 
	border:1px solid #999; 
	border-radius:3px; 
	background: none repeat scroll 0 0 #EDEDED; 
	padding:3px;
}

.loop-row-center
{
	font-weight:normal; 
	border-right:1px solid #999; 
	border-bottom:1px solid #999; 
	height:25px; 
	text-align:center; 
	padding:5px;
}

.loop-row-notcenter
{
	font-weight:normal; 
	border-right:1px solid #999; 
	border-bottom:1px solid #999; 
	height:25px; 
	padding:5px;
}
</style>
<script type="text/javascript">
function listing(){
window.location.href=siteUrl+"members/register";
return false;
}

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


function show_report_status(val)
{
	document.getElementById('ReportStatus'+val).style.display = 'block';
}
</script>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
  <div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home">Home Page</div>
          <div class="bread"><?php echo $this->Html->link('My Account','/tests/my_account');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<!--bodycontainer div start here-->

<h2><?php echo $UserName."'s";?> <span class="green">Account</span></h2>

<div style="padding:100px 0px 0px 0px; font-weight:bold; font-size:12px;">
	<table border="0" width="100%" style="border:1px solid #999; border-radius:3px;">
		<tr id="SampleRequest" style="display:block;">
			<td width="150" style="border-right:1px solid #999;" valign="top">
				<table border="0" width="100%">
					<tr>
						<td style="font-weight:normal; padding:5px 5px 5px 0; border-bottom:1px solid #999;" height="20"><a href="<?php echo SITE_URL;?>tests/my_account">Sample Requests</a></td>
					</tr>
					<tr>
						<td style="font-weight:normal; padding:5px 5px 5px 0; border-bottom:1px solid #999;" height="20"><a href="<?php echo SITE_URL;?>tests/change_pass">Change Password</a></td>
					</tr>
					<tr>
						<td style="font-weight:normal; padding:5px 5px 5px 0; border-bottom:1px solid #999;" height="20"><a href="javascript:void(0);" onclick="show_tab('loggedout');">Logout</a></td>
					</tr>
				</table>
			</td>
			<td valign="top">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="8" style="padding:10px; width:813px;"><h2 style="margin:0; text-align:center; text-decoration:underline; width:100%;">Sample Requests</h2></td>
					</tr>
					<tr>
						<td colspan="8">&nbsp;</td>
					</tr>
					<?php if(count($get_requests) > 0) {?>
					<tr>
						<td class="table-head" style="width:30px; height:30px;">S.No.</td>
						<td class="table-head" style="width:150px; height:30px;">Patient Name</td>
						<td class="table-head" style="width:200px; height:30px;">Tests/Profiles</td>
						<td class="table-head" style="width:150px; height:30px;">Email</td>
						<td class="table-head" style="width:200px; height:30px;">Address</td>
						<td class="table-head" style="width:100px; height:30px;">Type</td>
						<td class="table-head" style="width:100px; height:30px;">Book Date</td>
						<td class="table-head" style="width:150px; height:30px;">Report</td>
					</tr>
					<?php $k = 1;foreach($get_requests as $key => $val) {?>
					<tr>
						<td class="loop-row-center"><?php echo $k;?></td>
						<td class="loop-row-notcenter"><?php echo $val['Health']['name'];?></td>
						
						<td class="loop-row-notcenter">
							<strong><?php echo $val['Health']['test_type'].'<br><br>';?></strong>
							<?php echo $val['Health']['test_name'].'<br><br>';?>
							<strong><?php echo $val['Health']['profile_type'].'<br><br>';?></strong>
							<?php echo $val['Health']['profile_name'];?>
						</td>
						
						<td class="loop-row-notcenter"><?php echo $val['Health']['email'];?></td>
						<td class="loop-row-notcenter"><?php echo $val['Health']['address1'];?></td>
						<?php if($val['Health']['opted_for_id'] == 0) {$type = 'By Call';} if($val['Health']['opted_for_id'] != 0) {$type = 'Self';}?>
						<td class="loop-row-center"><?php echo $type;?></td>
						<td class="loop-row-center"><?php echo $val['Health']['book_date'];?></td>
						<?php if($val['Health']['patient_report'] == '' && $val['Health']['published'] == 0) 
						{
						?>
						<!--<td class="loop-row-notcenter" style="text-align:center;"><a href="javascript:void(0);" onclick="show_report_status('<?php //echo $val['Health']['id'];?>');">See Status</a></td>-->
						<td class="loop-row-notcenter" style="text-align:center;">Not Uploaded</td>
						<?php 
						} 
						if($val['Health']['patient_report'] != '' && $val['Health']['published'] == 1) 
						{
						?>
						<td class="loop-row-notcenter" style="text-align:center;"><?php echo $html->link('Download',array('controller'=>'tests','action'=>'download_report',base64_encode($val['Health']['patient_report'])));?></td>
						<?php 
						}
						if($val['Health']['patient_report'] != '' && $val['Health']['published'] == 0) 
						{
						?>
						<td class="loop-row-notcenter" style="text-align:center;">Not Uploaded</td>
						<?php 
						}
						?>
					</tr>
					<?php if($val['Health']['published'] != 1) ?>
					<tr id="ReportStatus<?php echo $val['Health']['id'];?>">
						<td colspan="8">
							<table border="0" width="100%" style="font-weight:normal; border:1px solid #999; border-radius:5px;">
								<?php if(($val['Health']['reschduled'] == 1) && ($val['Health']['old_date'] != '0000-00-00') && ($val['Health']['old_time'] != 0)) {?>
								<tr>
									<td style="font-weight:bold; padding:10px; width:180px;">Request Reschduled</td>
									<td style="font-weight:bold;">:</td>
									<?php if(($val['Health']['sample_date1'] != '' || $val['Health']['sample_date1'] != 'Please select a suitable date') && ($val['Health']['sample_time1'] != '')) {?>
									<td style="padding:10px;">Date : <?php echo $val['Health']['sample_date1'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time : <?php echo $val['Health']['sample_time1'];?></td>
									<?php }?>
									<?php if(($val['Health']['sample_date'] != '' || $val['Health']['sample_date'] != 'Please select a suitable date') && ($val['Health']['sample_time'] != '')) {?>
									<td style="padding:10px;">Date : <?php echo $val['Health']['sample_date'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time : <?php echo $val['Health']['sample_time'];?></td>
									<?php }?>
								</tr>
								<?php }?>
								<?php if($val['Health']['cancelled_status'] == 1) {?>
								<tr>
									<td style="font-weight:bold; padding:10px; width:180px;">Request Cancelled Reason</td>
									<td style="font-weight:bold;">:</td>
									<td style="padding:10px;"><?php echo $val['Health']['cancelled_reason'];?></td>
								</tr>
								<?php }?>
								<?php if($val['Health']['published'] == 0) {?>
								<tr>
									<td style="font-weight:bold; padding:10px; width:180px;">Report Not Published Reason</td>
									<td style="font-weight:bold;">:</td>
									<td style="padding:10px;"><?php echo $val['Health']['published_reason'];?></td>
								</tr>
								<?php }?>
								
							</table>
						</td>
					</tr>
					<?php $k++;}?>
					<?php if(count($get_requests) > 10) {?>
					<tr>
						<td colspan="8"><?php echo $this->element('pagination_test');?></td>
					</tr>
					<?php }?>
					<?php } else {?>
					<tr>
						<td colspan="8" style="color:#FF0000; text-align:center;">No Records Found</td>
					</tr>
					<?php }?>
				</table>
			</td>
		</tr>
		
		
	</table>
</div>
