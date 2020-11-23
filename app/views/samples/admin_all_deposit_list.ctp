
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		dateFormat: 'dd-mm-yy'
	});
});




function delete_row(val)
{

	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/delete_row_collection?id='+val,
		dataType:'json',
		success:function(data){
			$('#RowId_'+val).hide();
			$('#RequestId_'+val).hide();
		},
		beforeSend:function(){
			jQuery('#ReqId_'+val).show();
		},
	});
}

function show_detail(id)
{
	window.open(siteUrl+"admin/samples/print_collection_detail/"+id,'name','height=500,width=800,scrollbars=yes');
}

</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>All Collection Deposit List(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;All Collection Deposit List(s)
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/samples/all_deposit_list','id'=>'formreport','name'=>'formreport')); ?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		
	<thead>
		<tr>
			<td colspan="12">
				<table border="0" width="100%">
					<tr>
						<td width="30"><?php echo $form->text('SalesReport.from_date',array('class'=>'input-Search datepicker','placeholder'=>'From Date'));?></td>
						<td width="30"><?php echo $form->text('SalesReport.to_date',array('class'=>'input-Search datepicker','placeholder'=>'To Date'));?></td>
						<td width="30">
							<?php if(empty($select_user)) {?>
							<select name="data[SalesReport][admin_list_id]" class="input-Search">
								<option value="">Select User</option>
								<?php foreach($get_all_user as $all_key => $all_val){?>
								<option value="<?php echo $all_val['Admin']['id'];?>"><?php echo $all_val['Admin']['name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[SalesReport][admin_list_id]" class="input-Search">
								<option value="">Select User</option>
								<?php foreach($get_all_user as $all_key => $all_val){?>
								<option value="<?php echo $all_val['Admin']['id'];?>" <?php if($select_user == $all_val['Admin']['id']){?> selected="selected" <?php }?>><?php echo $all_val['Admin']['name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th style="text-align:center;">User</th>
			<th style="text-align:center;">Collection on</th>
			<th style="text-align:center;">Total Amount</th>
			<th style="text-align:center;">Cash Amount</th>
			<th style="text-align:center;">Cheque/DD Amount</th>
			<th style="text-align:center;">Credit Card Amount</th>
			<th style="text-align:center;">Adj/Refund</th>
			<th style="text-align:center;">Cash Deposited</th>
			<th style="text-align:center;">Cheque/DD Deposited</th>
			<th style="text-align:center;">Credit Card Deposited</th>
			<th style="text-align:center;">Total Deposited</th>
			<th style="text-align:center;">Total Variation</th>
             <th style="text-align:center;">Print</th>
			<th style="text-align:center;">Delete</th>
			
		</tr>
	</thead>
	<?php
		if(isset($all_stats) && count($all_stats) > 0){
			$countRequest = count($all_stats);
			for($ctr=0;$ctr<$countRequest;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
			
	?>
	
	<tr id="RowId_<?php echo $all_stats[$ctr]['UserCollectionReport']['id'];?>">
		
		<td style="text-align:center; border-bottom:1px solid #666666; border-left:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['admin_name'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo date('M d, Y',strtotime($all_stats[$ctr]['UserCollectionReport']['report_date']))?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['upper_total_amount'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['upper_cash_amount'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['upper_cheque_amount'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['upper_credit_card_amount'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['adjustment_amount'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['total_cash'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['total_cheque'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['total_credit_card'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['total_deposit'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $all_stats[$ctr]['UserCollectionReport']['total_variation'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><a href="javascript:void(0);" onclick="show_detail('<?php echo $all_stats[$ctr]['UserCollectionReport']['id'];?>');" style="text-decoration:none;">Print</a></td>
	<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><a href="javascript:void(0);" onclick="delete_row(<?php echo $all_stats[$ctr]['UserCollectionReport']['id'];?>);"><?php echo $html->image('cross.png',array('alt'=>'Delete Row','title'=>'Delete Row'));?></a><br /><span id="ReqId_<?php echo $all_stats[$ctr]['UserCollectionReport']['id'];?>" style="display:none;"><?php echo $html->image('admin/p_rocess.gif',array('style'=>'height:5px; width:30px;'));?></span></td>
		
	</tr>
	<?php }?>
	<tr>
		
		<td style="text-align:center; border-left:1px solid #666666; border-bottom:1px solid #666666; border-right:1px solid #666666;">&nbsp;</td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;">&nbsp;</td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $total_amt;?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $total_cash_amt;?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $total_cheque_amt;?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $total_credit_amt;?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $total_adjustment;?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $total_cash_deposit;?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $total_cheque_deposit;?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $total_credit_deposit;?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $total_amt_deposit;?></td>
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><?php echo $total_variant;?></td>
		
	</tr>
	<tr>
		<td colspan="14" style="font-weight:bold; text-align:right;">
		<?php
			echo $this->element('pagination');
		?>
		</td>
	</tr>
	<?php
		} else {
	?>
	<tr>
		<td colspan="13" class="flash_failure" style=" float:none;">No records found.</td>
	</tr>
	<?php
		}
	?>
	
</table>
	<?php echo $form->end();?>
</div>