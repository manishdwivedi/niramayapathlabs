<?php ?>
<script type="text/javascript">
function search_alphabet(alpha)
{
	var selected_elem = document.getElementById('charSelect').innerHTML;

	if(selected_elem == '')
	{
		jQuery('#tab'+alpha).css('background-color','#CCC');
		jQuery('#charSelect').html(alpha);
	}
	else
	{
		jQuery('#tab'+selected_elem).css('background-color','#FCFCFC');
		jQuery('#tab'+alpha).css('background-color','#ccc');
		jQuery('#charSelect').html(alpha);
	}

	
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'tests/search_alphabet?char='+alpha,
		dataType:'json',
		success:function(data){

			if(data.test_info.success == 'success')
			{
				var rep_div_1 = '';
				if(data.test_info.test_list.length != 0)
				{
					jQuery.each(data.test_info.test_list,function(index, value)
					{
						rep_div_1 += '<li><div class="greyBox">';
		                rep_div_1 += '<h3><a href="<?php echo SITE_URL;?>tests/test_detail/'+value.Test.id+'" target="_blank" style="color:white;">'+value.Test.test_parameter+'</a></h3>';
		                rep_div_1 += '<div class="bot">';
		                rep_div_1 += '<div class="ReportParameter">';
		                rep_div_1 += '<p title="Code"><i class="fa fa-barcode" aria-hidden="true"></i>'+value.Test.testcode+'</p>';
		                rep_div_1 += '<p title="Name/Description"><i class="fa fa-info-circle" aria-hidden="true"></i>'+value.Test.test_parameter+'</p>';
		                rep_div_1 += '<p title="Reporting Time"><i class="fa fa-history" aria-hidden="true"></i>'+value.Test.reporting+'</p>';
		                rep_div_1 += '</div>';
		                rep_div_1 += '<div class="IncludesBorder2">';
		                rep_div_1 += '<div class="pretestBoxz"></div>';
		                rep_div_1 += '<div class="phelp"><span><span class="rs">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="biggerPrice"><span class="bigger"><span class="rs list">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="LabBtn"><a href="<?php echo SITE_URL;?>tests/my_cart/'+value.Test.id+'">Add to Cart</a></div>'; 
		                rep_div_1 += '</div></div></div></li>';
					});
				}
				if(data.test_info.test_list2.length != 0)
				{
					jQuery.each(data.test_info.test_list2,function(index, value)
					{
						rep_div_1 += '<li><div class="greyBox">';
		                rep_div_1 += '<h3><a href="<?php echo SITE_URL;?>tests/test_detail/'+value.Test.id+'" target="_blank" style="color:white;">'+value.Test.test_parameter+'</a></h3>';
		                rep_div_1 += '<div class="bot">';
		                rep_div_1 += '<div class="ReportParameter">';
		                rep_div_1 += '<p title="Code"><i class="fa fa-barcode" aria-hidden="true"></i>'+value.Test.testcode+'</p>';
		                rep_div_1 += '<p title="Name/Description"><i class="fa fa-info-circle" aria-hidden="true"></i>'+value.Test.test_parameter+'</p>';
		                rep_div_1 += '<p title="Reporting Time"><i class="fa fa-history" aria-hidden="true"></i>'+value.Test.reporting+'</p>';
		                rep_div_1 += '</div>';
		                rep_div_1 += '<div class="IncludesBorder2">';
		                rep_div_1 += '<div class="pretestBoxz"></div>';
		                rep_div_1 += '<div class="phelp"><span><span class="rs">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="biggerPrice"><span class="bigger"><span class="rs list">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="LabBtn"><a href="<?php echo SITE_URL;?>tests/my_cart/'+value.Test.id+'">Add to Cart</a></div>'; 
		                rep_div_1 += '</div></div></div></li>';
					});
				}
				rep_div_1 +='</table>';

			}
			if(data.test_info.success == 'notsuccess')
			{
				var rep_div_1 = '<h3>';
				rep_div_1 +='Sorry no records found.';
				rep_div_1 +='</h3>';
			}
			var rep_div_2 = 'Showing '+data.test_info.test_count+' results :';
			jQuery('#show_test_count').html(rep_div_2);
			jQuery('#test_list').html(rep_div_1);
			jQuery('#alpha_search').hide();
			jQuery('#HomeShowingResCount').hide();
			jQuery('#HomeShowingRes').hide();
		},
		beforeSend:function(){
			jQuery('#alpha_search').show();
		}

	});
}

