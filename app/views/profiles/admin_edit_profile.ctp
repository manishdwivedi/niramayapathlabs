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

<script language="JavaScript" type="text/javascript">
function validationc()
{
var str=true;
document.getElementById("msg1").innerHTML="";
document.getElementById("msg2").innerHTML="";
document.getElementById("msg3").innerHTML="";
document.getElementById("msg4").innerHTML="";
document.getElementById("msg5").innerHTML="";
document.getElementById("msg6").innerHTML="";
document.getElementById("msg7").innerHTML="";

document.getElementById("msg9").innerHTML="";


if(document.form1.ProfileTestcode.value=='')
{
	document.getElementById("msg1").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.ProfileTestParameter.value=='')
{
	document.getElementById("msg2").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.ProfileSample.value=='')
{
	document.getElementById("msg3").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.ProfileMethodology.value=='')
{
	document.getElementById("msg4").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.ProfileTemp.value=='')
{
	document.getElementById("msg5").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.ProfileSchedule.value=='')
{
	document.getElementById("msg6").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.ProfileReporting.value=='')
{
	document.getElementById("msg7").innerHTML="Please Enter Value";
	str=false;
}

if(document.form1.ProfileMrp.value=='')
{
	document.getElementById("msg9").innerHTML="Please Enter Value";
	str=false;
}


return str;
}

function edit_spec_dis(val)
{
	var input_type = '<input type="hidden" name="data[Test][submit_type]" value="using_link">';
	$('#SubmitType').html(input_type);
	//alert('hiiiiiiiii');
	document.forms["form1"].submit();
}

function delete_obs(id)
{
	var testobser = $('#TestTestscode').val();
	var obsid = testobser.split(',');
	obsid.splice($.inArray(id.toString(), obsid),1);
	$('#test'+id).remove();
	var newobs = obsid.join(',');
	$('#TestTestscode').val(newobs);
	var datastring = "codes="+$('#TestTestscode').val();
	$.ajax({
    type: "POST",
    url: siteUrl+"profiles/obstest",
    data: datastring,
    cache: false,
    success: function(html)
    {
		//console.log(html);
		var data = html.split("@@@@@@@");
		//$("#selectedobservations").html(html).show();
		$("#selectedobservations").html(data[1]);
		$("#TestSamplename").html(data[0]);
		$("#TestSample").val(data[3]);
		$("#PackageTypeObservationIds").val(data[2]);
    }
    });
	console.log(obsid);
}

</script>

