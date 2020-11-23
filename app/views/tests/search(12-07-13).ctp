<?php //echo "<pre>gdfgdfgdf"; print_r($userdetail); exit;?>
<style type="text/css">
.submit {
float:left;
margin:10px 10px 0px 0px;
}
.innercontainer_bottom_right_row2{
padding:0;
}


.input-text {
    background: url("../img/bg_fade_sml.png") repeat-x scroll center top transparent;
    border: 1px solid #999999;
    border-radius: 3px 3px 3px 3px;
    color: #666666;
    margin-bottom: 5px;
    padding: 10px;
    width: 300px;
}

.btn, .btnalt {
   
    border: 1px solid #859C27 !important;
    color: #859C27;
    font-size: 12px;
    font-weight: 700;
    padding: 7px 10px;
	float:left;
}

.alphabet-text
{
	color:#0066FF; 
	text-decoration:underline;
}
.search-text-heading
{
	height: 29px; 
	padding: 10px; 
	border: 1px solid #999999; 
	border-radius:3px; 
	text-align:center; 
	color:#ff0000;
}
.search-text-heading-top
{
	height: 29px; 
	padding: 10px; 
	border: 1px solid #999999; 
	border-radius:3px; 
	text-align:center; 
	color:#000000;
}
.search-testcode
{
	font-weight:normal; 
	height: 29px; 
	padding: 10px; 
	border: 1px solid #999999; 
	border-radius:3px; 
	width:145px;
}
.search-testparam
{
	font-weight:normal; 
	height: 29px; 
	padding: 10px; 
	border: 1px solid #999999; 
	border-radius:3px;
}
.search-testparam a
{
	color:#999999; 
	text-decoration:underline;
}
.description-heading
{
	text-align:center; 
	padding:10px;
}
.desc-head
{
	font-weight:bold; 
	padding:10px; 
	border:1px solid #999999; 
	border-radius:3px;
}
.desc-info
{
	font-weight:normal; 
	padding:10px; 
	border:1px solid #999999; 
	border-radius:3px; 
	color:#999999;
}
</style>
<script type="text/javascript">
function listing(){
window.location.href=siteUrl+"members/register";
return false;
}

function upload_resume(user)
{
	//alert(user);
	if(user == 'R')
	{
		jQuery('#resumediv').show();
		jQuery('#aboutdiv').show();
	}
}


