<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>nirAmaya</title>
</head>
<body>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="left">
	<tr>
		<td>
			Dear <?php echo $lab_info['Lab']['pcc_name']; ?>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			Bill Date: <?php echo date('d M Y',strtotime($health_data['Health']['s_date'])).' T'.date('H:i:s',strtotime($health_data['Health']['s_date'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			Bill Number: <?php echo 'NPL'.!empty($health_data['Health']['ref_num'])?$health_data['Health']['ref_num'] : $order_id;?>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			Completed Tests:
			<ul style="list-style:none;margin:0px;padding:0px;">
			<?php 
				$pending_test_count = 0;
				foreach($test_status as $key=>$value)
				{
					if($value['reporting_status'] == 1)
					{
						echo "<li style='margin:0px;'>*".$value['test_name']."</li>";
					}
					else
					{
						$pending_test_count++;
					}
				}
			?>
			</ul>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			<?php if($pending_test_count == 0){ ?>
			No Pending Tests.
			<?php } else { ?>
			Pending Tests: 
			<ul style="list-style:none;margin:0px;padding:0px;">
			<?php 
				foreach($test_status as $key=>$value)
				{
					if($value['reporting_status'] == 0)
					{
						echo "<li style='margin:0px;'>*".$value['test_name']."</li>";
					}
				}
			?>
			</ul>
			<?php } ?>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	
	<tr>
		<td>
			Thank you for choosing NirAmaya PathLabs. 
			<br/>
			<br/>
			<?php if(!empty($health_data['Health']['partial_reason']) && $email_stage =='partial'){
				echo "Note:- ".$health_data['Health']['partial_reason'];
			}
			?>
			<br/>
			Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.
			<br/>
			kindly write back to helpline@niramayapathlabs.com or You may also call us at +91-7042191851
			<br/><br/>
			Best Regards,
			<br/>
			Lab Director
			<br/>
			Niramaya Pathlabs
		</td>
	</tr>
</table>
</body>
</html>