<script type="text/javascript">
$(function(){
$(".observation").keyup(function() 
{ 
var TestTestParameter = $(this).val();
//console.log(TestTestParameter);
var dataString = 'search='+ TestTestParameter;
if(TestTestParameter!='')
{
    $.ajax({
    type: "POST",
    url: siteUrl+"profiles/searchtest",
    data: dataString,
    cache: false,
    success: function(html)
    {
		//console.log(html);
		$("#testList").html(html).show();
    }
    });
}return false;    
});

$('#testList').change(function(){
	$('#testList').attr('disabled', 'disabled');
    var value = $(this).val();
	var datastring = 'id='+value;
	var testobser = $('#TestTestscode').val();
	
	var obsid = testobser.split(',');
	var selectedhtml = $("#selectedtest").html();
	var selectedobs = $("#selectedobservations").html();
	var samples = $("#TestSamplename").html();
	var samplesid = $("#TestSample").val();
	var result = $.inArray(value[0], obsid);
	var obserid = $("#PackageTypeObservationIds").val();
	if(result<0)
	{
		$.ajax({
		type: "POST",
		url: siteUrl+"profiles/gettest",
		data: datastring,
		cache: false,
		success: function(html)
		{
			var data = html.split("@@@@@@@@");
			console.log(data);
			var datasample = samples.split(",");
			
			var selectedobsid = obserid.split(",");
			var newobsid = data[2].split(",");
			var dupli = 0;
			for(var check=0;check < newobsid.length; check++) {
				if (selectedobsid.indexOf(newobsid[check]) > -1) {
					dupli = 1;
				}
			}
			if(dupli == 1)
			{
				document.getElementById("msg10").innerHTML="Due To Duplicate Observation Test Can't Be Added";
				return false;
			}
			else
				document.getElementById("msg10").innerHTML="";
				
			var samplecheck = $.inArray(data[1].trim(), datasample);
			if(samplecheck<0)
			{
				if(datasample[0]=="")
				{
					selectedsample = data[1].trim();
					selectedsampleid = data[4].trim();
				}
				else
				{
					selectedsample = samples+","+data[1].trim();
					selectedsampleid = samplesid+","+data[4].trim();
				}
				$("#TestSamplename").html(selectedsample);	
				$("#TestSample").val(selectedsampleid);
				
				if(selectedobs=="")
					$("#selectedobservations").html(data[3]);
				else
					$("#selectedobservations").html(selectedobs+","+data[3]);
					
			}
			if(obserid=='')
				$("#PackageTypeObservationIds").val(data[2]);
			else
				$("#PackageTypeObservationIds").val(obserid+','+data[2]);
			selectedhtml = selectedhtml+data[0];
			$("#selectedtest").html(selectedhtml).show();
			$('#testList').removeAttr('disabled');
			
			if(testobser=='')
				$('#TestTestscode').val(value);		
			else
				$('#TestTestscode').val(testobser+','+value);
		}
		}); 
	}
});

	
	var value = $('#TestTestscode').val();
	var datastring = 'id='+value;
	console.log(datastring);
	$.ajax({
		type: "POST",
		url: siteUrl+"profiles/gettest",
		data: datastring,
		cache: false,
		success: function(html)
		{
			var data = html.split("@@@@@@@@");
			console.log(data);
			$("#selectedtest").html(data[0]).show();
			$("#selectedobservations").html(data[3]);
			$("#PackageTypeObservationIds").val(data[2]);
			$("#TestSamplename").html(data[1]);
			$("#TestSample").val(data[4]);
		}
	}); 
	$('#TestTestscode').val(value);		
	
});
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit Profile</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Profile(s)', '/admin/profiles/index', array('title'=>'Manage Profile(s)')); ?> &#187; Edit Profile
	<?php echo $form->create(null, array('url'=>'/admin/profiles/edit_profile/'.base64_encode($this->data['Test']['id']),'onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1','enctype'=>'multipart/form-data')); ?>
	<?php echo $form->hidden('Test.id',array('value'=>$this->data['Test']['id']));?>
	<?php echo $form->hidden('Test.status',array('value'=>$this->data['Test']['status']));?>
	<?php echo $form->hidden('Test.add_date',array('value'=>$this->data['Test']['add_date']));?>
	<?php echo $form->hidden('Test.old_file_name',array('value'=>$this->data['Test']['file_name']));?>
