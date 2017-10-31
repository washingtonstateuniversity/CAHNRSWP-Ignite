<div class="ignite-slide <?php echo $slideshow['height_class'];?><?php if ( $slide['index'] === 0 ) echo ' active';?>">
	<div class="ignite-slide-image-wrapper">
		<div class="ignite-slide-image" style="background-image:url(<?php echo $slide['image'];?>);">
			<?php echo $slide['alt'];?>
		</div>
	</div>
	<?php if( $slideshow['show_caption'] ):?><div class="ignite-slide-caption-wrapper">
		<div class="ignite-slide-caption">
			<div class="ignite-slide-caption-inner">
				<div class="ignite-slide-caption-title">
					<?php echo $slide['title'];?>
				</div>
				<div class="ignite-slide-caption-excerpt">
					<?php echo $slide['excerpt'];?>
				</div>
			</div>
		</div>
	</div><?php endif;?>
	<?php if( ! empty( $slide['link'] ) ):?><div class="ignite-slide-link-wrapper"><a href="<?php echo $slide['link'];?>"><?php echo $slide['title'];?></a></div><?php endif;?>
</div>