function search_alphabet(alpha)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'tests/search_alphabet?char='+alpha,
		dataType:'json',
		success:function(data){
			
			if(data.test_info.success == 'success')
			{
				var rep_div_1 = '';
				rep_div_1 +='<table border="0" width="100%">';
				rep_div_1 +='<tr><td>&nbsp;</td></tr>';
				rep_div_1 +='<tr>';
				rep_div_1 +='<td class="search-text-heading-top" colspan="2">';
				rep_div_1 +='You have searched for Alphabet "'+data.test_info.search_alphabet+'"';
				rep_div_1 +='</td>';
				rep_div_1 +='</tr>';
				rep_div_1 +='<tr><td>&nbsp;</td></tr>';
				if(data.test_info.test_list.length != 0)
				{
					jQuery.each(data.test_info.test_list,function(index, value)
					{
						rep_div_1 +='<tr>';
						rep_div_1 +='<td class="search-testcode">'+value.Test.testcode+'</td>';
						rep_div_1 +='<td class="search-testparam"><a href="javascript:void(0);" onclick="show_description('+value.Test.id+');">'+value.Test.test_parameter+'</a><span id="process_'+value.Test.id+'" style=" display:none;"><?php echo $html->image('p_rocess.gif',array('height'=>10,'style'=>'padding:0 0 0 20px;'));?></span></td>';
						rep_div_1 +='</tr>';
						rep_div_1 +='<tr id="description_div_'+value.Test.id+'" style="display:none;">';
						rep_div_1 +='<td></td>';
						rep_div_1 +='</tr>';
					});
				}
				if(data.test_info.test_list2.length != 0)
				{
					jQuery.each(data.test_info.test_list2,function(index, value)
					{
						rep_div_1 +='<tr>';
						rep_div_1 +='<td class="search-testcode">'+value.Test.testcode+'</td>';
						rep_div_1 +='<td class="search-testparam"><a href="javascript:void(0);" onclick="show_description('+value.Test.id+');">'+value.Test.test_parameter+'</a><span id="process_'+value.Test.id+'" style=" display:none;"><?php echo $html->image('p_rocess.gif',array('height'=>10,'style'=>'padding:0 0 0 20px;'));?></span></td>';
						rep_div_1 +='</tr>';
						rep_div_1 +='<tr id="description_div_'+value.Test.id+'" style="display:none;">';
						rep_div_1 +='<td></td>';
						rep_div_1 +='</tr>';
					});
				}
				rep_div_1 +='</table>';
				
			}
			if(data.test_info.success == 'notsuccess')
			{
				var rep_div_1 = '';
				rep_div_1 +='<table border="0" width="100%">';
				rep_div_1 +='<tr><td>&nbsp;</td></tr>';
				rep_div_1 +='<tr>';
				rep_div_1 +='<td class="search-text-heading-top" colspan="2">';
				rep_div_1 +='You have searched for Alphabet "'+data.test_info.search_alphabet+'"';
				rep_div_1 +='</td>';
				rep_div_1 +='</tr>';
				rep_div_1 +='<tr><td>&nbsp;</td></tr>';
				rep_div_1 +='<tr>';
				rep_div_1 +='<td style="font-weight:normal;" class="search-text-heading" colspan="2">Sorry no records found.</td>';
				rep_div_1 +='</tr>';
				rep_div_1 +='</table>';
			}
			var rep_div_2 = '';
			jQuery('#searched_data').html(rep_div_2);
			jQuery('#test_list').html(rep_div_1);
			jQuery('#alpha_search').hide();
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
		data:$("#form1").serialize(),
		success:function(data){
			
			if(data.search_info.success == 'success')
			{
				var rep_div_1 = '';
				rep_div_1 +='<table border="0" width="100%">';
				rep_div_1 +='<tr><td>&nbsp;</td></tr>';
				rep_div_1 +='<tr>';
				rep_div_1 +='<td class="search-text-heading-top" colspan="2">';
				rep_div_1 +='Search Result';
				rep_div_1 +='</td>';
				rep_div_1 +='</tr>';
				rep_div_1 +='<tr><td>&nbsp;</td></tr>';
				if(data.search_info.search_list.length != 0)
				{
					jQuery.each(data.search_info.search_list,function(index, value)
					{
						rep_div_1 +='<tr>';
						rep_div_1 +='<td class="search-testcode">'+value.Test.testcode+'</td>';
						rep_div_1 +='<td class="search-testparam"><a href="javascript:void(0);" onclick="show_description('+value.Test.id+');">'+value.Test.test_parameter+'</a><span id="process_'+value.Test.id+'" style=" display:none;"><?php echo $html->image('p_rocess.gif',array('height'=>10,'style'=>'padding:0 0 0 20px;'));?></span></td>';
						rep_div_1 +='</tr>';
						rep_div_1 +='<tr id="description_div_'+value.Test.id+'" style="display:none;">';
						rep_div_1 +='<td></td>';
						rep_div_1 +='</tr>';
					});
				}
				if(data.search_info.search_list.length == 0)
				{
					rep_div_1 +='<tr>';
					rep_div_1 +='<td style="font-weight:normal;" class="search-text-heading" colspan="2">Sorry no records found.</td>';
					rep_div_1 +='</tr>';
				}
				rep_div_1 +='</table>';
			}
			if(data.search_info.success == 'notsuccess')
			{
				var rep_div_1 = '';
				rep_div_1 +='<table border="0" width="100%">';
				rep_div_1 +='<tr><td>&nbsp;</td></tr>';
				rep_div_1 +='<tr>';
				rep_div_1 +='<td class="search-text-heading" colspan="2">';
				rep_div_1 +='Search Result';
				rep_div_1 +='</td>';
				rep_div_1 +='</tr>';
				rep_div_1 +='<tr><td>&nbsp;</td></tr>';
				rep_div_1 +='<tr>';
				rep_div_1 +='<td style="font-weight:normal;" class="search-text-heading" colspan="2">Sorry no records found.</td>';
				rep_div_1 +='</tr>';
				rep_div_1 +='</table>';
			}
			var rep_div_2 = '';
			jQuery('#test_list').html(rep_div_2);
			jQuery('#searched_data').html(rep_div_1);
			jQuery('#search_search').hide();
		},
		beforeSend:function(){
			jQuery('#search_search').show();
		},
		dataType:'json'
	});
}


