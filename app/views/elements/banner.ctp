<?php echo $javascript->link('jquery.easing.1.3.min'); ?>
<?php echo $javascript->link('jquery.mousewheel.min'); ?>
<?php echo $javascript->link('jquery.sliderkit.1.9.2.pack'); ?>
<?php echo $javascript->link('sliderkit.counter.1.0.pack'); ?>
<?php echo $javascript->link('sliderkit.timer.1.0.pack'); ?>
<script type="text/javascript">
	$(window).load(function(){ //$(window).load() must be used instead of $(document).ready() because of Webkit compatibility				
		
		// Photo gallery > Standard
		$("#standardPhotosgallery").sliderkit({
			mousewheel:false,
			shownavitems:5,
			//navfx:"none",
			panelbtnshover:true,
			auto:true,
			circular:true,
			navscrollatend:true,
			counter:false
		});
		
		
		
	});	
</script>
<?php echo $html->css('sliderkit-core');?>
<?php echo $html->css('sliderkit-demos');?>



<div class="bodycontainer_inner_row1">
        <!-- Start photosgallery-std -->
				<div id="standardPhotosgallery" class="sliderkit photosgallery-std">
					<div class="sliderkit-nav">
						<div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-prev"><a rel="nofollow" href="#" title="Previous line"><span>Previous line</span></a></div>

						<div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-next"><a rel="nofollow" href="#" title="Next line"><span>Next line</span></a></div>
						
						<div class="sliderkit-nav-clip">
							<ul>
								<?php foreach($banners as $key=>$value) {?>
								<li><?php echo $html->link($html->image(BANNER_IMAGE_THUMB_URL.$value['Banner']['himage'],array('alt'=>$value['Banner']['BannerTitle'],'width'=>75,'height'=>50)),'#',array('escape'=>false));?></li>
								<?php }?>
							</ul>
						</div>
					</div>
					<div class="sliderkit-panels">
						<div class="sliderkit-btn sliderkit-go-btn sliderkit-go-prev"><a rel="nofollow" href="#" title="Previous"><span>Previous</span></a></div>
						<div class="sliderkit-btn sliderkit-go-btn sliderkit-go-next"><a rel="nofollow" href="#" title="Next"><span>Next</span></a></div>

						<?php foreach($banners as $key=>$value) {?>
						<div class="sliderkit-panel">
							<?php echo $html->link($html->image(BANNER_IMAGE_THUMB_URL.$value['Banner']['himage'],array('width'=>991,'height'=>322)),$value['Banner']['link_url'],array('escape'=>false));?>
						</div>
						<?php }?>
					</div>
				</div>
				<!-- // end of photosgallery-std -->
</div>