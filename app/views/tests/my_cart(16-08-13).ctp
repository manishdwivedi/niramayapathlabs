
<?php //echo $javascript->link('jquery') ?>
<?php echo $javascript->link('jquery-1.4.4') ?>
<?php //echo $javascript->link('jquery.lightbox_me') ?>


    <script type="text/javascript">

//Already Registered Ligin Show Div Script Start	

function showDiv()
	{
		if(document.getElementById('headset-Div-Lab').style.display=='block')
		
		{	
			document.getElementById('headset-Div-Lab').style.display='none';
			document.getElementById('headset-Div').style.display='block';
			
			}
			
			else
			{
				document.getElementById('headset-Div').style.display='block';
				}
		
		
		}
		
	
	function hideDiv()
	{
		document.getElementById('headset-Div').style.display='none';
	}
	
	
function showDivLab()
	{
		if( document.getElementById('headset-Div').style.display=='block')
		{
			
			document.getElementById('headset-Div').style.display='none';
			document.getElementById('headset-Div-Lab').style.display='block';
			
			}
			
			else
			{
				document.getElementById('headset-Div-Lab').style.display='block';
				}
		
		
		}
		
	
	function hideDivLab()
	{
		document.getElementById('headset-Div-Lab').style.display='none';
	}	

</script>

<div class="banner"><?php echo $this->Html->image('frontend/niramaya_individual_test-2.jpg',array('alt'=>'Banner'))?></div>
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
          <div class="bread"><?php echo $this->Html->link('My Cart','/tests/my_cart');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
    
<h1>MY <span class="green">CART</span></h1>
<?php if(!empty($duplicate_test) && $duplicate_test == 'yes') {?>
<span style="font: normal 16px italic; position: absolute; top: 327px; left: 174px; color:#FF0000;">This test is already added in your cart.</span>
<?php }?>
<?php //echo $this->Session->flash(); ?>
      <div class="tableDiv">
       
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
          <th width="70" class="thDiv"><span>Code</span></th>
			<th width="530" class="thDiv"><span>Description</span></th>
            <th width="135" class="thDiv"><span style="margin:0 0 0 34px;">Reporting</span></th>
			<th width="135" class="thDiv"><span>Price</span></th>
			<th class="thDiv"><span style="margin:0 0 0 34px;">Action</span></th>
            </tr>
			<?php if(count($my_cart) > 0){?>
            <?php foreach($my_cart as $key => $val){?>
			<tr>
          		<td><?php echo $val['Cart']['test_code'];?></td>
          		<td style="text-align:left; padding-left:10px;"><?php echo $val['Cart']['test_parameter'];?></td>
          		<td><?php echo $val['Cart']['test_reporting'];?></td>
          		<td><div class="price"><span class="WebRupee">Rs. </span><?php echo $val['Cart']['test_mrp'];?></div></td>
          		<td><?php echo $html->link('DELETE',array('controller'=>'tests','action'=>'delete_cart_test',base64_encode($val['Cart']['test_id']),base64_encode($val['Cart']['test_code']),base64_encode($val['Cart']['test_parameter']),base64_encode($val['Cart']['test_reporting']),base64_encode($val['Cart']['test_mrp'])));?></td>
          	</tr>
          <?php }} else {?>
		  <tr>
		  	<td style="text-align:center;" colspan="5">Your Cart is Empty</td>
		  </tr>
		  <?php }?>
		  </table>
		  </div>
		  <div style="background:none repeat scroll 0 0 #FCFCFC;">
		  	<div style="width:475px; text-align:left; padding:10px; float:left;"><?php echo $html->link($html->image('frontend/add_another_test_or_profile_button-1.jpg'),'javascript:void(0);',array('escape'=>false,'onclick'=>'history.go(-1);'));?></div>
		 	<div style="width:479px; text-align:right; padding:10px; float:left;"><?php echo $html->link($html->image('frontend/proceed_for_booking_button-1.jpg'),'/tests/proceed_booking',array('escape'=>false));?></div>
		  </div>
          <?php
			//echo $this->element('pagination_test');
		?>
        
        
        
         
      