<div id="banner-menu" class="full-banner">
	<div class="banner-image-wrapper" style="background-image:url(<?php echo $args['image'];?>)">
	</div>
	<div class="banner-inner-wrapper">
		<?php if ( ! empty( $args['menu'] ) ):?><nav class="banner-nav">
		<?php echo wp_nav_menu( array( 'menu' => $args['menu'] ) );?>
		</nav><?php endif;?>
	</div>
</div>