function search_form()
{
	jQuery.ajax({
		type:'POST',
		url:siteUrl+'tests/search_data',
		data:$("#form2").serialize(),
		success:function(data){
			if(data.search_info.success == 'success')
			{
				var rep_div_1 = '';
				
				if(data.search_info.search_list_1.length != 0)
				{
					jQuery.each(data.search_info.search_list_1,function(index, value)
					{
						rep_div_1 += '<li><div class="greyBox">';
		                rep_div_1 += '<h3><a href="<?php echo SITE_URL;?>tests/test_detail/'+value.Test.id+'" target="_blank" style="color:white;">'+value.Test.test_parameter+'</a></h3>';
		                rep_div_1 += '<div class="bot">';
		                rep_div_1 += '<div class="ReportParameter">';
		                rep_div_1 += '<p title="Code"><i class="fa fa-barcode" aria-hidden="true"></i>'+value.Test.testcode+'</p>';
		                rep_div_1 += '<p title="Name/Description"><i class="fa fa-info-circle" aria-hidden="true"></i>'+value.Test.test_parameter+'</p>';
		                rep_div_1 += '<p title="Reporting Time"><i class="fa fa-history" aria-hidden="true"></i>'+value.Test.reporting+'</p>';
		                rep_div_1 += '</div>';
		                rep_div_1 += '<div class="IncludesBorder2">';
		                rep_div_1 += '<div class="pretestBoxz"></div>';
		                rep_div_1 += '<div class="phelp"><span><span class="rs">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="biggerPrice"><span class="bigger"><span class="rs list">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="LabBtn"><a href="<?php echo SITE_URL;?>tests/my_cart/'+value.Test.id+'">Add to Cart</a></div>'; 
		                rep_div_1 += '</div></div></div></li>';
					});
				}
				if(data.search_info.search_list_2.length != 0)
				{
					jQuery.each(data.search_info.search_list_2,function(index, value)
					{
						rep_div_1 += '<li><div class="greyBox">';
		                rep_div_1 += '<h3><a href="<?php echo SITE_URL;?>tests/test_detail/'+value.Test.id+'" target="_blank" style="color:white;">'+value.Test.test_parameter+'</a></h3>';
		                rep_div_1 += '<div class="bot">';
		                rep_div_1 += '<div class="ReportParameter">';
		                rep_div_1 += '<p title="Code"><i class="fa fa-barcode" aria-hidden="true"></i>'+value.Test.testcode+'</p>';
		                rep_div_1 += '<p title="Name/Description"><i class="fa fa-info-circle" aria-hidden="true"></i>'+value.Test.test_parameter+'</p>';
		                rep_div_1 += '<p title="Reporting Time"><i class="fa fa-history" aria-hidden="true"></i>'+value.Test.reporting+'</p>';
		                rep_div_1 += '</div>';
		                rep_div_1 += '<div class="IncludesBorder2">';
		                rep_div_1 += '<div class="pretestBoxz"></div>';
		                rep_div_1 += '<div class="phelp"><span><span class="rs">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="biggerPrice"><span class="bigger"><span class="rs list">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="LabBtn"><a href="<?php echo SITE_URL;?>tests/my_cart/'+value.Test.id+'">Add to Cart</a></div>'; 
		                rep_div_1 += '</div></div></div></li>';

					});
				}
				if(data.search_info.search_list_3.length != 0)
				{
					jQuery.each(data.search_info.search_list_3,function(index, value)
					{
												rep_div_1 += '<li><div class="greyBox">';
		                rep_div_1 += '<h3><a href="<?php echo SITE_URL;?>tests/test_detail/'+value.Test.id+'" target="_blank" style="color:white;">'+value.Test.test_parameter+'</a></h3>';
		                rep_div_1 += '<div class="bot">';
		                rep_div_1 += '<div class="ReportParameter">';
		                rep_div_1 += '<p title="Code"><i class="fa fa-barcode" aria-hidden="true"></i>'+value.Test.testcode+'</p>';
		                rep_div_1 += '<p title="Name/Description"><i class="fa fa-info-circle" aria-hidden="true"></i>'+value.Test.test_parameter+'</p>';
		                rep_div_1 += '<p title="Reporting Time"><i class="fa fa-history" aria-hidden="true"></i>'+value.Test.reporting+'</p>';
		                rep_div_1 += '</div>';
		                rep_div_1 += '<div class="IncludesBorder2">';
		                rep_div_1 += '<div class="pretestBoxz"></div>';
		                rep_div_1 += '<div class="phelp"><span><span class="rs">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="biggerPrice"><span class="bigger"><span class="rs list">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="LabBtn"><a href="<?php echo SITE_URL;?>tests/my_cart/'+value.Test.id+'">Add to Cart</a></div>'; 
		                rep_div_1 += '</div></div></div></li>';
					});
				}
				if(data.search_info.search_list_4.length != 0)
				{
					jQuery.each(data.search_info.search_list_4,function(index, value)
					{
										rep_div_1 += '<li><div class="greyBox">';
		                rep_div_1 += '<h3><a href="<?php echo SITE_URL;?>tests/test_detail/'+value.Test.id+'" target="_blank" style="color:white;">'+value.Test.test_parameter+'</a></h3>';
		                rep_div_1 += '<div class="bot">';
		                rep_div_1 += '<div class="ReportParameter">';
		                rep_div_1 += '<p title="Code"><i class="fa fa-barcode" aria-hidden="true"></i>'+value.Test.testcode+'</p>';
		                rep_div_1 += '<p title="Name/Description"><i class="fa fa-info-circle" aria-hidden="true"></i>'+value.Test.test_parameter+'</p>';
		                rep_div_1 += '<p title="Reporting Time"><i class="fa fa-history" aria-hidden="true"></i>'+value.Test.reporting+'</p>';
		                rep_div_1 += '</div>';
		                rep_div_1 += '<div class="IncludesBorder2">';
		                rep_div_1 += '<div class="pretestBoxz"></div>';
		                rep_div_1 += '<div class="phelp"><span><span class="rs">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="biggerPrice"><span class="bigger"><span class="rs list">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="LabBtn"><a href="<?php echo SITE_URL;?>tests/my_cart/'+value.Test.id+'">Add to Cart</a></div>'; 
		                rep_div_1 += '</div></div></div></li>';
					});
				}
				if((data.search_info.search_list_1.length == 0) && (data.search_info.search_list_2.length == 0) && (data.search_info.search_list_3.length == 0) && (data.search_info.search_list_4.length == 0))
				{
					rep_div_1 +='<tr>';
					rep_div_1 +='<td colspan="5" style="text-align:center;">Sorry no records found.</td>';
					rep_div_1 +='</tr>';
				}
				rep_div_1 +='</table>';
			}
			if(data.search_info.success == 'notsuccess')
			{
				var rep_div_1 = '<h3>';
				rep_div_1 +='Sorry no records found';
				rep_div_1 +='</h3>';
			}
			var rep_div_2 = 'Showing '+data.search_info.count_test+' results :';
			jQuery('#show_test_count').html(rep_div_2);
			jQuery('#test_list').html(rep_div_1);
			jQuery('#HomeShowingResCount').hide();
			jQuery('#HomeShowingRes').hide();
			jQuery('#search_search').hide();
			
		},
		beforeSend:function(){
			jQuery('#search_search').show();
		},
		dataType:'json'
	});
}



