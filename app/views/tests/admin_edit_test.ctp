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


if(document.form1.TestTestcode.value=='')
{
	document.getElementById("msg1").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.TestTestParameter.value=='')
{
	document.getElementById("msg2").innerHTML="Please Enter Value";
	str=false;
}
/*if(document.form1.TestSample.value=='')
{
	document.getElementById("msg3").innerHTML="Please Enter Value";
	str=false;
}*/
if(document.form1.TestMethodology.value=='')
{
	document.getElementById("msg4").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.TestTemp.value=='')
{
	document.getElementById("msg5").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.TestSchedule.value=='')
{
	document.getElementById("msg6").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.TestReporting.value=='')
{
	document.getElementById("msg7").innerHTML="Please Enter Value";
	str=false;
}

if(document.form1.TestMrp.value=='')
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

function delete_sample(id)
{
	var testsample = $('#TestSample').val();
		
	var samples = testsample.split(',');
	
	for( var i = 0; i < samples.length; i++){ 
	   if ( samples[i] == id) {
		 samples.splice(i, 1); 
	   }
	}
	
	var datastring = 'id='+samples.join();
	$.ajax({
		type: "POST",
		url: siteUrl+"tests/getsamplename",
		data: datastring,
		cache: false,
		success: function(html)
		{
			$("#selectedsample").html(html).show();
			$('#TestSample').val(samples.join());
		}
	});
}

function delete_obs(id)
{
	var testobser = $('#TestObservationId').val();
	var obsid = testobser.split(',');
	obsid.splice($.inArray(id.toString(), obsid),1);
	$('#observation'+id).remove();
	var newobs = obsid.join(',');
	$('#TestObservationId').val(newobs);
	console.log(obsid);
}

function document_check()
{
	var checkBox = document.getElementById("TestGetAdditionalInfo");
	
	if (checkBox.checked == true){
		$('#documentList').removeAttr('disabled');
		$('#documentList').css('background','white');
    } else {
		$('#documentList').attr('disabled','true');
		$('#documentList').css('background','lightgray');
    }
}  

function delete_doc(id)
{
	var documentids = $('#TestDocumentList').val();
	var document_list = documentids.split(',');

	document_list.splice($.inArray(id.toString(), document_list),1);
	$('#doc_'+id).remove();
	var newdoc = document_list.join(',');
	$('#TestDocumentList').val(newdoc);
	console.log(documentids);
}
</script>

