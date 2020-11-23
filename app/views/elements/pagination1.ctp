
<div class="pages">
 <?php echo $paginator->first('First');?>
<?php //echo $paginator->prev('< < ', null, null, array('class' => 'disabled pagination'));?>   

<?php echo $paginator->prev('<< ', null, null,array('class' => 'disabled')); ?>  

<!-- Shows the page numbers -->

<?php echo $paginator->numbers(array('class' => 'page','separator'=>'')); ?>
<!-- Shows the next and previous links -->
<!-- <span style="background:none; color:#444444; font-size:24px;"> ...   </span>
--><?php //echo $paginator->counter(array('format' => '&nbsp;(Page %page% of %pages%, showing %current% records out of
			// %count% total, starting on record %start%, ending on %end%)'
//)); ?>
<?php //echo $paginator->next(' > >', null, null, array('class' => 'disabled pagination'));?>
           
<?php echo $paginator->next('>>', null, null,array('class' => 'disabled')); ?> 

<?php echo $paginator->last('Last');?>
</div>