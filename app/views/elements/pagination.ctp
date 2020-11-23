<!-- Shows the page numbers -->
<?php echo $paginator->numbers(array('class' => 'pagination')); ?>&nbsp;&nbsp;Total : &nbsp;<?php echo $paginator->counter(array('format' => '%count%')); ?> Records
<!-- Shows the next and previous links -->
<?php
	//echo $paginator->prev('< Previous ', null, null, array('class' => 'disabled pagination'));
	//echo $paginator->next(' Next >', null, null, array('class' => 'disabled pagination'));
?> 
<!-- prints X of Y, where X is current page and Y is number of pages -->
<?php //echo $paginator->counter(array(
	//'format' => '&nbsp;(Page %page% of %pages%, showing %current% records out of
		//	 %count% total, starting on record %start%, ending on %end%)'
//)); ?>