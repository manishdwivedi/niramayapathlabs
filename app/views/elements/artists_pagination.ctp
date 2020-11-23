<div class="page_numbering">
	<ul>
		<li style="border:0;"><?php echo $paginator->counter(array('format' => '&nbsp;Page %page% of %pages%')); ?></li>
		<li style="border:0;"><?php echo $paginator->prev($html->image('left_arrow.png'), array('escape' => false), null, null);?></li>
		<li style="border:0;"><?php echo $paginator->next($html->image('right_arrow.png'), array('escape' => false), null, null);?></li>
	</ul>
</div>




