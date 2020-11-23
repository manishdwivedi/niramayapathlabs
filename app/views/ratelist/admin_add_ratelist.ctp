<script language="JavaScript" type="text/javascript">
$(function(){
	$(".observation").keyup(function() 
	{ 
		var pccratelist = $('#BbEstimatePkgRateList').val();
		var TestTestParameter = $(this).val();
		var dataString = 'search='+ TestTestParameter+'&ratelist='+pccratelist;
		console.log(TestTestParameter);
		if(TestTestParameter!='')
		{
			$.ajax({
			type: "POST",
			url: siteUrl+"ratelist/searchtest",
			data: dataString,
			cache: false,
			success: function(html)
			{
				//console.log(html);
				$("#testList").html(html).show();
			}
			});
		}
		return false;    
	});

	$('#BbEstimatePkgRateList').change(function(){
		var value = $(this).val();
		getratelistdata(value);
	});

	$('#testList').change(function(){ 
		var value = $(this).val();
		
		var pccratelist = $('#BbEstimatePkgRateList').val();
		var sel_test = $('#BbEstimateTestId').val();
		var datastring = 'id='+value+'&testlist='+sel_test+'&ratelist='+pccratelist;
		
		$.ajax({
			type: "POST",
			url: siteUrl+"ratelist/gettest",
			data: datastring,
			cache: false,
			success: function(html)
			{
				if(html=='failure')
				{
					$('#msg10').show();
					$('#msg10').html("Selected Test Already Included in Package.");
				}
				else
				{
					//console.log(html);
					$('#msg10').hide();
					var data = html.split('@@@@@');

					$("#selectedtest").html(data[0]).show();
					$('#BbEstimateTestId').val(data[2]);		
					$('#BbEstimateTestCost').val(data[1]);
					$('#BbEstimateOtherCost').val(0);
					$('#BbEstimateDiscountAmount').val(0);
					$('#BbEstimateTotalCost').val(data[1]);
					$('#BbEstimateMainFinalCost').val(data[1]);
					$('#BbEstimateProjectedMrp').val(data[3]);
					
					var rate_id = $('#BbEstimatePkgRateList').val();
					if(rate_id!='')
					{
						getratelistdata(rate_id);
					}
				}
			}
		});
	});
	
	$('#booked_by').change(function(){
		var value = $(this).val();
		$.ajax({
			type: "POST",
			url: siteUrl+"ratelist/getratelist",
			data: { id : value },
			cache: false,
			success: function(html)
			{
				//console.log(html);
				$('#pkg_rate_list').val(html);
				$('#BbEstimatePkgRateList').val(html);
			}
		});
	});


});

function getratelistdata(id)
{
	var sel_test = $('#BbEstimateTestId').val();
	var datastring = 'id='+id+'&testlist='+sel_test;
	
	$.ajax({
		type: "POST",
		url: siteUrl+"ratelist/gettestrate",
		data: datastring,
		cache: false,
		success: function(html)
		{
			//console.log(html);
			$('#BbEstimateTestCost').val(html);
			$('#BbEstimateOtherCost').val(0);
			$('#BbEstimateDiscountAmount').val(0);
			$('#BbEstimateTotalCost').val(html);
			$('#BbEstimateMainFinalCost').val(html);
		}
	});
}

function delete_obs(id)
{
	var testobser = $('#BbEstimateTestId').val();
	var obsid = testobser.split(',');
	//console.log(obsid);
	obsid.splice($.inArray(id.toString(), obsid),1);
	$('#test'+id).remove();
	var newobs = obsid.join(',');
	//console.log(newobs);
	$('#BbEstimateTestId').val(newobs);
	
	value="";
	var pccratelist = $('#BbEstimatePkgRateList').val();
	var datastring = 'id='+value+'&testlist='+newobs+'&ratelist='+pccratelist;
	
	$.ajax({
		type: "POST",
		url: siteUrl+"ratelist/gettest",
		data: datastring,
		cache: false,
		success: function(html)
		{
			if(html=='failure')
			{
				$('#msg10').show();
				$('#msg10').html("Selected Test Already Included in Package.");
			}
			else
			{
				//console.log(html);
				$('#msg10').hide();
				var data = html.split('@@@@@');

				$("#selectedtest").html(data[0]).show();
				$('#BbEstimateTestId').val(data[2]);		
				$('#BbEstimateTestCost').val(data[1]);
				$('#BbEstimateTotalCost').val(data[1]);
				$('#BbEstimateMainFinalCost').val(data[1]);
				$('#BbEstimateOtherCost').val(0);
				$('#BbEstimateDiscountAmount').val(0);
				
				var rate_id = $('#BbEstimatePkgRateList').val();
				if(rate_id!='')
				{
					getratelistdata(rate_id);
				}
			}
		}
	});
}

