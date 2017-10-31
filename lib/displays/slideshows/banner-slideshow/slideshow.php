<div class="ignite-slideshow banner-slideshow <?php echo $slideshow['height_class'];?>" data-isauto="<?php echo $slideshow['isauto'];?>" data-speed="<?php echo $slideshow['speed'];?>" data-delay="<?php echo $slideshow['delay'];?>">
	<div class="ignite-slideshow-slides-wrapper">
		<?php echo $slides_html;?>
	</div>
	<?php if( $slideshow['show_nav'] ):?><div class="ignite-slideshow-nav-wrapper <?php echo $slideshow['height_class'];?>">
		<?php echo $slide_nav_html;?>
	</div><?php endif;?>
</div>