<script type="text/javascript">
$(function(){
$(".observation").keyup(function() 
{ 
	var ObservationObservationName = $(this).val();
	var sample = $("#TestSample").val();
	console.log(sample);
	
	if(sample=='')
	{
		document.getElementById("msg3").innerHTML="Please Select a Value";
		$("#observationList").html("");
		return false;
	}
	else{
		var dataString = 'search='+ ObservationObservationName+"&sample="+sample;
		if(ObservationObservationName!='')
		{
			$.ajax({
			type: "POST",
			url: siteUrl+"tests/searchobservation",
			data: dataString,
			cache: false,
			success: function(html)
			{
				console.log(html);
				$("#observationList").html(html).show();
				document.getElementById("msg3").innerHTML="";
			}
			});
		}
		return false;    
	}
});

$('.testcode').keyup(function(){
	var testCode = $(this).val();
	var dataString = 'search='+ testCode;
	if(testCode!='')
	{
		$.ajax({
		type: "POST",
		url: siteUrl+"tests/searchtescode",
		data: dataString,
		cache: false,
		success: function(data)
		{
			if(data!=0){
				console.log(data);
				$("#uniquetest").val("1");
				$("#codeFailure").show();
			}
			else
			{
				$("#codeFailure").hide();
				$("#uniquetest").val("0");
			}
		}
		});
	}
	else
	{
		$("#codeFailure").hide();
		$("#uniquetest").val("0");
	}	
	return false;    
});

$('.testparameter').keyup(function(){
	var testparameter = $(this).val();
	console.log(sample);
	var dataString = 'search='+ testparameter;
	if(testparameter!='')
	{
		$.ajax({
		type: "POST",
		url: siteUrl+"tests/searchtesparameter",
		data: dataString,
		cache: false,
		success: function(data)
		{
			if(data!=0){
				console.log(data);
				$("#uniquetest").val("1");
				$("#nameFailure").show();
			}
			else
			{
				$("#nameFailure").hide();
				$("#uniquetest").val("0");
			}
		}
		});
	}
	else
	{
		$("#nameFailure").hide();
		$("#uniquetest").val("0");
	}	
	return false;    
});

$('#TestSample').change(function(){
	console.log('test');
	$('#TestObservationId').val("");		
	$("#selectedobservation").html("");
});
$('#observationList').change(function(){ 
	$('#observationList').attr('disabled', 'disabled');
    var value = $(this).val();
	console.log(value);
	var datastring = 'id='+value;
	var testobser = $('#TestObservationId').val();
	
	var obsid = testobser.split(',');
	console.log(obsid);
	var selectedhtml = $("#selectedobservation").html();
	var result = $.inArray(value[0], obsid);
	console.log(result);
	if(result<0)
	{
		$.ajax({
		type: "POST",
		url: siteUrl+"tests/getobservation",
		data: datastring,
		cache: false,
		success: function(html)
		{
			selectedhtml = selectedhtml+html;
			$("#selectedobservation").html(selectedhtml).show();
			$('#observationList').removeAttr('disabled');
		}
		}); 
		if(testobser=='')
			$('#TestObservationId').val(value);		
		else
			$('#TestObservationId').val(testobser+','+value);
	}
});

$('#ActivityLogSample').change(function(){
	var value = $(this).val();
	var html = $(this).children("option:selected").html();
	var selectedsample = $('#selectedsample').html();
	var selectedsampleid = $('#TestSample').val();
	
	var s_sample = selectedsample.split(',');
	var s_sample_id = selectedsampleid.split(',');
	
	if(!s_sample.includes(html))
	{
		console.log(value);
		console.log(html);
		if(selectedsample=="")
			$('#TestSample').val(value);
		else
			$('#TestSample').val(selectedsampleid+","+value);
		
		var testsample = $('#TestSample').val();
		
		var datastring = 'id='+testsample;
		$.ajax({
			type: "POST",
			url: siteUrl+"tests/getsamplename",
			data: datastring,
			cache: false,
			success: function(html)
			{
				$("#selectedsample").html(html).show();
			}
		});
	}
});

$('#documentList').change(function(){ 
	var documentids = $('#TestDocumentList').val();
	var selecteddocument = $('#selecteddocument').html();

	var html = "<div id='doc_"+this.options[this.selectedIndex].id+"'>"+$(this).val()+"<a href='javascript:void(0);' onclick='delete_doc("+this.options[this.selectedIndex].id+")' style='font-weight:bold; color:#FF0000; text-decoration:none;'>[X]</a></div>";

	if(documentids=='')
	{
		$('#TestDocumentList').val(this.options[this.selectedIndex].id);
		$('#selecteddocument').html(html);	
	}
	else
	{
		var document_list = documentids.split(',');
		var result = $.inArray(this.options[this.selectedIndex].id, document_list);
		if(result < 0)
		{
			$('#TestDocumentList').val(documentids+','+this.options[this.selectedIndex].id);
			$('#selecteddocument').html(selecteddocument+html);	
		}
		else
		{
			$('#msg_doc').html("Duplicate Document Can't be Added");
			setTimeout(function(){ 
				$('#msg_doc').html("");
			}, 3000);
		}
	}
});

var testsample = $('#TestSample').val();
	var datastring = 'id='+testsample;
	$.ajax({
    type: "POST",
    url: siteUrl+"tests/getsamplename",
    data: datastring,
    cache: false,
    success: function(html)
    {
		$("#selectedsample").html(html).show();
    }
    });

var value = $('#TestObservationId').val();
	console.log(value);
	var datastring = 'id='+value;
	$.ajax({
    type: "POST",
    url: siteUrl+"tests/getobservation",
    data: datastring,
    cache: false,
    success: function(html)
    {
		$("#selectedobservation").html(html).show();
    }
    }); 
	$('#TestObservationId').val(value);
	
});
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit Test</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
<?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Test(s)', '/admin/tests/index', array('title'=>'Manage Test(s)')); ?> &#187; Edit Test
<?php echo $form->create(null, array('url'=>'/admin/tests/edit_test/'.base64_encode($this->data['Test']['id']),'onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1','enctype'=>'multipart/form-data')); ?>
<?php echo $form->hidden('Test.id',array('value'=>$this->data['Test']['id']));?>
<?php echo $form->hidden('Test.add_date',array('value'=>$this->data['Test']['add_date']));?>
<?php echo $form->hidden('Test.status',array('value'=>$this->data['Test']['status']));?>
<?php echo $form->hidden('Test.old_file_name',array('value'=>$this->data['Test']['file_name']));?>
<div id="SubmitType"></div>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Test Code</td>
		<td>
			<?php echo $form->text('Test.testcode', array('class'=>'input-text testcode')); ?><span class="hint-class">(EX- H2069)</span>
			<span id="codeFailure" style="display:none;color:red;">Test Code already exists.<span>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
			<input type="hidden" id="uniquetest" value="0">
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Test Name</td>
		<td>
			<?php echo $form->textarea('Test.test_parameter', array('class'=>'class-textarea testparameter')); ?><span class="hint-class">(EX- (T - Cell / B - Cell Subset) Marker : CD 5)</span>
			<span id="nameFailure" style="display:none;color:red;">Test Name already exists.<span>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Sample</td>
		<td>
			<?php e($form->select('Test.sample', $samplelist, null, array('class'=>'','empty'=>'Select Category','style'=>'width:323px','name'=>'sampleList'),null,false))?>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div><br>
			<b>Selected Sample</b><br>
			<div id="selectedsample"></div>
			<?php echo $form->text('Test.sample', array('class'=>'class-textarea','style'=>'display:none;')); ?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Add Observation</td>
		<td>
			<?php echo $form->text('Observation.observation_name', array('class'=>'class-textarea observation')); ?><!--<span class="hint-class">(EX- (T - Cell / B - Cell Subset) Marker : CD 5)</span>-->
			<br>
			<select id='observationList' multiple style="width: 325px;"></select>
			<br><br>
			<b>Selected Observations</b><br>
			<div id="selectedobservation"></div>
			<?php echo $form->text('Test.observation_id', array('class'=>'class-textarea','style'=>'display:none;')); ?>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Methodology</td>
		<td>
			<?php echo $form->textarea('Test.methodology', array('class'=>'class-textarea')); ?><span class="hint-class">(EX- Flow Cytometry - BD FACSCalibur)</span>
			<div id="msg4" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Temp</td>
		<td>
			<?php echo $form->text('Test.temp', array('class'=>'input-text')); ?><span class="hint-class">(EX- R)</span>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Schedule</td>
		<td>
			<?php echo $form->text('Test.schedule', array('class'=>'input-text')); ?><span class="hint-class">(EX- Daily,3,2 & 5)</span>
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
			<?php echo $form->text('Test.fasting_required', array('class'=>'input-text')); ?>
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
			<?php if(!empty($this->data['Test']['speciality_name'])) {?>
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
			<?php if(!empty($this->data['Test']['disease_name'])) {?>
				<?php $m = 1;foreach($this->data['Test']['disease_name'] as $key => $val) {?>
				<?php echo '<span style="font-weight:bold;">'.$m.'-</span> '.$val.'<br>';?>
				<?php $m++;}?>
			<?php } else {?>
				No Disease
			<?php }?>
		</td>
	</tr>
	<tr>
        <td width="15%" class="boldText">Test Type</td>
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
		<td width="15%" class="boldText">Required Document</td>
		<td>
			<?php echo $form->checkbox('Test.get_additional_info', array('class'=>'','value'=>'0','onclick'=>'document_check()')); ?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Add Required Documents</td>
		<td>
			<br>
			<select id='documentList' multiple style="width:250px;background:lightgray;padding: 0px;" disabled>
				<?php $count = 0; 
				foreach($doc_list as $key=>$val){
					if($count%2==0)
					{
						$bgcolor='white';
						$color = 'black';
					}
					else
					{
						$bgcolor='#e8e8e8';
						$color = 'black';	
					}
					$docs_list = explode(',',$this->data['Test']['document_list']);
					$selected = "";
					if(in_array($key,$docs_list))
					{
						$selected = "selected";
					}
					echo "<option style='background:".$bgcolor.";color:".$color.";padding: 8px;' ".$selected." id='".$key."'>".$val."</option>";
					$count++;
				} ?>
			</select><br><br>
			<b>Selected Documents</b><br>
			<div id="selecteddocument"><?php echo $doc_html; ?></div>
			<?php echo $form->text('Test.document_list', array('class'=>'class-textarea','style'=>'display:none;')); ?>
			<div id="msg_doc" style="color:#FF0000; font-size:12px;"></div>
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