<!--footer div start here-->

<div class="footer">
	<div class="footer_inner">
    	<div class="footer_inner_top">
        	<ul> 
            	<li><?php echo $html->link(__('CONTACT_US',true),array('controller'=>'pages','action'=>'contact'));?></li>
                <li><?php echo $html->link(__('FAQ',true),array('controller'=>'pages','action'=>'faq'));?></li>
                <li><?php echo $html->link(__('PRIVACY',true),array('controller'=>'pages','action'=>'privacy'));?></li>
                <li class="last"><?php echo $html->link(__('TERMS_AND_CONDITION',true),array('controller'=>'pages','action'=>'terms'));?></li>
            </ul>
            <p>
				<?php echo $html->link($html->image("facebook.png"), '#' , array('escape' => false));?>
				<?php echo $html->link($html->image("linkedin.png"), '#' , array('escape' => false));?>
				<?php echo $html->link($html->image("twitter.png"), '#' , array('escape' => false));?>
            </p>
        </div>
        <div class="footer_inner_bottom">
        	<p>&copy; artbank 2012</p>
        </div>
    </div>
</div>

<!--footer div end   here-->