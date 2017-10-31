<?php

class Header_Ignite  extends Theme_Part_Ignite {
	
	protected $default_args = array(
		'type' => 'cahnrs-college',
		'active' => '',
		'college_global' => 1,
		'college_global_nav' => 0,
		'college_banner' => 1,
		'horiz_nav' => 0,
		'cahnrs_global_top_bar' => 1,
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
				
			case 'default':
				$html .= $this->get_default_header( $context, $args );
				break;
			
			case 'cahnrs-college':
				$html .= $this->get_college_header( $context, $args );
				break;
			
		} // End switch
		
		if ( is_active_sidebar( 'header_after' ) ) {
			
			ob_start();
			
			dynamic_sidebar( 'header_after' );
			
			$html .= '<div id="widget-area-header-after">' . ob_get_clean() .'</div>';
			
		} // End if
		
		echo apply_filters( 'cahnrs_ignite_page_html', $html );
		
	} // End the_header
	
	
	protected function get_default_header( $context, $args ){
		
		$classes = array();
		
		$default_header_args = array(
			'cahnrswp_global_top_bar' 	=> get_theme_mod('_cahnrswp_global_top_bar', 1),
			'college_banner' 			=> get_theme_mod('_cahnrswp_header_display_banner', 1),
			'horiz_nav' 				=> get_theme_mod('_cahnrswp_header_horizontal_nav', 0),
			'has_search' 				=> get_theme_mod('_cahnrswp_header_include_search', 0),
		);
		
		$args = array_merge( $args, $default_header_args );
		
		if ( $args['horiz_nav'] ) $classes[] = 'has-horiz-nav';
		
		if ( $args['has_search'] ) $classes[] = 'has-search';
		
		$html = '<header id="site-header" class="' . implode( ' ', $classes ) . '">';
		
		ob_start();
		
		if ( ! empty( $args['cahnrswp_global_top_bar'] ) ) {
	
			include ignite_get_theme_path( 'lib/parts/page-headers/top-header-bar.php');
		
		} // end if
		
		if ( ! empty( $args['college_banner'] ) ) {
			
			echo '<div class="ignite-header-banner-wrapper">';
			
			include ignite_get_theme_path( 'lib/parts/page-headers/header-banner.php');
			
			if ( ! empty( $args['has_search'] ) ) {
			
				include ignite_get_theme_path( 'lib/parts/search/basic-search.php');
				
			} // End if
			
			echo '</div>';
		
		} // end if
		
		if ( ! empty( $args['horiz_nav'] ) ){
			
			include locate_template( 'includes/headers/college/college-horizontal-menu.php', false );
			
		} // end if
		
		$html .= ob_get_clean();
		
		$html .= '</header>';
		
		return $html;
		
	} // End 
	
	
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