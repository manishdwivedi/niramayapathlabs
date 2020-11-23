<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="8"><span style="font-weight:bold; font-family:arial; font-size:11px;">Agent Name :</span> <span style="font-family:arial; font-size:11px;"><?php echo $agent_list[0]['agent_summary']['agent_name'];?></span></td>
	</tr>
	<tr style="height:50px;">
		<td style="font-family:arial; font-size:11px; font-weight:bold; border-left:1px solid #999; border-right:1px solid #999; border-top:1px solid #999; border-bottom:1px solid #999; text-align:center;">S.No.</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold; border-right:1px solid #999; border-top:1px solid #999; border-bottom:1px solid #999; text-align:center;">Patient Name</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold; border-right:1px solid #999; border-top:1px solid #999; border-bottom:1px solid #999; text-align:center;">Age</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold; border-right:1px solid #999; border-top:1px solid #999; border-bottom:1px solid #999; text-align:center;">Gender</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold; border-right:1px solid #999; border-top:1px solid #999; border-bottom:1px solid #999; text-align:center;">Date</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold; border-right:1px solid #999; border-top:1px solid #999; border-bottom:1px solid #999; text-align:center;">Time</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold; border-right:1px solid #999; border-top:1px solid #999; border-bottom:1px solid #999; text-align:center;">Location</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold; border-right:1px solid #999; border-top:1px solid #999; border-bottom:1px solid #999; padding-left:10px;">Status</td>
	</tr>
	<?php $k = 1;foreach($agent_list as $key=>$val){?>
	<tr>
		<td width="30" style="font-family:arial; font-size:11px; text-align:center; border-left:1px solid #999; border-right:1px solid #999;"><?php echo $k;?></td>
		<td style="font-family:arial; font-size:11px; border-right:1px solid #999; text-align:center;"><?php echo $val['agent_summary']['s_name'];?></td>
		<td style="font-family:arial; font-size:11px; border-right:1px solid #999; text-align:center;"><?php echo $val['agent_summary']['s_age'];?></td>
		<td style="font-family:arial; font-size:11px; border-right:1px solid #999; text-align:center;"><?php echo $val['agent_summary']['s_gender'];?></td>
		<td style="font-family:arial; font-size:11px; border-right:1px solid #999; text-align:center;"><?php echo $val['agent_summary']['s_collectiondate'];?></td>
		<td style="font-family:arial; font-size:11px; border-right:1px solid #999; text-align:center;"><?php echo $val['agent_summary']['s_collectiontime'];?></td>
		<td style="font-family:arial; font-size:11px; border-right:1px solid #999; text-align:center;"><?php echo $val['agent_summary']['s_collectionadd'];?></td>
		<td style="font-family:arial; font-size:11px; border-right:1px solid #999; padding-left:10px;">
			<span style="font-weight:bold;">a)</span>&nbsp;&nbsp;Sample Collected<br />
			<span style="font-weight:bold;">b)</span>&nbsp;&nbsp;Not Given Sample<br />
			<span style="font-weight:bold;">c)</span>&nbsp;&nbsp;Other Day (<span style="font-weight:bold;">Date:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Time:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
		</td>
	</tr>
	<tr>
		<td colspan="8"><hr /></td>
	</tr>
	<?php $k++;}?>
	<tr>
		<td colspan="8">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="8">&nbsp;</td>
	</tr>
</table>
<table border="0" width="100%">
	<tr>
		<td colspan="3" style="text-align:center; font-family:arial; font-weight:bold;">Patient Detailed List</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<?php $h = 1;foreach($request_det as $key => $val) {?>
	
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td style="font-family:arial; font-size:11px; font-weight:bold; width:100px;"><?php echo $h.' - ';?>Patient Name</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold;">:</td>
		<td style="font-family:arial; font-size:11px;"><?php echo $val['Health']['patient_name'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td style="font-family:arial; font-size:11px; font-weight:bold; width:100px;">Gender</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold;">:</td>
		<td style="font-family:arial; font-size:11px;"><?php echo $val['Health']['gender'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td style="font-family:arial; font-size:11px; font-weight:bold; width:100px;">Age</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold;">:</td>
		<td style="font-family:arial; font-size:11px;"><?php echo $val['Health']['age'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td style="font-family:arial; font-size:11px; font-weight:bold; width:100px;">Contact</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold;">:</td>
		<td style="font-family:arial; font-size:11px;"><?php echo $val['Health']['contact'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<?php if(!empty($val['Health']['test_names'])) {?>
	<tr>
		<td style="font-family:arial; font-size:11px; font-weight:bold; width:100px;" valign="top">Test(s)</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold;" valign="top">:</td>
		<td style="font-family:arial; font-size:11px;"><?php echo $val['Health']['test_names'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<?php }?>
	
	<?php if(!empty($val['Health']['profile_names'])) {?>
	<tr>
		<td style="font-family:arial; font-size:11px; font-weight:bold; width:100px;" valign="top">Profile(s)</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold;" valign="top">:</td>
		<td style="font-family:arial; font-size:11px;"><?php echo $val['Health']['profile_names'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<?php }?>
	
	<tr>
		<td style="font-family:arial; font-size:11px; font-weight:bold; width:100px;">Collection Date</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold;">:</td>
		<td style="font-family:arial; font-size:11px;"><?php echo $val['Health']['home_collect_date'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td style="font-family:arial; font-size:11px; font-weight:bold; width:100px;">Collection Time</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold;">:</td>
		<td style="font-family:arial; font-size:11px;"><?php echo $val['Health']['home_collect_time'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td style="font-family:arial; font-size:11px; font-weight:bold; width:100px;">Collection Address</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold;">:</td>
		<td style="font-family:arial; font-size:11px;"><?php echo $val['Health']['home_collect_address'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td style="font-family:arial; font-size:11px; font-weight:bold; width:100px;">City</td>
		<td style="font-family:arial; font-size:11px; font-weight:bold;">:</td>
		<td style="font-family:arial; font-size:11px;"><?php echo $val['Health']['city_id'];?></td>
	</tr>
	<tr>
		<td colspan="3"><hr /></td>
	</tr>
	<?php $h++;}?>
</table>
<?php 
echo "<script>";
echo "window.print();";
echo "</script>";
?>