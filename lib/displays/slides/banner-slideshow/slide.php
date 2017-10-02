<div class="ignite-slide<?php if ( $slide->get_index() === 0 ) echo ' active';?>">
	<div class="ignite-slide-image-wrapper">
		<div class="ignite-slide-image" style="background-image:url(<?php echo $slide->get_image_src( 'full' );?>);">
			<?php echo $slide->get_image_alt_text();?>
		</div>
	</div>
	<?php if( $slide->show_caption() ):?><div class="ignite-slide-caption-wrapper">
		<div class="ignite-slide-caption">
			<div class="ignite-slide-caption-inner">
				<div class="ignite-slide-caption-title">
					<?php echo $slide->get_title();?>
				</div>
				<div class="ignite-slide-caption-excerpt">
					<?php echo $slide->get_excerpt();?>
				</div>
			</div>
		</div>
	</div><?php endif;?>
	<?php if( ! empty( $slide->get_link() ) ):?><div class="ignite-slide-link-wrapper"><a href="<?php echo $slide->get_link();?>"><?php echo $slide->get_title();?></a></div><?php endif;?>
</div>