<div id="SubmitType"></div>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Profile Code</td>
		<td>
			<?php echo $form->text('Test.testcode', array('class'=>'input-text')); ?><span class="hint-class">(EX- P091)</span>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Profile Name</td>
		<td>
			<?php echo $form->textarea('Test.test_parameter', array('class'=>'class-textarea')); ?><span class="hint-class">(EX- Abortion Panel (For repeated abortions))</span>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
		<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Add Tests</td>
		<td>
			<?php echo $form->text('Test.tests', array('class'=>'class-textarea observation')); ?><!--<span class="hint-class">(EX- (T - Cell / B - Cell Subset) Marker : CD 5)</span>-->
			<br>
			<select id='testList' multiple style="width:323px;"></select><br><br>
			<div id="msg10" style="color:#FF0000; font-size:12px;"></div>
			<b>Selected Tests</b><br>
			<div id="selectedtest"></div>
			<br><br>
			<b>Selected Observations</b><br>
			<div id="selectedobservations"></div>
			<?php echo $form->text('Test.testscode', array('class'=>'class-textarea','style'=>'display:none;')); ?>
			<?php echo $form->text('observation_ids', array('class'=>'class-textarea','style'=>'display:none;')); ?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Sample</td>
		<td>
			<div id="TestSamplename"></div>
			<?php echo $form->text('Test.sample', array('class'=>'class-textarea','style'=>'display:none;')); ?>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Methodology</td>
		<td>
			<?php echo $form->textarea('Test.methodology', array('class'=>'class-textarea')); ?><span class="hint-class">(EX- ELISA, Enhanced chemiluminescence (Ultra Sensitive 4th Generation Chemiflex))</span>
			<div id="msg4" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Temp</td>
		<td>
			<?php echo $form->text('Test.temp', array('class'=>'input-text')); ?><span class="hint-class">(EX- A/R)</span>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Schedule</td>
		<td>
			<?php echo $form->text('Test.schedule', array('class'=>'input-text')); ?><span class="hint-class">(EX- Daily)</span>
			<div id="msg6" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Reporting</td>
		<td>
			<?php echo $form->text('Test.reporting', array('class'=>'input-text')); ?><span class="hint-class">(EX- 48 Hrs,Next Day,Same day)</span>
			<div id="msg7" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Fasting Required</td>
		<td>
			<?php echo $form->text('Test.net', array('class'=>'input-text')); ?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>MRP</td>
		<td>
			<?php echo $form->text('Test.mrp', array('class'=>'input-text')); ?><span class="hint-class">(EX- 3250,2575)</span>
			<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	
	<tr>
		<td width="15%" class="boldText">Market Price</td>
		<td>
			<?php echo $form->text('Test.banner_market_mrp', array('class'=>'input-text')); ?>
			
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Sequence</td>
		<td>
			<?php echo $form->text('Test.sequence', array('class'=>'input-text')); ?>
			
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Brief Description</td>
		<td>
			<?php echo $form->textarea('Test.description', array('class'=>'class-textarea','style'=>'width:400px; height:100px;')); ?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Upload New PDF</td>
		<td>
			<?php echo $form->file('Test.description_pdf',array());?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Specialities</td>
		<td>
			<?php if(count($this->data['Test']['speciality_name']) > 0) {?>
				<?php $k = 1;foreach($this->data['Test']['speciality_name'] as $key => $val) {?>
				<?php echo '<span style="font-weight:bold;">'.$k.'-</span> '.$val.'<br>';?>
				<?php $k++;}?>
			<?php } else {?>
				No Speciality
			<?php }?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Diseases</td>
		<td>
			<?php if(count($this->data['Test']['disease_name']) > 0) {?>
				<?php $m = 1;foreach($this->data['Test']['disease_name'] as $key => $val) {?>
				<?php echo '<span style="font-weight:bold;">'.$m.'-</span> '.$val.'<br>';?>
				<?php $m++;}?>
			<?php } else {?>
				No Disease
			<?php }?>
		</td>
	</tr>
	<tr>
                <td width="15%" class="boldText">Package Type</td>
		<td>
                    <?php e($form->select('Test.p_type', $package_type, null, array('class'=>'','empty'=>'Select Type'),null,false))?>
                </td>
        </tr>
        <tr>
                <td width="15%" class="boldText">Category</td>
		<td>
                    <?php e($form->select('Test.profit_margin_category', $profit_category, null, array('class'=>'','empty'=>'Select Category'),null,false))?>
                </td>
        </tr>
	<tr>
		<td>&nbsp;</td>
		<td><a href="javascript:void(0);" onclick="edit_spec_dis();">Proceed to Edit Specialities & Diseases</a></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Status</td>
		<td>
				<select name="data[Test][status]">
				<option value="">Select One</option>
				<option value="1" <?php if($this->data['Test']['status'] == '1') {?> selected="selected" <?php }?>>Activate</option>
				<option value="2" <?php if($this->data['Test']['status'] == '2') {?> selected="selected" <?php }?>>Deactivate</option>
			</select>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Special Offer</td>
		<td>		
		<?php //echo $form->text('Test.sequence', array('class'=>'input-text','type'=>'checkbox')); ?>
			<?php echo $form->checkbox('Test.special_offer', array('class'=>'','value'=>'1')); ?>
		</td>
	</tr>
	
	<tr>
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn')); ?>
			<!--<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>-->
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>