function search_keywordd()
{
	jQuery.ajax({
		type:'POST',
		url:siteUrl+'tests/search_keyword',
		data:$("#form0").serialize(),
		success:function(data){
			if(data.keyword_info.success == 'success')
			{
				var rep_div_1 = '';
				
				if(data.keyword_info.search_list_1.length != 0)
				{
					jQuery.each(data.keyword_info.search_list_1,function(index, value)
					{
												rep_div_1 += '<li><div class="greyBox">';
		                rep_div_1 += '<h3><a href="<?php echo SITE_URL;?>tests/test_detail/'+value.Test.id+'" target="_blank" style="color:white;">'+value.Test.test_parameter+'</a></h3>';
		                rep_div_1 += '<div class="bot">';
		                rep_div_1 += '<div class="ReportParameter">';
		                rep_div_1 += '<p title="Code"><i class="fa fa-barcode" aria-hidden="true"></i>'+value.Test.testcode+'</p>';
		                rep_div_1 += '<p title="Name/Description"><i class="fa fa-info-circle" aria-hidden="true"></i>'+value.Test.test_parameter+'</p>';
		                rep_div_1 += '<p title="Reporting Time"><i class="fa fa-history" aria-hidden="true"></i>'+value.Test.reporting+'</p>';
		                rep_div_1 += '</div>';
		                rep_div_1 += '<div class="IncludesBorder2">';
		                rep_div_1 += '<div class="pretestBoxz"></div>';
		                rep_div_1 += '<div class="phelp"><span><span class="rs">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="biggerPrice"><span class="bigger"><span class="rs list">&#8377;</span>'+value.Test.mrp+'</span></div>';
		                rep_div_1 += '<div class="LabBtn"><a href="<?php echo SITE_URL;?>tests/my_cart/'+value.Test.id+'">Add to Cart</a></div>'; 
		                rep_div_1 += '</div></div></div></li>';
					});
				}
				
				rep_div_1 +='</table>';
			}

			if(data.keyword_info.success == 'unsuccess')
			{
				var rep_div_1 = '<h3>';
				rep_div_1 +='Sorry no records found.';
				rep_div_1 +='</h3>';
			}

			var rep_div_2 = 'Showing '+data.keyword_info.test_count+' results :';
			jQuery('#show_test_count').html(rep_div_2);
			jQuery('#test_list').html(rep_div_1);
			jQuery('#search_keyword').hide();
			jQuery('#HomeShowingResCount').hide();
			jQuery('#HomeShowingRes').hide();
		},
		beforeSend:function(){
			jQuery('#search_keyword').show();
		},
		dataType:'json'
	});
}

