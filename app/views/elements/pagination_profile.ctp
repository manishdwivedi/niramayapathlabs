<div id="pagination">
<?php echo $paginator->first('Prev');?>
      <?php echo $paginator->numbers(array('class' => 'pagination','separator'=>'')); ?>
      <?php echo $paginator->last('Next');?>
      </div>