<style type="text/css">
.class-textarea
{
	border: 1px solid #999999;
    border-radius: 3px 3px 3px 3px;
    color: #666666;
    margin-bottom: 5px;
    padding: 10px;
    width: 300px;
	font-size:13px;
}

.hint-class
{
	color:#999999; 
	font-size:11px; 
	padding:0 0 0 10px;
}
</style>
<script type="text/javascript">
function show_lab(val)
{
	if(val == 1)
	{
		$('#visit_lab_1').show();
		$('#visit_lab_2').show();
		$('#visit_lab_3').show();
		$('#home_collection_1').hide();
		$('#home_collection_2').hide();
		$('#home_collection_3').hide();
		$('#home_collection_4').hide();
		$('#submit_div').show();
	}
	if(val == 2)
	{
		$('#visit_lab_1').hide();
		$('#visit_lab_2').hide();
		$('#visit_lab_3').hide();
		$('#home_collection_1').show();
		$('#home_collection_2').show();
		$('#home_collection_3').show();
		$('#home_collection_4').show();
		$('#submit_div').show();
	}
}


function show_payment()
{
	$('#updatePayStatus').show();
	$('#uploadReport').hide();
	$('#editDetails').hide();
}

function payment_submit()
{
	document.forms["form2"].submit();
}

function report_submit()
{
	document.forms["form3"].submit();
}

function show_up_report()
{
	$('#uploadReport').show();
	$('#updatePayStatus').hide();
	$('#editDetails').hide();
}

function show_edit()
{
	$('#editDetails').show();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
}
</script>

<script language="JavaScript" type="text/javascript">
function validationc_report()
{
	var str=true;
	document.getElementById("msg1_1").innerHTML="";
	if(document.form3.HealthPatientReport.value=='')
	{
		document.getElementById("msg1_1").innerHTML="Please Select Report";
		str=false;
	}
	return str;
}
</script>

<script type="text/javascript">
function show_lab(val)
{
	if(val == 1)
	{
		$('#visit_lab_1').show();
		$('#visit_lab_2').show();
		$('#visit_lab_3').show();
		$('#home_collection_1').hide();
		$('#home_collection_2').hide();
		$('#home_collection_3').hide();
		$('#home_collection_4').hide();
		$('#submit_div').show();
	}
	if(val == 2)
	{
		$('#visit_lab_1').hide();
		$('#visit_lab_2').hide();
		$('#visit_lab_3').hide();
		$('#home_collection_1').show();
		$('#home_collection_2').show();
		$('#home_collection_3').show();
		$('#home_collection_4').show();
		$('#submit_div').show();
	}
}
</script>

<script language="JavaScript" type="text/javascript">
function validationc()
{
	var str=true;
	document.getElementById("msg1").innerHTML="";
	document.getElementById("msg2").innerHTML="";
	document.getElementById("msg3").innerHTML="";
	document.getElementById("msg5").innerHTML="";
	document.getElementById("msg6").innerHTML="";
	
	
	if(document.form1.HealthName.value=='')
	{
		document.getElementById("msg1").innerHTML="Please Enter First Name";
		str=false;
	}
	if(document.form1.HealthGender.value=='')
	{
		document.getElementById("msg2").innerHTML="Please Select Gender";
		str=false;
	}
	if(document.form1.HealthAge.value=='')
	{
		document.getElementById("msg3").innerHTML="Please Enter Age";
		str=false;
	}
	if(isNaN(document.form1.HealthLandline.value))
	{
		document.getElementById("msg5").innerHTML="Please Insert Numeric Mobile No.";
		str = false;
	}
	else if(document.form1.HealthLandline.value.length<10)
	{
		document.getElementById("msg5").innerHTML="Please Insert Valid Mobile No.";
    	str = false;
	}
	else{}
	var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(!document.form1.HealthEmail.value.match(validate_char))
	{
		document.getElementById("msg6").innerHTML="Please Enter a valid email address";
		str=false;
	}
	
	
	return str;
}
</script>

<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		minDate: 0,
		maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		minDate: 0,
		maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
});
</script>


<div class="contentcontainer">
    <div class="headings altheading">
        <h2>View Sample Request</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Sample Request(s)', array('controller'=>'samples','action'=>'home',$labtype,$assign), array('title'=>'Manage Sample Request(s)')); ?> &#187; View Sample Request
	
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Patient Name</td>
		<td><?php echo $this->data['Health']['patient_name'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Gender</td>
		<td><?php echo $this->data['Health']['gender'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Age</td>
		<td><?php echo $this->data['Health']['age'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Contact</td>
		<td><?php echo $this->data['Health']['contact'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Email</td>
		<td><?php echo $this->data['Health']['email'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Address</td>
		<td><?php echo nl2br($this->data['Health']['address']);?></td>
	</tr>
	<!--<tr>
		<td width="15%" class="boldText">Remarks</td>
		<td><?php //echo nl2br($this->data['Health']['remarks']);?></td>
	</tr>-->
	<?php if(!empty($this->data['Health']['test_names'])) {?>
	<tr>
		<td width="15%" class="boldText">Test(s)</td>
		<td><?php echo $this->data['Health']['test_names'];?></td>
	</tr>
	<?php }?>
	<?php if(!empty($this->data['Health']['profile_names'])) {?>
	<tr>
		<td width="15%" class="boldText">Profile(s)</td>
		<td><?php echo $this->data['Health']['profile_names'];?></td>
	</tr>
	<?php }?>
	<tr>
		<td width="15%" class="boldText">Remark</td>
		<td><?php echo $this->data['Health']['remark'];?></td>
	</tr>
	
	<?php if((!empty($this->data['Health']['visit_lab_location']) && !empty($this->data['Health']['visit_lab_collect_time']) && !empty($this->data['Health']['visit_lab_collect_date']))) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Visit a Lab</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Visit Location</td>
		<td><?php echo $this->data['Health']['visit_lab_location'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Visit Time</td>
		<td><?php echo $this->data['Health']['visit_lab_collect_time'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Visit Date</td>
		<td><?php echo $this->data['Health']['visit_lab_collect_date'];?></td>
	</tr>
	<?php }?>
	
	<?php if((!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date']) && !empty($this->data['Health']['home_collect_address']))) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Home Collection</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Collection Date</td>
		<td><?php echo $this->data['Health']['home_collect_date'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Collection Time</td>
		<td><?php echo $this->data['Health']['home_collect_time'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Collection Address</td>
		<td><?php echo nl2br($this->data['Health']['home_collect_address']);?></td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">City</td>
		<td><?php echo nl2br($this->data['Health']['city_id']);?></td>
	</tr>
	<?php }?>
	<tr>
		<td colspan="2" style="text-align:right;"><a href="javascript:void(0);" onclick="history.go(-1);">Back</a></td>
	</tr>
</table>

</div>