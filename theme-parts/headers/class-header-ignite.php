<?php

class Header_Ignite  extends Theme_Part_Ignite {
	
	protected $default_args = array(
		'type' => 'cahnrs-college',
		'active' => '',
		'college_global' => 1,
		'college_global_nav' => 0,
		'college_banner' => 1,
		'horiz_nav' => 0,
	);
	
	protected $settings = array(
		'type' => '_cahnrswp_header_type',
		'active' =>  '_cahnrswp_header_show_college_global_nav_active',
		'college_global' => '_cahnrswp_header_show_college_global',
		'college_global_nav' => '_cahnrswp_header_show_college_global_nav',
		'college_banner' => '_cahnrswp_header_display_banner',
		'horiz_nav' => '_cahnrswp_header_horizontal_nav',
	);
	
	
	public function the_header( $context = 'single', $args = array() ){
		
		$html = '';
		
		if ( is_active_sidebar( 'header_before' ) ) {
			
			ob_start();
			
			dynamic_sidebar( 'header_before' );
			
			$html .= '<div id="widget-area-header-before">' . ob_get_clean() .'</div>';
			
		} // End if
		
		$args = $this->get_customizer_args( $args );
		
		switch( $args['type'] ){
			
			case 'cahnrs-college':
				$html = $this->get_college_header( $context, $args );
				break;
			
		} // End switch
		
		if ( is_active_sidebar( 'header_after' ) ) {
			
			ob_start();
			
			dynamic_sidebar( 'header_after' );
			
			$html .= '<div id="widget-area-header-after">' . ob_get_clean() .'</div>';
			
		} // End if
		
		echo $html;
		
	} // End the_header
	
	
	protected function get_college_header( $context, $args ){
		
		$classes = array();

		if ( ! empty( $args['college_global_nav'] ) ){
			
			$classes[] = 'has-college-global-nav';
			
		} // End if
		
		ob_start();
		
		echo '<header id="site-header" class="' . implode( ' ', $classes ) . '">';
		
		if ( ! empty( $args['college_global'] ) ) {
	
			include locate_template( 'includes/headers/college/college-global-nav.php', false );
		
		} // end if
		
		if ( ! empty( $args['college_global_nav'] ) ) {
			
			include locate_template( 'includes/headers/college/college-global-navigation.php', false );
		
		} // end if
			
		if ( ! empty( $args['college_banner'] ) ) {
			
			include locate_template( 'includes/headers/college/college-banner.php', false );
		
		} // end if 
		
		if ( ! empty( $args['horiz_nav'] ) ){
			
			include locate_template( 'includes/headers/college/college-horizontal-menu.php', false );
			
		} // end if
		
		echo '</header>';
		
		$html = ob_get_clean();
		
		return $html;
		
		
	} // End get_college_header
	
	
} // End Headers_Ignite