function show_description(val)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'tests/test_description?number='+val,
		dataType:'json',
		success:function(data){
			if(data.description_info.success == 'success')
			{
				//alert(data.description_info.test_parameter);
				var rep_div = '';
				rep_div +='<td colspan="2">';
				rep_div +='<table border="0" width="100%">';
				rep_div +='<tr>';
				rep_div +='<td colspan="2" class="description-heading">Description of ('+data.description_info.test_parameter+')</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td width="130" class="desc-head">Test Code</td>';
				rep_div +='<td class="desc-info">'+data.description_info.testcode+'</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td width="130" class="desc-head">Test Parameters</td>';
				rep_div +='<td class="desc-info">'+data.description_info.test_parameter+'</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td width="130" class="desc-head">Sample</td>';
				rep_div +='<td class="desc-info">'+data.description_info.sample+'</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td width="130" class="desc-head">Methodology</td>';
				rep_div +='<td class="desc-info">'+data.description_info.methodology+'</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td width="130" class="desc-head">Temp</td>';
				rep_div +='<td class="desc-info">'+data.description_info.temp+'</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td width="130" class="desc-head">Schedule</td>';
				rep_div +='<td class="desc-info">'+data.description_info.schedule+'</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td width="130" class="desc-head">Reporting</td>';
				rep_div +='<td class="desc-info">'+data.description_info.reporting+'</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td width="130" class="desc-head">Net</td>';
				rep_div +='<td class="desc-info">'+data.description_info.net+'</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td width="130" class="desc-head">Mrp</td>';
				rep_div +='<td class="desc-info">'+data.description_info.mrp+'</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td width="130" class="desc-head">Description</td>';
				rep_div +='<td class="desc-info">'+data.description_info.description+'</td>';
				rep_div +='</tr>';
				rep_div +='<tr>';
				rep_div +='<td colspan="2">&nbsp;</td>';
				rep_div +='</tr>';
				rep_div +='</table>';
				rep_div +='</td>';
				jQuery('#description_div_'+data.description_info.id).html(rep_div);
				jQuery('#description_div_'+data.description_info.id).show();
				jQuery('#process_'+data.description_info.id).hide();
			}
		},
		beforeSend:function(){
			jQuery('#process_'+val).show();
		}
	});
}
</script>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
  <div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home">Home Page</div>
          <div class="bread"><?php echo $this->Html->link('Search','/tests/search/'.$search_type);?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<!--bodycontainer div start here-->
