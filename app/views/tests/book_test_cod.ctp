<script type="text/javascript">
function BillingForm()
{
	var str=true;
	document.getElementById("BillingError1").innerHTML="";
	
	document.getElementById("BillingError4").innerHTML="";
	document.getElementById("BillingError5").innerHTML="";
	document.getElementById("BillingError6").innerHTML="";
	document.getElementById("BillingError7").innerHTML="";
	document.getElementById("BillingError8").innerHTML="";
	document.getElementById("BillingError9").innerHTML="";
	document.getElementById("BillingError10").innerHTML="";
	
	if(document.formBilling.BillingFirstName.value=='')
	{
		document.getElementById("BillingError1").innerHTML="Please Enter First Name";
		str=false;
	}
	if(isNaN(document.formBilling.BillingContact.value))
	{
		document.getElementById("BillingError4").innerHTML="Please Enter 10 Digit Mobile Number";
		str = false;
	}
	else if(document.formBilling.BillingContact.value.length<10)
	{
		document.getElementById("BillingError4").innerHTML="Please Enter 10 Digit Mobile Number";
		str = false;
	}
	if(document.formBilling.BillingAddress1.value=='')
	{
		document.getElementById("BillingError5").innerHTML="Please Enter Address";
		str=false;
	}
	if(document.formBilling.BillingCity.value=='')
	{
		document.getElementById("BillingError6").innerHTML="Please Enter City";
		str=false;
	}
	if(document.formBilling.BillingState.value=='')
	{
		document.getElementById("BillingError7").innerHTML="Please Enter State";
		str=false;
	}
	if(document.formBilling.BillingZip.value=='')
	{
		document.getElementById("BillingError8").innerHTML="Please Enter Zip Code";
		str=false;
	}
	if(document.formBilling.BillingLandmark.value=='')
	{
		document.getElementById("BillingError9").innerHTML="Please Enter Landmark";
		str=false;
	}
	if(document.formBilling.BillingLocality.value=='')
	{
		document.getElementById("BillingError10").innerHTML="Please Enter Locality";
		str=false;
	}
	return str;
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
          <div class="bread"><?php echo $this->Html->link('Billing Information','javascript:void(0);');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
      <h1>My <span class="green">Account</span></h1>
    <div class="subHeading">
    <h2>Billing Information</h2>
    <ul>
    <li><?php echo $html->link('Personal Details',array('controller'=>'tests','action'=>'personal_detail'));?></li>
    <li><?php echo $html->link('My Requests',array('controller'=>'tests','action'=>'my_request'));?></li>
    <li><?php echo $html->link('My Reports',array('controller'=>'tests','action'=>'my_report'));?></li>
	<li><?php echo $html->link('Payment History',array('controller'=>'tests','action'=>'payment_history'));?></li>
    <li class="borderNone padRightNone"><?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab("loggedout");'));?></li>
    </ul>
    
    
    
    </div>
	  <?php echo $form->create('BillingInfo',array('url'=>'/tests/book_test_cod','id'=>'formBilling','name'=>'formBilling','onsubmit'=>'return BillingForm(this);'));?>
	  <?php echo $form->hidden('Billing.user_id',array('value'=>$member_detail['User']['id']));?>
	  <?php echo $form->hidden('Billing.test_id',array('value'=>$test_id));?>
	  <?php echo $form->hidden('Billing.profile_id',array('value'=>$profile_id));?>
	  <?php echo $form->hidden('Billing.offer_id',array('value'=>$offer_id));?>
	   <?php echo $form->hidden('Billing.package_id',array('value'=>$package_id));?>
	  <?php echo $form->hidden('Billing.sub_total',array('value'=>$total_cost));?>
	  <?php echo $form->hidden('Billing.b_total_amt',array('value'=>$b_total_amt));?>
	  <?php echo $form->hidden('Billing.b_req_id',array('value'=>$b_req_id));?>
      <div class="formDiv">
	  <?php if(empty($mess_succ)) {?>
	  <div style="color:red;">Fields in * are mandatory fields</div>
	  <?php }?>
	  <?php if(!empty($mess_succ)) {?>
	  <div style="color:green;"><?php echo $mess_succ;?></div>
	  <?php }?>
	  
	  	<div class="row">
	  		<label>Full Name <font color="#FF0000">*</font></label>
			<div class="dot">:</div>
			<?php echo $form->text('Billing.first_name',array('placeholder'=>'Please Enter First Name','value'=>$member_detail['User']['name']));?>
			<div id="BillingError1" style="color:#FF0000; font-size:11px; float:left; margin:3px 0 0 138px;"></div>
		</div>
	  	<div class="row">
			<label>Mobile <font color="#FF0000">*</font></label>
			<div class="dot">:</div>
			<?php echo $form->text('Billing.contact',array('placeholder'=>'Please Enter Mobile Number','value'=>$member_detail['User']['contact']));?>
			<div id="BillingError4" style="color:#FF0000; font-size:11px; float:left; margin:3px 0 0 138px;"></div>
		</div>
		<?php $explode_add = explode('*',$member_detail['User']['address']);?>
      	<div class="row">
			<label>Address <font color="#FF0000">*</font></label>
			<div class="dot">:</div>
			<?php echo $form->text('Billing.address1',array('placeholder'=>'Please Enter Address','value'=>$explode_add[0]));?>
		</div>
		<div class="row">
			<label>&nbsp;</label>
			<div class="dot">:</div>
			<?php echo $form->text('Billing.address2',array('placeholder'=>'Please Enter Address','value'=>$explode_add[1]));?>
			<div id="BillingError5" style="color:#FF0000; font-size:11px; float:left; margin:3px 0 0 138px;"></div>
		</div>
		<div class="row">
			<label>Locality</label>
			<div class="dot">:</div>
			<?php echo $form->text('Billing.locality',array('placeholder'=>'Please Enter Locality','value'=>$member_detail['User']['locality']));?>
			<div id="BillingError10" style="color:#FF0000; font-size:11px; float:left; margin:3px 0 0 138px;"></div>
		</div>
      	<div class="row">
			<label>City <font color="#FF0000">*</font></label>
			<div class="dot">:</div>
			<select name="data[Billing][city]" id="BillingCity" style="border: 1px solid #D9D9D9; border-radius: 3px 3px 3px 3px; color: #666666; float: left; font: 11px arial; height: 25px; padding: 3px; width: 257px;">
				<option value="">Please select city</option>
				<?php foreach($city as $key=>$val) {?>
				<option value="<?php echo $val['City']['id'];?>" <?php if($val['City']['id'] == $member_detail['User']['city']) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
				<?php }?>
			</select>
			<div id="BillingError6" style="color:#FF0000; font-size:11px; float:left; margin:3px 0 0 138px;"></div>
		</div>
      	<div class="row">
			<label>State <font color="#FF0000">*</font></label>
			<div class="dot">:</div>
			<select name="data[Billing][state]" id="BillingState" style="border: 1px solid #D9D9D9; border-radius: 3px 3px 3px 3px; color: #666666; float: left; font: 11px arial; height: 25px; padding: 3px; width: 257px;">
				<option value="">Please select state</option>
				<?php foreach($state as $key=>$val) {?>
				<option value="<?php echo $val['State']['id'];?>" <?php if($val['State']['id'] == $member_detail['User']['state']) {?> selected="selected" <?php }?>><?php echo $val['State']['name'];?></option>
				<?php }?>
			</select>
			<div id="BillingError7" style="color:#FF0000; font-size:11px; float:left; margin:3px 0 0 138px;"></div>
		</div>
		<div class="row">
			<label>Zip/Postal Code <font color="#FF0000">*</font></label>
			<div class="dot">:</div>
			<?php echo $form->text('Billing.zip',array('placeholder'=>'Please Enter Zip Code','value'=>$member_detail['User']['pincode']));?>
			<div id="BillingError8" style="color:#FF0000; font-size:11px; float:left; margin:3px 0 0 138px;"></div>
		</div>
		<div class="row">
			<label>Landmark <font color="#FF0000">*</font></label>
			<div class="dot">:</div>
			<?php echo $form->text('Billing.landmark',array('placeholder'=>'Please Enter Landmark','value'=>$member_detail['User']['landmark']));?>
			<div id="BillingError9" style="color:#FF0000; font-size:11px; float:left; margin:3px 0 0 138px;"></div>
		</div>
		
      
      
      
	  <div style="clear:both;">
      <input type="image" src="<?php echo SITE_URL;?>img/frontend/submit-button.gif" alt="Submit" style="float:right; margin:15px 0 0;" />
	  </div>
	  </div>
	  <?php echo $form->end();?>
	  <div style="float:left; padding:15px 0 0 30px;">
	  	<div style="text-align:center; width:565px; font-weight:bold; font-size:16px;">Booked Request Summary</div>
		<div style="float:left; padding:15px 0 0 0; width:565px;">
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;">Patient Name</td>
					<td style="border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $pat_name;?></td>
				</tr>
				<?php if($collectType == 'Visit a Lab') {?>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Request Type</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collectType;?></td>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Lab Centre</td>
					<?php if($labType == 'Crossing Republic') {?>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;">
						Shop No. 08, LGF, Crossing Plaza,<br />
						Crossing Republic, Ghaziabad
					</td>
					<?php }?>
					<?php if($labType == 'Indirapuram') {?>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;">
						Shop No. 05 & 06, Lotus Plaza, Vaibahv Khand,<br />
						Indirapuram, Ghaziabad
					</td>
					<?php }?>
					<?php if($labType == 'Noida') {?>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;">
						Sector -31, Next to IMA House & Blood Bank,<br />
						Noida
					</td>
					<?php }?>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Visit Time</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $visit_time;?></td>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Visit Date</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $visit_date;?></td>
				</tr>
				<?php }?>
				<?php if($collectType == 'Home Collection') {?>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Request Type</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collectType;?></td>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Sample Collect Time</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_time;?></td>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Sample Collect Date</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_date;?></td>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Sample Collect Address</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo str_replace('*',' ',$collect_address);?></td>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Locality</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_locality;?></td>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">City</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_city;?></td>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">State</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_state;?></td>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Pincode</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_pincode;?></td>
				</tr>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Landmark</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_landmark;?></td>
				</tr>
				<?php }?>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Total Amount</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo 'Rs. '.$total_cost;?></td>
				</tr>
				<?php if(!empty($test_names)) {?>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Test(s)</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $test_names;?></td>
				</tr>
				<?php }?>
				<?php if(!empty($profiles_names)) {?>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Profile(s)</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $profiles_names;?></td>
				</tr>
				<?php }?>
				<?php if(!empty($offers_names)) {?>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Offer(s)</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $offers_names;?></td>
				</tr>
				<?php }?>
				<?php if(!empty($package_name)) {?>
				<tr>
					<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Package(s)</td>
					<td style="border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $package_name;?></td>
				</tr>
				<?php }?>
			</table>
		</div>
	  </div>
  </div>