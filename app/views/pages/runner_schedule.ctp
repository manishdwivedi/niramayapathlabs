<style>
#runnercontainer
{
	padding-left:32%;padding-right:32%;padding-top: 10px;padding-bottom: 10px;
}
.headings {
	font-size:12px;
}
.contentbox
{
	font-size:13px;
}
.boldtext {
	width : 150px;
}
@media only screen and (max-width: 600px) {
	#runnercontainer {
	padding-left:2%;padding-right:2%;padding-top: 10px;padding-bottom: 10px;
	}
	.headings{
	font-size:10px;
	}
	.contentbox
	{
		font-size:9px;
	}
	.boldtext {
		width : 75px;
	}
}
.btn {
	border-radius: 3px;
    color: #fff;
    display: block;
    font-size: 14px;
    font-weight: 700;
    height: 32px;
    line-height: 32px;
    text-align: center;
    text-decoration: none;
    width: 100px;
    background: #a0d64a;
    color: #fff;
    font-weight: 700;
    cursor: pointer;
    border: 1px solid #73b110;
}

</style>
<div class="contentcontainer">

	<div id="runnercontainer">
			<div class="headings altheading" style="padding:10px;background-color: white;">
				<h2>Runner Schedule - <?php echo $date;?></h2>
			</div>
			<div class="contentbox" style="padding:10px;background-color: white;">
			<?php foreach($runnerdata as $key=>$val) {?>
				<br>
				<span><b>Request Id</b> - <?php echo $val['RunnerRequest']['runner_request_id']; ?> </span><br/>
				<span><b>Timings</b> - <?php echo $timelabs[$val['RunnerRequest']['time_slot']]; ?> </span>
				<br />
				<div>
					<table style="float:left">			
						<tr colspan="2"><td><b>PickUp Details</b> </td></tr>
						<tr>
							<td  class="boldText"> Name <font color="#FF0000">*</font></td>
							<td  style=" height: 30px;">
								<?php echo $val['RunnerRequest']['pickup_name'];?>
							</td>
						</tr>
						<tr>
							<td  class="boldText"> Contact <font color="#FF0000">*</font></td>
							<td  style=" height: 30px;">
								<?php echo $val['RunnerRequest']['pickup_contact'].",".$val['RunnerRequest']['pickup_alt_contact'];?>
							</td>
						</tr>
						<tr>
							<td  class="boldText"> Pick Up From <font color="#FF0000">*</font></td>
							<td  style=" height: 30px;">
								<?php echo $val['RunnerRequest']['pickup_location_name'];?>
							</td>
						</tr>
						<tr>
							<td  class="boldText"> Address <font color="#FF0000">*</font></td>
							<td  style=" height: 30px;">
								<?php echo $val['RunnerRequest']['pickup_address'];?><br>
								<?php echo $city[$val['RunnerRequest']['pickup_city']];?>
								<?php echo $state[$val['RunnerRequest']['pickup_state']]; ?><br>
							</td>
						</tr>
						
						<?php if($val['RunnerRequest']['pickup_location']!='')
						{ ?>
							<tr>
								<td  class="boldText"> Pickup Geo Location <font color="#FF0000">*</font></td> 
								<td  style=" height: 30px;">
								 <a href="<?php $val['RunnerRequest']['pickup_location']; ?>"><?php $val['RunnerRequest']['pickup_location']; ?></a>
								</td>
							</tr>
						<?php } ?>
					</table>
						
					<table style="padding-left:20px;">
						<tr colspan="2"><td><b>Drop Details</b> </td></tr>
						<tr>
							<td  class="boldText"> Name <font color="#FF0000">*</font></td>
							<td  style=" height: 30px;">
								<?php echo $val['RunnerRequest']['drop_name'];?>
							</td>
						</tr>
						<tr>
							<td  class="boldText"> Contact <font color="#FF0000">*</font></td>
							<td  style=" height: 30px;">
								<?php echo $val['RunnerRequest']['drop_contact'].",".$val['RunnerRequest']['drop_alt_contact'];?>
							</td>
						</tr>
						<tr>
							<td  class="boldText"> Drop At <font color="#FF0000">*</font></td>
							<td  style=" height: 30px;">
								<?php echo $val['RunnerRequest']['loc_name'];?>
							</td>
						</tr>
						<tr>
							<td  class="boldText"> Address <font color="#FF0000">*</font></td>
							<td  style=" height: 30px;">
								<?php echo $val['RunnerRequest']['drop_address'];?><br>
								<?php echo $city[$val['RunnerRequest']['drop_city']];?> 
								<?php echo $state[$val['RunnerRequest']['drop_state']]; ?><br>
							</td>
						</tr>
						<?php if($val['RunnerRequest']['drop_location']!='')
						{ ?>
							<tr>
								<td  class="boldText"> Drop Geo Location <font color="#FF0000">*</font></td> 
								<td  style=" height: 30px;">
								 <a href="<?php echo $val['RunnerRequest']['drop_location']; ?>" target="_blank"><?php echo $val['RunnerRequest']['drop_location']; ?></a>
								</td>
							</tr>
						<?php } ?>
					</table>
				</div>
				<div>
					<a target="_blank" href="/pages/submit_vials_details/<?php echo base64_encode($val['RunnerRequest']['id']);?>"><input type="button" class="btn" text="Vials Detail" value="Vials Detail"></a>
				</div>
				<hr>
			<?php } ?>
			
		</div>
	</div>	
</div>