<!--<h1><?php //echo $data[0]['Pagelocale']['title'];?><span class="green">niramaya</span></h1>-->
<h2>Search <span class="green"><?php echo $search_type;?></span></h2>
<div style="padding:107px 0px 0px 0px; font-weight:bold; font-size:15px;">
	<div style="float:left;">Search <?php echo ucfirst($search_type);?> Alphabetically :</div> <div style="padding:0px 0px 0px 23px; float:left; display:none;" id="alpha_search"><?php echo $html->image('p_rocess.gif');?></div>
	<div style="clear:both; padding:30px 0px 0px 0px;">
		<table border="0" width="100%">
			<tr>
				<td><?php echo $html->link('A','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("A");'));?></td>
				<td><?php echo $html->link('B','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("B");'));?></td>
				<td><?php echo $html->link('C','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("C");'));?></td>
				<td><?php echo $html->link('D','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("D");'));?></td>
				<td><?php echo $html->link('E','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("E");'));?></td>
				<td><?php echo $html->link('F','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("F");'));?></td>
				<td><?php echo $html->link('G','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("G");'));?></td>
				<td><?php echo $html->link('H','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("H");'));?></td>
				<td><?php echo $html->link('I','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("I");'));?></td>
				<td><?php echo $html->link('J','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("J");'));?></td>
			</tr>
			<tr>
				<td colspan="10">&nbsp;</td>
			</tr>
			<tr>
				<td><?php echo $html->link('K','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("K");'));?></td>
				<td><?php echo $html->link('L','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("L");'));?></td>
				<td><?php echo $html->link('M','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("M");'));?></td>
				<td><?php echo $html->link('N','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("N");'));?></td>
				<td><?php echo $html->link('O','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("O");'));?></td>
				<td><?php echo $html->link('P','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("P");'));?></td>
				<td><?php echo $html->link('Q','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("Q");'));?></td>
				<td><?php echo $html->link('R','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("R");'));?></td>
				<td><?php echo $html->link('S','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("S");'));?></td>
				<td><?php echo $html->link('T','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("T");'));?></td>
			</tr>
			<tr>
				<td colspan="10">&nbsp;</td>
			</tr>
			<tr>
				<td><?php echo $html->link('U','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("U");'));?></td>
				<td><?php echo $html->link('V','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("V");'));?></td>
				<td><?php echo $html->link('W','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("W");'));?></td>
				<td><?php echo $html->link('X','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("X");'));?></td>
				<td><?php echo $html->link('Y','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("Y");'));?></td>
				<td><?php echo $html->link('Z','javascript:void(0);',array('class'=>'alphabet-text','onclick'=>'search_alphabet("Z");'));?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<table border="0" width="100%">
			<tr>
				<td id="test_list"></td>
			</tr>
		</table>
	</div>
</div>


<?php echo $form->create('Search',array('url'=>'javascript:void(0);','id'=>'form1','name'=>'form1'));?>
<?php echo $form->hidden('Search.search_type',array('value'=>strtolower($search_type)));?>
<div style="padding:40px 0px 0px 0px; font-weight:bold; font-size:15px;">
	<div style="float:left;">Search <?php echo ucfirst($search_type);?> by Speciality :</div>
	<div style="clear:both; padding:30px 0px 0px 0px;">
		<?php echo $form->input('Search.speciality',array('type'=>'select','options'=>$speciality,'class'=>'input-text','label'=>false,'empty'=>'Select Speciality')); ?>
	</div>
</div>


<div style="padding:40px 0px 0px 0px; font-weight:bold; font-size:15px;">
	<div style="float:left;">Search <?php echo ucfirst($search_type);?> by Disease :</div>
	<div style="clear:both; padding:30px 0px 0px 0px;">
		<?php echo $form->input('Search.disease',array('type'=>'select','options'=>$diseases,'class'=>'input-text','label'=>false,'empty'=>'Select Disease')); ?>
	</div>
</div>


<div style="padding:40px 0px 0px 0px; font-weight:bold; font-size:15px;">
	<div style="float:left;">Search <?php echo ucfirst($search_type);?> by Code :</div>
	<div style="clear:both; padding:30px 0px 0px 0px;">
		<?php echo $form->input('Search.code',array('type'=>'select','options'=>$testcodes,'class'=>'input-text','label'=>false,'empty'=>'Select Code')); ?>
	</div>
</div>

<div style="padding:40px 0px 0px 0px; font-weight:bold; font-size:15px;">
	 <?php echo $form->submit('Search', array('div'=>false, 'class' => 'btn','onclick'=>'search_form();')); ?>
	 <div style="padding:10px 0px 0px 23px; display:none; float:left;" id="search_search"><?php echo $html->image('p_rocess.gif');?></div>
</div>

<?php echo $form->end();?>

<div style="padding:40px 0px 0px 0px; font-weight:bold; font-size:15px;" id="searched_data"></div>