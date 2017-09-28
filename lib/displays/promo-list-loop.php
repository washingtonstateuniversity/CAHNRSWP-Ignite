<div class="<?php echo implode( ' ', $classes ); ?>">
	<?php if ( $image ):?><div class="image-wrapper" style="background-image:url(<?php echo $image['src'];?>)">
	</div><?php endif;?>
	<div class="caption-wrapper">
		<div class="item-title">
			<h3><?php the_title();?></h3>
		</div>
		<div class="item-excerpt">
			<?php echo wp_trim_words( get_the_excerpt(), 25 );?>
		</div>
	</div>
	<div class="link-wrapper"><a href="<?php echo get_post_permalink( get_the_ID() );?>">Learn more about <?php the_title();?></a></div>
</div>