<?php if ( ! empty( $args['menu'] ) ):?><div id="secondary-menu" class="default-secondary-menu">
	<nav class="banner-nav">
		<?php echo wp_nav_menu( array( 'menu' => $args['menu'] ) );?>	
	</nav>
</div><?php endif;?>