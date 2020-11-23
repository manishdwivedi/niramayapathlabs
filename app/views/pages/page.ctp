<table cellpadding="0" cellspacing="" width="100%" class="input-table">
<tr><td>
<h3><?php echo trim($data['Page']['title'])?></h3>
<?php 
	if(isset($data['Page']['content'])){
?>
<p class=""><?php echo trim($data['Page']['content'])?></p>
<?php
	}
?></td></tr></table>