function validation_key()
{
	var str=true;
	document.getElementById("msgS1").innerHTML="";
	if(document.form0.SearchTestSearch.value=='')
	{
		document.getElementById("msgS1").innerHTML="Please Enter Keyword";
		str=false;
	}
	return str;
}


</script>

  <script>
      $(document).ready(function ()
       {
          $('.flip').click(function () {
              $('#panel').slideToggle(500);
              $(this).hide();
              $('#hides-new').show();
          });
          $('#hides-new').click(function () {
              $(this).hide();
              $('#shows-new').show();
          });
          
        $("#searchTest").keyup(function()
        {
          cruntPage=1;
          pageSet=0;
          bookAtest.testFilter(dataJson);
        });

        $("#radioPackage, #radioTest").change(function()
        {
          cruntPage=1;
          pageSet=0;
        $('#ktlw input[type=radio]').prop("checked",false);
          bookAtest.testFilter(dataJson);
        });

        $('#ktlw input[type=radio]').on('change', function()
        {
          cruntPage=1;
          pageSet=0;
        $('#radioPackage, #radioTest').prop("checked",false);
          bookAtest.testFilter(dataJson);
       
        });
      });
</script>
<div class="location_div">
<div class="centring">
<div class="graynavigation">
  <ul>
     <li><a href="/"><span itemprop="name">Home</span></a></li>
     <li class="list"> <span> Search</span></li>
  </ul>
