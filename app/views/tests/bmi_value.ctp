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
      </div>
    </div>
  </div>
  
	<div class="article_in_inner" style="padding-bottom: 60px;">
		<div class="article_in">
		<div class="preview">
		<div class="preBox2">Vital(s) </div>
		<div class="pacakgeBox list">
	  	<?php if(count($bmibpvalues) > 0) {?>
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <th width="40" valign="middle" align="center" class="yellow2"><span>S. No.</span></th>
			<th width="80" valign="middle" align="center" class="yellow2"><span>BMI Value</span></th>
            <th width="114" valign="middle" align="center" class="yellow2"><span>BMI</span></th>
            <th width="125" valign="middle" align="center" class="yellow2"><span>BP Systolic Value</span></th>
			<th width="130" valign="middle" align="center" class="yellow2"><span>BP Diastolic Value</span></th>
			<th width="80" valign="middle" align="center" class="yellow2"><span>Pulse Rate</span></th>
            <th width="100" valign="middle" align="center" class="yellow2"><span>Save Date</span></th>
          </tr>
		  
		  <?php $k = 1;foreach($bmibpvalues as $key => $val) {?>
          <tr>
            <td valign="middle"><?php echo $k;?>)</td>
			<td valign="middle"><p style="padding:0 0 0 22px;"><?php echo $val['UserBmiBp']['bmi_value'];?></p></td>
            <td valign="middle"><p style="padding:0 0 0 22px;"><?php echo $val['UserBmiBp']['bmi_indicator'];?></p></td>
            <td valign="middle"><p style="padding:0 0 0 22px;"><?php echo $val['UserBmiBp']['bp_systolic'];?></p></td>
			<td valign="middle"><p style="padding:0 0 0 22px;"><?php echo $val['UserBmiBp']['bp_diastolic'];?></p></td>
			<td valign="middle"><p style="padding:0 0 0 22px;"><?php echo $val['UserBmiBp']['bp_pulse'];?></p></td>
			<td valign="middle">
				<?php if($val['UserBmiBp']['time'] == '00:00') {?>
				<p style="padding:0 0 0 22px;"><?php echo date('d-M-Y H:i',strtotime($val['UserBmiBp']['save_date']));?></p>
				<?php } else {?>
				<p style="padding:0 0 0 22px;"><?php echo date('d-M-Y',strtotime($val['UserBmiBp']['save_date'])).' '.$val['UserBmiBp']['time'];?></p>
				<?php }?>
			</td>
          </tr>
		  
		  <?php $k++;}?>
		</table>
		<?php } else {?>
		<table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <th width="40" valign="middle" align="center" class="yellow2"><span>S. No.</span></th>
			<th width="80" valign="middle" align="center" class="yellow2"><span>BMI Value</span></th>
            <th width="114" valign="middle" align="center" class="yellow2"><span>BMI</span></th>
            <th width="90" valign="middle" align="center" class="yellow2"><span>Systolic Value</span></th>
			<th width="95" valign="middle" align="center" class="yellow2"><span>Diastolic Value</span></th>
			<th width="80" valign="middle" align="center" class="yellow2"><span>Pulse Rate</span></th>
            <th width="100" valign="middle" align="center" class="yellow2"><span>Save Date</span></th>
          </tr>
		  <tr>
		  	<td colspan="9" style="text-align:center;">Sorry no BMI found.</td>
		  </tr>
		 </table>
		<?php }?>
		</div>
      </div>
	  <?php if(count($bmibpvalues) > 0) {?>
      <div id="pagination"><?php echo $this->element('pagination_test');?></div>
	  <?php }?>
      <div class="bottomShadow"></div>
    </div>
  </div>