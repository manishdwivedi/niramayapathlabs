

<ul class="pagingSerch" id="pagingUl">
            <?php echo $paginator->prev('Prev ', null, null,array('class' => 'backPg lft','id'=>'pageBack', 'style'=>'display:none;' )); ?>
			<?php echo $paginator->numbers(array('class' => 'actPg','separator'=>'', 'onlcick'=>'bookAtest.newPage(1);')); ?>
			<?php echo $paginator->next('Next', null, null,array('class' => 'nextPg rit','id'=>'pageNext', 'style'=>'display:none;' )); ?> 
 </ul>