</div>
      <div class="clr divid"></div>
        
        <div class="right"> 
          
          <div id="HomeShowingResCount">
          <h1 id="HomeShowingResCount" style="text-transform: capitalize;">Showing</h1>
          <div class="countvalue">(<?php echo count($home_keyword);?> found)</div>
          <div class="clr"></div>
          </div>
          
          

          <ul id="ulpaging">
           <div class="result" id="show_test_count"></div>
           <div class="tableDiv" id="test_list" style=" margin:0px;"></div>
           <div id="HomeShowingRes">
          	<?php if($home_keyword != 'No Test' && !empty($home_keyword)) {?>
          	  <?php foreach($home_keyword as $key => $val) {?>
          <li>
            <div class="greyBox">
              <h3><?php echo $html->link($val['Search']['test_parameter'], array('action'=>'test_detail', $val['Search']['id']  ));?></h3>
              <div class="bot">
                <div class="ReportParameter">
                  	<!--<a href="javascript:void(0)" target="_blank" style="color:white;">-->
	                  	<p title="Code"><i style="color:#a0d64a;" class="fa fa-barcode" aria-hidden="true"></i>  <?php echo $val['Search']['test_code'];?></p>
	                  	<p title="Name/Description"><i style="color:#a0d64a;" class="fa fa-info-circle" aria-hidden="true"></i>  <?php echo $val['Search']['test_parameter'];?></p>
	                  	<p title="Reporting Time"><i style="color:#a0d64a;" class="fa fa-history" aria-hidden="true"></i>  <?php echo $val['Search']['reporting_time'];?></p>
	                <!--</a>--->
                </div>
                <div class="IncludesBorder2">
                <div class="pretestBoxz"></div>
                <div class="phelp"><span><span class="rs">&#8377;</span><?php echo $val['Search']['test_mrp'];?></span></div>
                <div class="biggerPrice"><span class="bigger" style="color:red;"><span class="rs list">&#8377;</span><?php echo $val['Search']['test_mrp'];?></span></div>
                <div class="LabBtn"><?php echo $html->link('Add to Cart',array('controller'=>'tests','action'=>'my_cart',$val['Search']['id']),array('escape'=>false)); ?></div> 
                <!--<td><?php echo $html->link('',array('controller'=>'tests','action'=>'my_cart',$val['Search']['id']),array('escape'=>false));?></td> -->
                </div>
            </div>
          </div>
          
        </li>
           <?php } }?>
           </div>
    </ul>
          
          <div class="clr"></div>
          <div class="searchBy">
           <div class="tableFormBox">
            <div class="tableDiv">
				<div id="charSelect" style="display:none;"></div>
            </div>
          </div>
          </div>
         
        </div>

        <div class="left">
          
          <div class="text_container hidden">
            <div class="lessthan600" id="DivFilters"><!--div that we want to hide-->
              
              <div class="clr"></div>
              <div class="leftFilter">
                <h3>FILTER BY</h3>
                <div class="innerDiv">
        
                    <?php echo $form->create('Search',array('url'=>'javascript:void(0);','id'=>'form2','name'=>'form2'));?>
                      
                        <div class="searchBy">
                          <div class="marLeftNone">
                            <?php echo $form->input('Search.speciality',array('type'=>'select','options'=>$speciality,'label'=>false,'empty'=>'Select Speciality','class'=>'inpWidth')); ?>
                          </div>
                          <div style="clear:both;"></div>
                          <div class="box">
                            <?php echo $form->input('Search.disease',array('type'=>'select','options'=>$diseases,'label'=>false,'empty'=>'Select Disease','class'=>'inpWidth')); ?>
                          </div>
                          <div style="clear:both;"></div>
                          <div class="box">
                                <?php echo $form->input('Search.code',array('type'=>'select','options'=>$testcodes,'label'=>false,'empty'=>'Select Code','class'=>'inpWidth')); ?>
                          </div>
                          <div style="clear:both;"></div>

                          <div class="box">
                                <?php echo $form->submit('submit-button.gif',array('class'=>'btn','alt'=>'Submit','style'=>'float:left;','onclick'=>'search_form();'));?>
                                <?php echo $html->image('p_rocess.gif',array('width'=>30,'id'=>'search_search','style'=>'display:none;'));?>
                          </div>
                        </div>
	                <?php echo $form->end();?>
	                
	                
	                <div class="clr"></div>
	                <div class="blockquoteDiv">
	                    <blockquote>
	                      <p>OR</p>
	                    </blockquote>
	                  </div>
                    <div class="clr"></div>
                    
                    
                        <?php echo $form->create('SearchKeyword',array('url'=>'javascript:void(0);','id'=>'form0','name'=>'form0'));?>
						<div class="box">
						<label>Search Test by Keyword :<?php echo $html->image('p_rocess.gif',array('width'=>30,'id'=>'search_keyword','style'=>'display:none;'));?></label>
						<input type="text" placeholder="Enter Keyword" class="box inpWidth" name="data[Search][test_search]" id="SearchTestSearch" />
						<div style="color:#FF0000;" id="msgS1"></div>
						<?php echo $form->submit('submit-button.gif',array('class'=>'btn','alt'=>'Submit','style'=>' margin:15px 0 0;','onclick'=>'search_keywordd();'));?>
						</div>
                        <?php echo $form->end();?>
                   
                    
                    <div class="clr"></div>
	                <div class="blockquoteDiv">
	                    <blockquote>
	                      <p>OR</p>
	                    </blockquote>
	                  </div>
                    <div class="clr"></div>
                    

                    <div class="box">
						<label class="box">Search Test by Alphabet :<?php echo $html->image('p_rocess.gif',array('width'=>30,'id'=>'alpha_search','style'=>'display:none;'));?></label>
                      <table class="box" width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                          <td id="tabA" style=""><?php echo $html->link('A','javascript:void(0);',array('onclick'=>'search_alphabet("A");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabB" style=""><?php echo $html->link('B','javascript:void(0);',array('onclick'=>'search_alphabet("B");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabC" style=""><?php echo $html->link('C','javascript:void(0);',array('onclick'=>'search_alphabet("C");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabD" style=""><?php echo $html->link('D','javascript:void(0);',array('onclick'=>'search_alphabet("D");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabE" style=""><?php echo $html->link('E','javascript:void(0);',array('onclick'=>'search_alphabet("E");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabF" style=""><?php echo $html->link('F','javascript:void(0);',array('onclick'=>'search_alphabet("F");','style'=>'color:#ED9F10;'));?></td>
                        </tr>
                        <tr>
                          <td id="tabG" style=""><?php echo $html->link('G','javascript:void(0);',array('onclick'=>'search_alphabet("G");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabH" style=""><?php echo $html->link('H','javascript:void(0);',array('onclick'=>'search_alphabet("H");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabI" style=""><?php echo $html->link('I','javascript:void(0);',array('onclick'=>'search_alphabet("I");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabJ" style=""><?php echo $html->link('J','javascript:void(0);',array('onclick'=>'search_alphabet("J");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabK" style=""><?php echo $html->link('K','javascript:void(0);',array('onclick'=>'search_alphabet("K");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabL" style=""><?php echo $html->link('L','javascript:void(0);',array('onclick'=>'search_alphabet("L");','style'=>'color:#ED9F10;'));?></td>
                        </tr>


                        <tr>
                          <td id="tabM" style=""><?php echo $html->link('M','javascript:void(0);',array('onclick'=>'search_alphabet("M");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabN" style=""><?php echo $html->link('N','javascript:void(0);',array('onclick'=>'search_alphabet("N");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabO" style=""><?php echo $html->link('O','javascript:void(0);',array('onclick'=>'search_alphabet("O");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabP" style=""><?php echo $html->link('P','javascript:void(0);',array('onclick'=>'search_alphabet("P");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabQ" style=""><?php echo $html->link('Q','javascript:void(0);',array('onclick'=>'search_alphabet("Q");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabR" style=""><?php echo $html->link('R','javascript:void(0);',array('onclick'=>'search_alphabet("R");','style'=>'color:#ED9F10;'));?></td>
                        </tr>
                        <tr>
                          <td id="tabS" style=""><?php echo $html->link('S','javascript:void(0);',array('onclick'=>'search_alphabet("S");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabT" style=""><?php echo $html->link('T','javascript:void(0);',array('onclick'=>'search_alphabet("T");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabU" style=""><?php echo $html->link('U','javascript:void(0);',array('onclick'=>'search_alphabet("U");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabV" style=""><?php echo $html->link('V','javascript:void(0);',array('onclick'=>'search_alphabet("V");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabW" style=""><?php echo $html->link('W','javascript:void(0);',array('onclick'=>'search_alphabet("W");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabX" style=""><?php echo $html->link('X','javascript:void(0);',array('onclick'=>'search_alphabet("X");','style'=>'color:#ED9F10;'));?></td>
                        </tr>
                        <tr>
                          <td id="tabY" style=""><?php echo $html->link('Y','javascript:void(0);',array('onclick'=>'search_alphabet("Y");','style'=>'color:#ED9F10;'));?></td>
                          <td id="tabZ" style=""><?php echo $html->link('Z','javascript:void(0);',array('onclick'=>'search_alphabet("Z");','style'=>'color:#ED9F10;'));?></td>
                        </tr>
                      </table> 
                      </div> 






                  
                </div>
              </div>
              <div class="clr"></div>
            </div>
          </div>
          <!--#text_container hidden --> 
          
        </div>
        
        <!--#left -->
        
     </div>
    </div>
  <div class="clr"></div>
   <script type="text/javascript">
      $(document).ready(function () {
          var list = $('#ktlw li:gt(3)');
          list.hide();
          $('#ktlID').click(function () {
              list.slideToggle(400);
              if ($('#ktlID').html() == 'Show All') {
                  $('#ktlID').html('Hide');
              }
              else {
                  $('#ktlID').html('Show All');
              }
              return false;
          });
      });
</script>
<div class="clr"></div>