function add_cost(e)
{
	var id = e.id;
	var prefix = '';
	if(id.includes("BbEstimate"))
	{
		prefix="BbEstimate";
	}
	var discount = $('#'+prefix+'DiscountAmount').val();
	if(discount==0 || discount=='')
	{
		discount = 0;
	}
	var test_cost = $('#'+prefix+'TestCost').val();
	var cost = $('#'+e.id).val();
	var total_cost = Number(test_cost)+Number(cost);
	$('#'+prefix+'TotalCost').val(total_cost);
	$('#'+prefix+'MainFinalCost').val(total_cost - Number(discount));
}

function dis_cost(e)
{
	var id = e.id;
	var prefix = '';
	if(id.includes("BbEstimate"))
	{
		prefix="BbEstimate";
	}
	var test_cost = $('#'+prefix+'TotalCost').val();
	var cost = $('#'+e.id).val();
	var final_cost = Number(test_cost)-Number(cost)
	$('#'+prefix+'MainFinalCost').val(final_cost);
}

function checknum(evt)
{
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
}
</script>
<div class="contentcontainer">
	<div class="headings altheading">
        <h2>Create Package Estimate</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if($usertype != 'Agent') {?>
	<?php echo $html->link('Home', '/admin/ratelist/add_ratelist', array('title'=>'Home')); ?> &#187; Create Package Estimate
	<?php }?>
	
	<?php echo $form->create(null, array('url'=>'/admin/ratelist/add_ratelist','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Health.login_type',array('value'=>$LoginType));?>
	<?php echo $form->hidden('lab_id',array('value'=>$selected_lab));?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		<tr>
			<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Booked By<font color="#FF0000">*</font></td>
			<td>
				<select name="data[BbEstimate][booked_by]" id="booked_by" class="input-text" <?php if(isset($selected_lab)) { echo "disabled"; } ?>>
					<option>Select Lab</option>
					<?php foreach($lab_list as $key => $val) {?>
					<option value="<?php echo $key;?>" <?php if($selected_lab==$key) { echo "selected"; } ?>><?php echo $val;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('BbEstimate.name', array('class'=>'input-text','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Contact<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('BbEstimate.contact', array('class'=>'input-text','maxlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Alternate Contact<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('BbEstimate.alternate_contact', array('class'=>'input-text','maxlength'=>'10','onkeypress'=>'return checknum(event)')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Email<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('BbEstimate.email', array('class'=>'input-text','required'=>'required','type'=>'email')); ?>
			</td>
		</tr>
		<tr>
			<td colspan="3"><hr></td>
		</tr>
		<tr>
			<td colspan="3"><h3>Package Details</h3></td>
		</tr>
		<tr>
			<td colspan="3"><hr></td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Package Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('BbEstimate.pkg_name', array('class'=>'input-text','required'=>'required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Package Code<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('BbEstimate.pkg_code', array('class'=>'input-text','required'=>'required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Min Guaranteed Tests<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('BbEstimate.min_gtd', array('class'=>'input-text')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Remarks<font color="#FF0000">*</font></td>
			<td>
				<textarea name="data[BbEstimate][remarks]" style="height: 100px;" class="input-text"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="3"><hr></td>
		</tr>
		<tr>
			<td colspan="3"><h3>Add Tests</h3></td>
		</tr>
		<tr>
			<td colspan="3"><hr></td>
		</tr>
		<tr>
			<td width="15%" class="boldText"><span class="error">*</span>Add Tests</td>
			<td>
				<?php echo $form->text('Test.tests', array('class'=>'input-text observation')); ?><!--<span class="hint-class">(EX- (T - Cell / B - Cell Subset) Marker : CD 5)</span>-->
				<br>
				<select id='testList' multiple style="width:323px;margin-top: 20px;"></select><br><br>
				<div id="msg10" style="color:#FF0000; font-size:15px;margin-bottom: 10px;"></div>
				<b style="font-size:15px;">Selected Tests</b><br>
				<div id="selectedtest" style="margin-top: 10px;"></div>
				<br>
				<?php echo $form->text('BbEstimate.test_id', array('class'=>'class-textarea','style'=>'display:none;')); ?>
			</td>
		</tr>
		
		<tr>
			<td colspan="3"><hr></td>
		</tr>
		<tr>
			<td colspan="3"><h3>Package Pricing</h3></td>
		</tr>
		<tr>
			<td colspan="3"><hr></td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Rate List<font color="#FF0000">*</font></td>
			<td>
				<select id="BbEstimatePkgRateList" class="input-text"  disabled >
					<option>Select Rate List</option>
					<?php foreach($ratelist as $key => $val) {?>
					<option value="<?php echo $key;?>" <?php if($lab_ratelist==$key) { echo "selected"; } ?>><?php echo $val;?></option>
					<?php }?>
				</select>
			</td>
			<!--<td>
				<select name="default_ratelist" id="AgentRole" class="input-text"  required readonly>
					<option>Default Rate List</option>
					<?php foreach($ratelist as $key => $val) {?>
					<option value="<?php echo $key;?>"><?php echo $val;?></option>
					<?php }?>
				</select>
			</td>-->
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Package Cost<font color="#FF0000">*</font></td>
			<!--<td>
				<input name="test_cost" id="TestCost" class="input-text" disabled/>
 			</td>-->
			<td>
				<input name="data[BbEstimate][test_cost]" type="text" class="input-text" required id="BbEstimateTestCost"/>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Other Cost<font color="#FF0000">*</font></td>
			<!--<td>
				<input name="other_cost" id="OtherCost" class="input-text" value="0" onkeyup="add_cost(this);"/>
			</td>-->
			<td>
				<input name="data[BbEstimate][other_cost]" type="text" class="input-text" onkeyup="add_cost(this);" id="BbEstimateOtherCost"/>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Other Cost Remark<font color="#FF0000">*</font></td>
			<td>
				<textarea name="data[BbEstimate][other_cost_remark]" style="height: 100px;" class="input-text"></textarea>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Total Cost<font color="#FF0000">*</font></td>
			<!--<td>
				<input name="total_cost" id="TotalCost" class="input-text" required/>
			</td>-->
			<td>
				<input name="data[BbEstimate][total_cost]" type="text" class="input-text" id="BbEstimateTotalCost" readonly/>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Discount Amount</td>
			<!--<td>
				<input name="discount_amount" id="DiscountAmount" class="input-text" value="0" onkeyup="dis_cost(this);"/>
			</td>-->
			<td>
				<input name="data[BbEstimate][discount_amount]" type="text"  class="input-text" onkeyup="dis_cost(this);" id="BbEstimateDiscountAmount"/>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Discount Remark<font color="#FF0000">*</font></td>
			<td>
				<textarea name="data[BbEstimate][discount_remark]" style="height: 100px;" class="input-text"></textarea>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Final Cost<font color="#FF0000">*</font></td>
			<!--<td>
				<input name="main_final_cost" id="MainFinalCost" class="input-text" disabled/>
			</td>-->
			<td>
				<input name="data[BbEstimate][final_cost]" type="text" class="input-text" id="BbEstimateMainFinalCost"/>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Projected MRP<font color="#FF0000">*</font></td>
			<td>
				<input name="data[BbEstimate][projected_mrp]" type="text" class="input-text" id="BbEstimateProjectedMrp"/>
			</td>
		</tr>
		<tr>
			<td><input type="hidden" name="data[BbEstimate][pkg_rate_list]" id="pkg_rate_list" value="<?php if(isset($lab_ratelist)) echo $lab_ratelist; ?>"></td>
		</tr>
		<tr>
			<tr>
				<td><?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?></td>
			</tr>
		</tr>
	<?php echo $form->end(); ?>
</div>

<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>