 <div class="article_in_inner">
    <div class="article_in">
      <section class="diseaseBox finalspace">
        <div class="enquery">
          <div class="graynavigation gap">
             <ul>
               <li><a href="#"><span>Home</span></a></li>
               <li><a href="#" ><span>Test</span></a></li>
               <li class="list"> <h1><?php echo $dataView['Test']['test_parameter']; ?></h1></li>
             </ul>

          </div>
        </div>
      </section>
    </div>
  </div>
  <div id="MainContent_divsepLine2" class="centring AllergyScreen">
    <div class="blankBox2" id="TEstCityMobile2">
      <div class="AvailableDiv">
        <div class="bbAccordion" data-accordion-group="group1">
          <div class="accordion-head2">
            <div class="testTabNewDIV">
              <div class="testTabNew">
                <ul class="tab">
                  <li><a href="javascript:void(0)" class="tablinks active" onclick="openCity(event, 'Delhi')" id="defaultOpen">Test Information</a></li>
                  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Noida')">Detailed Test Information</a></li>
				  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Gurgaon')">Know Your Test</a></li>
                </ul>
                <div class="clr"></div>
                <div class="shedowTest">

                  <div class="swasthPlus">
                    <div class="left"><?php echo $dataView['Test']['test_parameter']." - ".$dataView['Test']['testcode']; ?></div>
                    <div class="right">Rs <?php echo $dataView['Test']['mrp']; ?></div>
                  </div>

                  <div id="Delhi" class="tabcontent">
                    <div class="swasthLeft">
                      <div class="clr"></div>
                       <div class="shouldBox">
                            <div class="divSOne">
                              <ul>
								<?php if($testDetails['final_check']==1){ ?>
									<li><strong>Why Get Tested?</strong><br/> <?php echo $testDetails['why_to']; ?></li>
									<li><strong>When To Get Tested?</strong><br> <?php echo $testDetails['when_to']; ?></li>
								<?php } ?>
								<li><div class="textB">Sample Type:</div><span><?php echo $sampleType; ?></span></li>
								<li><div class="textB">Fasting :</div><span><?php echo $dataView['Test']['fasting_required']; ?></span></li>
								<li><div class="textB">Report Delivery:</div><span><?php echo $dataView['Test']['reporting']; ?></span></li>
								<li><div class="textB">Components:</div><span><?php 
								if($dataView['Test']['type'] == "TEST")
								{
									$observation = explode(",",$dataView['Test']['observation_id']);
									echo count($observation)." Observations"; 
								}
								else if($dataView['Test']['type'] == "PROFILE")
								{
									$tests = explode(",",$dataView['Test']['testscode']);
									echo count($tests)." Profiles / Tests"; 
								}
								else{
									echo "No Components";
								}
								
								?></span></li>
								
								<!--<li><div class="textB">Test Parameters:</div><span><?php echo $dataView['Test']['test_parameter']; ?></span></li>
								<li><div class="textB">Test Code: </div><span><?php echo $dataView['Test']['testcode']; ?></span></li>
								<li><div class="textB">Sample: </div><span><?php echo $dataView['Test']['sample']; ?></span></li>
								<li><div class="textB">Methodology: </div><span><?php echo $dataView['Test']['methodology']; ?></span></li>
								<li><div class="textB">Schedule: </div><span><?php echo $dataView['Test']['schedule']; ?></span></li>
								<li><div class="textB">Temp: </div><span><?php echo $dataView['Test']['temp']; ?></span></li>
								<li><div class="textB">Reporting: </div><span><?php echo $dataView['Test']['reporting']; ?></span></li>
								<li><div class="textB">Fasting: </div><span><?php echo "Required"; ?></span></li>
								<li><div class="textB">MRP: </div><span><?php echo $dataView['Test']['mrp']; ?></span></li>
								<li><div class="textB">Description: </div><span><?php echo $dataView['Test']['description']; ?></span></li>-->
								<a href="/tests/my_cart/<?php echo $dataView['Test']['id'];?>"><input type="button" name="" value="Add to cart" id="" type="Add to cart" class="cardsecond" /></a>
							  </ul>
                            </div>
                          </div>

                          <div class="packageDetail_Div">
                              <div id="" class="packageDetail" style="padding:0px;margin:0px;">
							  <?php if($dataView['Test']['type']=='TEST') {?>
								<h2>Tests Detail</h2>
							  <?php  } else { ?>
								<h2>Package Details</h2>
							  <?php } ?>
                                  <div class="tablePac">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="div1">  
                                <tr>
                                  <td align="left" valign="top" class="div1"><strong>
									<?php if($dataView['Test']['type'] == "TEST")
									{
										echo "Observations Included"; 
									}
									if($dataView['Test']['type'] == "PROFILE")
									{
										echo "Profiles / Tests Included"; 
									} ?>
								  </strong></td>
                                  <!--<td align="left" valign="top" class="div1"><strong>No. of Parameters</strong></td>-->
                                </tr> 
                                <?php foreach($component as $val){ ?>    
								<tr>
									<td align="left" valign="top" class="div1">
										<?php if($dataView['Test']['type'] == "PROFILE")
													echo $val['name']." - ".$val['count']." Observation"; 
											 else
												echo $val;
											?>
									</td>
								  <!--<td align="left" valign="top" class="div1" >0</td>-->
								</tr>					
				<?php }?>
				<?php if($dataView['Test']['type'] == "TEST")
					{
						echo "<tr><td style='color:#080fd9;'>The Test marked with (*) are in our NABL Scope.</td></tr>"; 
					}
					?>
                              </table> </div>
                            </div>
                            <div class="sample">
                             
                                  
                                <h2>Sample Report</h2>
                              <div class="imgsample"><a href="" target="_blank"><img src="/img/img/sampleDetails.png" boder="0"></a></div>
                              
                            </div>
                            

                                 

                          </div>
                      
                        
                    </div>
                  </div>

                  <div id="Noida" class="tabcontent" style="display: none;">
                    <div class="swasthRight">
                      <div class="clr"></div>
                      
                          <div class="packageDetail" style="margin:0px;">
                      
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="div1">
                              <tr>
                                <td align="left" valign="top" class="div1">Test Name</td>
                                <td align="left" valign="top" class="div1"><?php echo $dataView['Test']['test_parameter']; ?></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" class="div1">Report Availability</td>
                                <td align="left" valign="top" class="div1"><?php echo $dataView['Test']['reporting']; ?></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" class="div1">Code</td>
                                <td align="left" valign="top" class="div1"><?php echo $dataView['Test']['testcode']; ?></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" class="div1">Category</td>
                                <td align="left" valign="top" class="div1"> <?php echo $category; ?></td>
                              </tr>
		
							  <tr>
                                <td align="left" valign="top" class="div1">Schedule</td>
                                <td align="left" valign="top" class="div1"><?php echo $dataView['Test']['schedule']; ?></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" class="div1">TAT*</td>
                                <td align="left" valign="top" class="div1"><?php echo $dataView['Test']['tat']; ?></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" class="div1">Tested At*</td>
                                <td align="left" valign="top" class="div1"> <?php echo $dataView['Test']['tested_at']; ?></td>
                              </tr>
                            <!--    
							  <tr>
                                <td align="left" valign="top" class="div1">Specimen</td>
                                <td align="left" valign="top" class="div1"><?php echo $sampleType['specimen']; ?></td>
                              </tr>

                                <tr>
                                <td align="left" valign="top" class="div1">Stability Room</td>
                                <td align="left" valign="top" class="div1"><?php echo $sampleType['Stability Room']; ?></td>
                              </tr>

                                <tr>
                                <td align="left" valign="top" class="div1">Stability Refrigerated</td>
                                <td align="left" valign="top" class="div1"><?php echo $sampleType['Stability Refrigerated']; ?></td>
                              </tr>

                                <tr>
                                <td align="left" valign="top" class="div1">Stability Frozen</td>
                                <td align="left" valign="top" class="div1"><?php echo $sampleType['Stability Frozen']; ?></td>
                              </tr>	
							-->
                                 <tr>
                                <td align="left" valign="top" class="div1">Method</td>
                                <td align="left" valign="top" class="div1"><?php echo $dataView['Test']['methodology']; ?></td>
                              </tr>
							  <tr>
                                <td align="left" valign="top" class="div1">Brief Description</td>
                                <td align="left" valign="top" class="div1"><?php echo $dataView['Test']['description']; ?></td>
                              </tr>
							</table>
                            <a href="/tests/my_cart/<?php echo $dataView['Test']['id'];?>"><input type="button" name="" value="Add to cart" id="" type="Add to cart" class="card" /></a>
						</div>
						<div style="float:left;width:100%;margin-left: 52px;font-style: italic;font-size: 10px;margin-bottom: 5px;">
							<div style="float:left;width:225px;margin-bottom:10px;">
								*Reporting TAT in days<br>for the samples recieved by 4PM
							</div>
							<div style="float:left;width:225px;margin-bottom:10px;">
								*0 = Same Day, 1 = Next Day, 2 = 2nd Day,<br> 3 = 3rd Day So on from Schedule
							</div>
							<div style="float:left;width:225px;margin-bottom:10px;">
								*NPL : Tested @ nirAmaya Pathlabs<br>NRL : Tested @ NPL Outsource lab
							</div>
						</div>
                    </div>
                    <div class="clr"></div> 
                    <div class="testdetialsRemarks"></div>
                    
                  </div>
				  <div id="Gurgaon" class="tabcontent">
                    <div class="swasthLeft">
                      <div class="clr"></div>
                       <div class="shouldBox">
                            <div class="divSOne">
                              <ul>
								<?php if($testDetails['final_check']) { ?>
									<li><strong>Also Known As:</strong><br/> <?php echo $testDetails['also_known_as']; ?></li>
									<li><strong>Formal Name:</strong><br/> <?php echo $testDetails['formal_name']; ?></li>
									<li><strong>Sample Instructions:</strong><br/> <?php echo $testDetails['sample_instruction']; ?></li>
									<li><strong>Test Preparation Needed?</strong><br/> <?php echo $testDetails['test_preparation']; ?></li>
									<li><strong>What Is Being Tested?</strong><br/> <?php echo $testDetails['what']; ?></li>
									<li><strong>How Is It Used?</strong><br/> <?php echo $testDetails['how']; ?></li>
									<li><strong>When Is It Ordered</strong><br/> <?php echo $testDetails['when_ordered']; ?></li>
									<li><strong>What Does The Test Result Mean?</strong><br/> <?php echo $testDetails['what_result_mean']; ?></li>
									<li><strong>Is There Anything Else I Should Known?</strong><br/> <?php echo $testDetails['anything_else_to_know']; ?></li>
								<?php } else {?>
									<li><strong>No Data Available Right Now</strong></li>
								<?php } ?>
								<a href="/tests/my_cart/<?php echo $dataView['Test']['id'];?>"><input type="button" name="" value="Add to cart" id="" type="Add to cart" class="cardsecond" /></a>
							  </ul>
                            </div>
                          </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="Users">
            <h3>Frequently Booked Test</h3>
            <div class="Reco">


                
              <div class="leftReco">
               <h4><a href="">Absolute Eosinophil Count</a></h4>
                <ul>
                
                  <li style='display:block'>
                    <div class="textB">
                      <div class="imgs"><i class="fa fa-2x fa-barcode" aria-hidden="true"></i></div>
                      <div class="texts"> C1214</div></div>
                  </li>
                  <li style='display:block'> 
                    <div class="textB">
                      <div class="imgs"><i class="fa fa-2x fa-info-circle" aria-hidden="true"></i></div>
                      <div class="texts">5-a-Dihydrotestosterone (5a DHT)</div> </div>
                  </li>

                      <li >
                    <div class="textB">
                      <div class="imgs" style='display:block' ><i class="fa fa-2x fa-history" aria-hidden="true"></i></div>
                      <div class="texts"><div style='display:block'> within 72 Hrs of Test Schdule</div></div> 
                    </div>
                  </li>
                </ul>
                <div class="sameBox">
                  <div class="sameTop">
                    <div class="rupeesDiv1"> &#8377; 350.00</span></div>
                     <div class="LabBtnForTestPage sameBot"><a id="1378" onclick="javascript:addToCart(69,1378);" class="card">Add to Cart</a></div>
                   
                  </div>
                  <div class="clr "></div>
                  <div class="sameBot">
                  
                      
                  </div>
                </div>
              </div>


              <div class="leftReco">
               <h4><a href="">Absolute Eosinophil Count</a></h4>
                <ul>
                
                  <li style='display:block'>
                    <div class="textB">
                      <div class="imgs"><i class="fa fa-2x fa-barcode" aria-hidden="true"></i></div>
                      <div class="texts"> C1214</div></div>
                  </li>
                  <li style='display:block'> 
                    <div class="textB">
                      <div class="imgs"><i class="fa fa-2x fa-info-circle" aria-hidden="true"></i></div>
                      <div class="texts">5-a-Dihydrotestosterone (5a DHT)</div> </div>
                  </li>

                      <li >
                    <div class="textB">
                      <div class="imgs" style='display:block' ><i class="fa fa-2x fa-history" aria-hidden="true"></i></div>
                      <div class="texts"><div style='display:block'> within 72 Hrs of Test Schdule</div></div> 
                    </div>
                  </li>
                </ul>
                <div class="sameBox">
                  <div class="sameTop">
                    <div class="rupeesDiv1"> &#8377; 350.00</span></div>
                     <div class="LabBtnForTestPage sameBot"><a  id="1378" onclick="javascript:addToCart(69,1378);" class="card">Add to Cart</a></div>
                   
                  </div>
                  <div class="clr "></div>
                  <div class="sameBot">
                  
                      
                  </div>
                </div>
              </div>

              <div class="leftReco">
               <h4><a href="">Absolute Eosinophil Count</a></h4>
                <ul>
                
                  <li style='display:block'>
                    <div class="textB">
                      <div class="imgs"><i class="fa fa-2x fa-barcode" aria-hidden="true"></i></div>
                      <div class="texts"> C1214</div></div>
                  </li>
                  <li style='display:block'> 
                    <div class="textB">
                      <div class="imgs"><i class="fa fa-2x fa-info-circle" aria-hidden="true"></i></div>
                      <div class="texts">5-a-Dihydrotestosterone (5a DHT)</div> </div>
                  </li>

                      <li >
                    <div class="textB">
                      <div class="imgs" style='display:block' ><i class="fa fa-2x fa-history" aria-hidden="true"></i></div>
                      <div class="texts"><div style='display:block'> within 72 Hrs of Test Schdule</div></div> 
                    </div>
                  </li>
                </ul>
                <div class="sameBox">
                  <div class="sameTop">
                    <div class="rupeesDiv1"> &#8377; 350.00</span></div>
                     <div class="LabBtnForTestPage sameBot"><a  id="1378" onclick="javascript:addToCart(69,1378);" class="card">Add to Cart</a></div>
                   
                  </div>
                  <div class="clr "></div>
                  <div class="sameBot">
                  
                      
                  </div>
                </div>
              </div>
            
            
            
              
            


          
            </div>
          </div>
          
          
          
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clr"></div>
  
<script type="text/javascript">
    

$(document).ready(function()
{
  //logVisit();
    $("button").click(function(){
        $("p").slideToggle();
    });
});
</script> 
  <script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
  
<div class="clr"></div>