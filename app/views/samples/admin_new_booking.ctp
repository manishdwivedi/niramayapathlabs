<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Sample Request</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if($usertype != 'Agent') {?>
	<?php echo $html->link('Home', '/admin/samples/index', array('title'=>'Home')); ?> &#187; Add Sample Request
	<?php }?>
	
	<?php echo $form->create(null, array('url'=>'/admin/samples/add_request','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Health.login_type',array('value'=>$LoginType));?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%" id="PatientOtherInfo">
        <!--booking on behalf of other-->
        <?php
            $admin_u_type = $session->read('Admin.userType');
            if(($admin_u_type == 'A') || ($admin_u_type == 'BM'))
            { ?>
            <tr>
                    <td width="15%" class="boldText">Booking on behalf of</td>
                    <td>
                        <select name="data[Health][created_by]" class="input-text">
                            <option value="">Select Center</option>
                            <?php foreach($pcc_list as $key => $val) {?>

                                    <option value="<?php echo $val['Lab']['id'];?>"><?php echo $val['Lab']['pcc_name'];?> <?php //echo nl2br($val['Lab']['pcc_address']);?></option>
                            <?php }?>
                        </select>
                            <br />
                    </td>

            </tr>
        <?php } ?>
	<tr id="InputMemberMrn">
                <td width="15%" class="boldText">Medical Record NO</td>
                <td>
                    <?php echo $form->text('Health.medical_reference_number', array('class'=>'input-text')); ?>
                </td>
	</tr>
	<tr id="InputMemberReference">
                <td width="15%" class="boldText">Reference No.</td>
                <td>
                    <?php echo $form->text('Health.reference', array('class'=>'input-text')); ?>
                </td>

        </tr>
        <tr>
                <td width="15%" class="boldText">Booking on behalf of other user</td>
                <td>
                    <select name="data[Health][created_by_agent]" class="input-text">
                        <option value="">Select User</option>
                        <?php foreach($agents_booked as $key => $val) {?>

                                <option value="<?php echo $key;?>"><?php echo $val;?></option>
                        <?php }?>
                    </select>
                        <br />
                </td>

        </tr>
    <!--end here-->
	<tr id="InputMemberName">
		<td width="15%" class="boldText">Patient Name <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.name', array('class'=>'input-text')); ?>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberGender">
		<td width="15%" class="boldText">Gender of Patient <font color="#FF0000">*</font></td>
		<td>
			<select name="data[Health][gender]" id="HealthGender" class="input-text">
				<option value="">Select Gender</option>
				<option value="1">Male</option>
				<option value="2">Female</option>
			</select>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberAge">
		<td width="15%" class="boldText">Patient Age <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.age', array('class'=>'input-text','style'=>'width:50px;')); ?>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	<tr id="InputMemberContact">
		<td width="15%" class="boldText">Contact Number <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.landline', array('class'=>'input-text')); ?>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberEmail">
		<td width="15%" class="boldText">Email ID</td>
		<td>
			<?php echo $form->text('Health.email', array('class'=>'input-text')); ?>
			<!--<div id="msg6" style="color:#FF0000; font-size:12px;"></div>-->
		</td>
	</tr>
	<tr id="InputMemberAddress1">
		<td width="15%" class="boldText">Address <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.address1', array('class'=>'input-text')); ?>
		</td>
	</tr>
	<tr id="InputMemberAddress2">
		<td width="15%" class="boldText">&nbsp;</td>
		<td>
			<?php echo $form->text('Health.address2', array('class'=>'input-text')); ?>
			<div id="msg7" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberLocality">
		<td width="15%" class="boldText">Locality <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.locality', array('class'=>'input-text')); ?>
			<div id="msg8" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberCity">
		<td width="15%" class="boldText">City <font color="#FF0000">*</font></td>
		<td>
			<select name="data[Health][city_id]" id="HealthCityId" class="input-text">
				<option value="">Select City</option>
				<?php foreach($city as $key => $val) {?>
				<option value="<?php echo $val['City']['id'];?>"><?php echo $val['City']['name'];?></option>
				<?php }?>
			</select>
			<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberState">
		<td width="15%" class="boldText">State <font color="#FF0000">*</font></td>
		<td>
			<select name="data[Health][state]" id="HealthState" class="input-text">
				<option value="">Select State</option>
				<?php foreach($state as $key => $val) {?>
				<option value="<?php echo $val['State']['id'];?>"><?php echo $val['State']['name'];?></option>
				<?php }?>
			</select>
			<div id="msg10" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberPincode">
		<td width="15%" class="boldText">Pincode <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.pincode', array('class'=>'input-text')); ?>
			<div id="msg11" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberLandmark">
		<td width="15%" class="boldText">Landmark <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.landmark', array('class'=>'input-text')); ?>
			<div id="msg12" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<!--<tr id="VitalHeadInfo">
		<td colspan="2" style="font-weight:bold; text-decoration:underline; background-color:#999999; color:#FFFFFF; text-align:center;">Patient Vitals Monitoring BP & BMI</td>
	</tr>
	<!--Code For Inserting BMI value Starts-->
	<!--<tr id="PatWeight">
		<td width="15%" class="boldText">Patient Weight(KG)</td>
		<td>
			<?php //echo $form->text('Health.pat_weight', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'Weight in KG')); ?>
		</td>
	</tr>
	<tr id="PatHeightOpt">
		<td width="15%" class="boldText">Height Option</td>
		<td>
			<input type="radio" name="data[Health][select_bmi_opt]" value="1" onclick="show_option(1);" />&nbsp;Feet&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[Health][select_bmi_opt]" value="2" onclick="show_option(2);" />&nbsp;CMs
		</td>
	</tr>
	<tr id="PatHeightCm" style="display:none;">
		<td width="15%" class="boldText">Patient Height(CM's)</td>
		<td>
			<?php //echo $form->text('Health.pat_height_cms', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'CM')); ?>
		</td>
	</tr>
	<tr id="PatHeight" style="display:none;">
		<td width="15%" class="boldText">Patient Height(Feet & Inch)</td>
		<td>
			<?php //echo $form->text('Health.pat_height_feet', array('class'=>'input-text','style'=>'width:75px;','placeholder'=>'Feet')); ?>
			<?php //echo $form->text('Health.pat_height_inch', array('class'=>'input-text','style'=>'width:75px;','placeholder'=>'Inch')); ?>
		</td>
	</tr>
	<tr id="PatBPSystolic">
		<td width="15%" class="boldText">Blood Pressure</td>
		<td>
			<?php //echo $form->text('Health.pat_systolic', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'SYS in (mmHg)')); ?>
			<?php //echo $form->text('Health.pat_diaostolic', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'DIA in (mmHg)')); ?>
			<?php //echo $form->text('Health.pat_pulse_rate', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'Pulse/Min')); ?>
		</td>
	</tr>
	<tr id="PatientBpDate">
		<td width="15%" class="boldText">Enter Date</td>
		<td><?php //echo $form->text('Health.vital_time', array('class'=>'input-text datepicker2','style'=>'width:100px;')); ?>
		<div id="msg156" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="PatBPTime">
		<td width="15%" class="boldText">Enter Time</td>
		<td>
			<select name="data[Health][pat_bp_time_hr]" class="input-text" style="width:75px;">
				<option value="">Hr</option>
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
			</select>
			<select name="data[Health][pat_bp_time_sec]" class="input-text" style="width:75px;">
				<option value="">Sec</option>
				<?php for($i=1;$i<=60;$i++){?>
				<?php if($i<=9){?>
				<option value="<?php echo '0'.$i;?>"><?php echo '0'.$i;?></option>
				<?php } else {?>
				<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }?>
				<?php }?>
			</select>
		</td>
	</tr>
	
	-->
	<!--Code For Inserting BMI value Ends-->
	<tr>
		<td colspan="2" style="font-weight:bold; text-decoration:underline; background-color:#999999; color:#FFFFFF; text-align:center;">Tests Informations</td>
	</tr>
	<tr id="TestIds" style="display:none;"></tr>
	<tr id="ProfileIds" style="display:none;"></tr>
	<tr id="OfferIds" style="display:none;"></tr>
	<tr id="PackageIds" style="display:none;"></tr>
	<tr id="ServiceIds" style="display:none;"></tr>
	<tr style="display:none;" id="t_f_a_t_p_o_r">
		<td width="15%" class="boldText">Total Amount</td>
		<td id="t_f_a_t_p_o"></td>
	</tr>
	<tr id="SubTotal" style="display:none;"></tr>
	<tr id="TestCount" style="display:none;">0</tr>
	<tr id="ClickTestNew"></tr>
	<tr id="ClickTest">
		<td width="15%" class="boldText" id="ChangeTestHeading">Test(s)</td>
		<td>
			<div style="float:left;">
				<div style="float:left;"><?php echo $form->text('Health.search_test',array('class'=>'input-text','placeholder'=>'Search Test'));?></div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-1" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>
	<tr id="ProfileCount" style="display:none;">0</tr>
	<tr id="ClickProfileNew"></tr>
	<tr id="ClickProfile">
		<td width="15%" class="boldText" id="ChangeProfileHeading">Profile(s)</td>
		<td>
			<div style="float:left;">
				<div style="float:left;"><?php echo $form->text('Health.search_profile',array('class'=>'input-text','placeholder'=>'Search Profile'));?></div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-2" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>
	<tr id="OfferCount" style="display:none;">0</tr>
	<tr id="ClickOfferNew"></tr>
	
	<!-- enbale  Special Offer by ravin  -->
	<tr id="ClickOffer">
		<td width="15%" class="boldText" id="ChangeOfferHeading">Special Offer(s)</td>
		<td>
			<div style="float:left;">
				<div style="float:left;"><?php echo $form->text('Health.search_offer',array('class'=>'input-text','placeholder'=>'Search Special Offer'));?></div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-3" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>
	<tr id="PackageCount" style="display:none;">0</tr>
	<tr id="ClickPackageNew"></tr>
	<tr id="ClickPackage">
		<td width="15%" class="boldText" id="ChangePackageHeading">Niramaya Package(s)</td>
		<td>
			<div style="float:left;">
				<div style="float:left;"><?php echo $form->text('Health.search_package',array('class'=>'input-text','placeholder'=>'Search Niramaya Package'));?></div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-4" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>
	<tr id="ServiceCount" style="display:none;">0</tr>
	<tr id="ClickServiceNew"></tr>
	<tr id="ClickService">
		<td width="15%" class="boldText" id="ChangeServiceHeading">Patient Care Services</td>
		<td>
			<div style="float:left;">
				<div style="float:left;"><?php echo $form->text('Health.search_service',array('class'=>'input-text','placeholder'=>'Search Patient Care Services'));?></div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-5" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Discount Code</td>
		<td>
			<?php echo $form->text('Health.discount', array('class'=>'input-text','style'=>'width:100px;')); ?><br />
			<!--<strong>1)</strong> <span style="color:#0066FF;">60PLUS</span> <strong>-</strong> Senior Citizen Discount (10%)<br /> 
			<strong>2)</strong> <span style="color:#0066FF;">NHCARD</span> <strong>-</strong> nirAmaya Healthcare Card Discount (10%)<br /> 
			<strong>3)</strong> <span style="color:#0066FF;">ADP159</span> <strong>-</strong> Additional Basic Health Check-up Discount (Rs.299)<br /> 
			<strong>4)</strong> <span style="color:#0066FF;">ADP160</span> <strong>-</strong> Additional Whole-body Health Check-up Discount (Rs.419)<br /> 
			<strong>5)</strong> <span style="color:#0066FF;">ADP161</span> <strong>-</strong> Additional Executive Health Check-up Discount (Rs.749)<br /> 
			<strong>6)</strong> <span style="color:#0066FF;">10CORP</span> <strong>-</strong> Corporate Discount (10%)<br /> 
			<strong>7)</strong> <span style="color:#0066FF;">15CORP</span> <strong>-</strong> Corporate Discount (15%)<br /> 
			<strong>8)</strong> <span style="color:#0066FF;">GovEmp</span> <strong>-</strong> Government Employee Discount (10%)<br /> 
			<strong>9)</strong> <span style="color:#0066FF;">EmpNhc</span> <strong>-</strong> nirAmaya Healthcare  Employee Discount (30%)<br /> 
			<strong>10)</strong> <span style="color:#0066FF;">NhcCSR</span> <strong>-</strong> Corporate Social Responsibility Discount (25%)<br /> 
			<strong>11)</strong> <span style="color:#0066FF;">ereport</span> <strong>-</strong> eReporting discount (2%)<br />  
			<strong>12)</strong> <span style="color:#0066FF;">Comp100</span> <strong>-</strong> Complementary Discount (100%)-->
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Discount Amount</td>
		<td>
			<?php echo $form->text('Health.discount_amount', array('class'=>'input-text','style'=>'width:100px;','value'=>'0')); ?>
		</td>
	</tr>
	<tr>
		<td class="boldText">Discount Reason/Remark <font color="#FF0000">*</font><!-- <br />(Only filled when Discount Amount Given otherwise leave blank)--></td>
		<td>
			<?php echo $form->textarea('Health.discount_amount_reason', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
			<div id="msg155" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<!new changes-->
	<!--<tr>
		<td width="15%" class="boldText">Sent Report at Home</td>
		<td>
			<input type="radio" name="data[Health][home_report]" value="1" />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[Health][home_report]" value="0" />&nbsp;&nbsp;No
		</td>
	</tr>-->
        <!-- end -->
	<tr>
		<td width="15%" class="boldText">Referred By</td>
		<td>
			<?php echo $form->text('Health.remark', array('class'=>'input-text')); ?>
		</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Sample Collect Status</td>
		<td>
			<!--<input type="radio" name="opt" id="visit" value="1" onclick="show_lab(this.value);" />Visit a Lab<br />-->
			<input type="radio" name="opt" id="home" value="2" onclick="show_lab(this.value);" />Home Collection<br />
		</td>
	</tr>
	<tr id="visit_lab_1" style="display:none;">
		<td width="15%" class="boldText">Select Center</td>
		<td>
                    <select name="data[Health][city]" id="HealthCityLab1" class="input-text">
                        <option value="">Select Center</option>
			<?php foreach($pcc_list as $key => $val) {?>
				<!--<input type="radio" name="data[Health][city]" id="HealthCityLab1" value="<?php echo $val['Lab']['id'];?>" /> <strong><?php echo $val['Lab']['pcc_name'];?></strong><br />
				<span style="margin:0px 0px 0px 24px;"><?php echo nl2br($val['Lab']['pcc_address']);?></span><br />
                                -->
                                <option value="<?php echo $val['Lab']['id'];?>"><?php echo $val['Lab']['pcc_name'];?> <?php //echo nl2br($val['Lab']['pcc_address']);?></option>
			<?php }?>
                    </select>
			<br />
		</td>
			
	</tr>
	<tr id="visit_lab_2" style="display:none;">
		<td width="15%" class="boldText">Time</td>
		<td>
			<select name="data[Health][sample_time]" id="HealthSampleTime" class="input-text">
				<option value="">Select Time</option>
				<?php foreach($timelabs as $key => $val) {?>
				<option value="<?php echo $val['Timelab']['id'];?>"><?php echo $val['Timelab']['name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr id="visit_lab_3" style="display:none;">
		<td width="15%" class="boldText">Sample Collect Date</td>
		<td>
			<?php echo $form->text('Health.sample_date', array('class'=>'input-text datepicker2','style'=>'width:100px;')); ?>
		</td>
	</tr>
	
	
	<tr id="home_collection_1" style="display:none;">
		<td width="15%" class="boldText">&nbsp;</td>
		<td>Please select a date and time for Collection of Sample. Our representative will come to the address mention above.</td>
	</tr>
	<tr id="home_collection_2" style="display:none;">
		<td width="15%" class="boldText">Time</td>
		<td>
			<select name="data[Health][sample_time1]" id="HealthSampleTime1" class="input-text">
				<option value="">Select Time</option>
				<?php foreach($timelabs as $key => $val) {?>
				<option value="<?php echo $val['Timelab']['id'];?>"><?php echo $val['Timelab']['name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr id="home_collection_3" style="display:none;">
		<td width="15%" class="boldText">Sample Collect Date</td>
		<td>
			<?php echo $form->text('Health.sample_date1', array('class'=>'input-text datepicker','style'=>'width:100px;')); ?>
		</td>
	</tr>
	
	<tr id="add_line1" style="display:none;"></tr>
	<tr id="add_line2" style="display:none;"></tr>
	<tr id="locality" style="display:none;"></tr>
	<tr id="city" style="display:none;"></tr>
	<tr id="state" style="display:none;"></tr>
	<tr id="pincode" style="display:none;"></tr>
	<tr id="landmark" style="display:none;"></tr>
	
	<tr id="home_collection_4" style="display:none;">
		<td>&nbsp;</td>
		<td><a href="javascript:void(0);" onclick="show_upper_add();">Same as Above Address</a> | <a href="javascript:void(0);" onclick="new_add();">New Address</a></td>
	</tr>

	<tr id="submit_div" style="display:none;">
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
			<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
		</td>
	</tr>	



</table>
<?php echo $form->end(); ?>
</div>
