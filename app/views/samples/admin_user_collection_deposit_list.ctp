
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>

<script type="text/javascript">
function show_detail(id)
{
	window.open(siteUrl+"admin/samples/print_collection_detail/"+id,'name','height=500,width=800,scrollbars=yes');
}
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Collection Deposit List(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Collection Deposit List(s)
	<div>&nbsp;</div>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		
	<thead>
		<tr>
			<th width="2%"><h4>S.No.</h4></th>
			<th>Collection on</th>
			<th>Total Amount</th>
			<th>Cash Amount</th>
			<th>Cheque/DD Amount</th>
			<th>Credit Card Amount</th>
			<th>Adj/Refund</th>
			<th>Cash Deposited</th>
			<th>Cheque/DD Deposited</th>
			<th>Credit Card Deposited</th>
			<th>Total Deposited</th>
			<th>Total Variation</th>
			<th>Print</th>
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
	
	<tr>
	<!--<?php echo $html->link(null,array('url'=>'/admin/samples/user_collection_deposit_list/save_detail'));?>-->
		
		<td style="text-align:center; border-bottom:1px solid #666666; border-left:1px solid #666666; border-right:1px solid #666666;">
			<?php										
				echo ($ctr+1);
			?>
		</td>
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
		<!--<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php //echo $html->link('Submit',  array('action'=>'/print_collection_detail/MzM=')); ?></td>-->
		<td style="text-align:center; border-bottom:1px solid #666666; border-right:1px solid #666666;"><a href="javascript:void(0);" onclick="show_detail('<?php echo $all_stats[$ctr]['UserCollectionReport']['id'];?>');" style="text-decoration:none;">Print</a></td>
</td>
		
	</tr>
	<?php }?>
	
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
<!--echo $html->link->end();-->
</div>