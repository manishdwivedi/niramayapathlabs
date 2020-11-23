<script type="text/javascript">
<!--
	function toggleCheck(obj, cls){
		jQuery(cls).each(function(i, e){
			e.checked = obj.checked;
		});
	}

	function isChecked(cls, mainId){
		var check = 0;
		jQuery(cls).each(function(i, e){
			if(!e.checked){
				check++;
			}
		});
		mainObj = jQuery(mainId);
		if(check > 0){
			jQuery(mainObj).attr('checked', '');
		} else {
			jQuery(mainObj).attr('checked', 'checked');
		}
	}
//-->
</script>
<?php
	
		$time=date("F j, Y, g:i a"); 
?>

<div id="header">
    	<a href="<?php echo $html->url('/admin/admins/index');?>" class="logotext">Niramaya Healthcare</a> 
    	<div id="searcharea">
        	<div><?php //echo $html->link('View Front Website', '/', array('target' => '_blank', 'title' => 'View Front Website')); ?>
          		<div><span id="hour"><?php echo $time;?></span></div>
          	</div>
        </div>
</div>

<?php
	
?>