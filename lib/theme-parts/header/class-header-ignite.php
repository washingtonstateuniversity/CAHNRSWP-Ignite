<?php

class Header_Ignite extends Abstract_Theme_Part {
	
	
	protected $ctmzr_fields = array(
		'_cahnrswp_global_top_bar' 							=> 1,
		'_cahnrswp_header_type' 							=> 'cahnrs-college',
		'_cahnrswp_header_show_college_global_nav_active' 	=> '',
		'_cahnrswp_header_show_college_global' 				=> 1,
		'_cahnrswp_header_show_college_global_nav' 			=> 0,
		'_cahnrswp_header_display_banner' 					=> 1,
		'_cahnrswp_header_horizontal_nav' 					=> 0,
		'_cahnrswp_footer_type' 							=> '',
		'_cahnrswp_header_include_search'					=> 0,
		'_cahnrswp_header_horizontal_nav_show_divider'		=> 0,
		'_cahnrswp_header_banner_img'						=> '',
		'_cahnrswp_header_banner_show_subhead'				=> 1,
	);
	
	
	public function get_the_part( $context = 'single', $args = array() ){
		
		$html = '';
		
		$html .= ignite_get_widget_area( 'header_before', 'header-before' );
		
		$settings = $this->get_settings( $this->ctmzr_fields, $args );
		
		switch ( $settings['_cahnrswp_header_type' ] ){
				
			case 'default':
				$html .= $this->get_default_header( $settings, $context, $args );
				break;
			
			case 'cahnrs-college':
				$html .= $this->get_college_header( $settings, $context, $args );
				break;
				
		} // End switch
		
		$html .= ignite_get_widget_area( 'header_after', 'header-after' );
		
		return $html;
		
	} // End get_the_part
	
	
	
	protected function get_default_header( $settings, $context, $args ){
		
		$classes = array();
		
		/*$default_header_args = array(
			'cahnrswp_global_top_bar' 	=> get_theme_mod('_cahnrswp_global_top_bar', 1),
			'college_banner' 			=> get_theme_mod('_cahnrswp_header_display_banner', 1),
			'horiz_nav' 				=> get_theme_mod('_cahnrswp_header_horizontal_nav', 0),
			'has_search' 				=> get_theme_mod('_cahnrswp_header_include_search', 0),
		);*/
		
		//$args = array_merge( $args, $default_header_args );
		
		if ( $settings['_cahnrswp_header_horizontal_nav'] ) $classes[] = 'has-horiz-nav';
		
		if (  $settings['_cahnrswp_header_include_search'] ) $classes[] = 'has-search';
		
		$html = $this->get_template_parts();
		
		$html .= '<header id="site-header" class="' . implode( ' ', $classes ) . '">';
		
		$html .= $this->get_global_top_bar( $settings );
		
		$html .= $this->get_header_banner( $settings );
		
		$html .= $this->get_horiz_nav( $settings );
		
		//ob_start();
		
		//if ( ! empty( $args['cahnrswp_global_top_bar'] ) ) {
	
			//include ignite_get_theme_path( 'lib/parts/page-headers/top-header-bar.php');
		
		//} // end if
		
		/*if ( ! empty( $args['college_banner'] ) ) {
			
			echo '<div class="ignite-header-banner-wrapper">';
			
			include ignite_get_theme_path( 'lib/parts/page-headers/header-banner.php');
			
			if ( ! empty( $args['has_search'] ) ) {
			
				include ignite_get_theme_path( 'lib/parts/search/basic-search.php');
				
			} // End if
			
			echo '</div>';
		
		} // end if*/
		
		/*if ( ! empty( $args['horiz_nav'] ) ){
			
			include locate_template( 'includes/headers/college/college-horizontal-menu.php', false );
			
		} // end if
		
		$html .= ob_get_clean();*/
		
		$html .= '</header>';
		
		return $html;
		
	} // End 
	
	
	protected function get_college_header( $settings, $context, $args ){
		
		$classes = array();
		
		if ( $settings['_cahnrswp_header_show_college_global_nav'] ) $classes[] = 'has-college-global-nav';
		
		$html = $this->get_template_parts();

		$html .= '<header id="site-header" class="' . implode( ' ', $classes ) . '">';
		
		$html .= $this->get_college_top_bar( $settings );
		
		$html .= $this->get_college_global_nav( $settings, false, $args );
		
		$html .= $this->get_college_header_banner( $settings );
		
		$html .= $this->get_college_horiz_nav( $settings );
		
		$html .= '</header>';
		
		return $html;
		
	} // End get_college_header
	
	
	protected function get_global_top_bar( $settings, $force_display = false ){
		
		$html = '';
		
		if ( ! empty( $settings['_cahnrswp_global_top_bar'] ) || $force_display ){
			
			ob_start();
			
			include ignite_get_theme_path( 'lib/parts/page-headers/top-header-bar.php');
			
			$html .= ob_get_clean();
			
		} // End if
		
		return $html;
		
	} // End get_global_top_bar
	
	
	protected function get_college_top_bar( $settings, $force_display = false, $args = array() ){
		
		$html = '';
		
		if ( ! empty( $settings['_cahnrswp_header_show_college_global'] ) || $force_display ){
			
			ob_start();
			
			include ignite_get_theme_path( 'includes/headers/college/college-global-nav.php');
			
			$html .= ob_get_clean();
			
		} // End if
		
		return $html;
		
	} // End get_global_top_bar
	
	
	protected function get_college_global_nav( $settings, $force_display = false ){
		
		$html = '';
		
		if ( ! empty( $settings['_cahnrswp_header_show_college_global_nav'] ) || $force_display ){
			
			ob_start();
			
			include ignite_get_theme_path( 'includes/headers/college/college-global-navigation.php');
			
			$html .= ob_get_clean();
			
		} // End if
		
		return $html;
		
	} // End get_global_top_bar
	
	
	protected function get_header_banner( $settings, $force_display = false ){
		
		$html = '';
		
		if ( ! empty( $settings['_cahnrswp_header_display_banner'] ) || $force_display ){
			
			$html .= '<div class="ignite-header-banner-wrapper">';
			
			ob_start();
			
			include ignite_get_theme_path( 'lib/parts/page-headers/header-banner.php');
			
			if ( ! empty( $settings['_cahnrswp_header_include_search'] ) ) {
			
				include ignite_get_theme_path( 'lib/parts/search/basic-search.php');
				
			} // End if
			
			$html .= ob_get_clean();
			
			$html .= '</div>';
			
		} // End if
		
		return $html;
		
	} // End get_global_top_bar
	
	
	protected function get_college_header_banner( $settings, $force_display = false ){
		
		$html = '';
		
		if ( ! empty( $settings['_cahnrswp_header_display_banner'] ) || $force_display ){
			
			ob_start();
			
			include ignite_get_theme_path( 'lib/displays/headers/banners/college.php');
			
			$html .= ob_get_clean();
			
		} // End if
		
		return $html;
		
	} // End get_global_top_bar
	
	
	protected function get_college_horiz_nav( $settings, $force_display = false ){
		
		$html = '';
		
		if ( ! empty( $settings['_cahnrswp_header_horizontal_nav'] ) || $force_display ){
			
			ob_start();
			
			include ignite_get_theme_path( 'includes/headers/college/college-horizontal-menu.php');
			
			$html .= ob_get_clean();
			
		} // End if
		
		return $html;
		
	} // End get_global_top_bar
	
	
	protected function get_horiz_nav( $settings, $force_display = false ){
		
		$html = '';
		
		if ( ! empty( $settings['_cahnrswp_header_horizontal_nav'] ) || $force_display ){
			
			ob_start();
			
			include ignite_get_theme_path( 'includes/headers/college/college-horizontal-menu.php', false );
			
			$html .= ob_get_clean();
			
		} // End if
		
		return $html;
		
	} // End get_global_top_bar
	
	
	protected function get_template_parts(){
		
		ob_start();
		
		include ignite_get_theme_path( 'includes/headers/header.php' );

		include ignite_get_theme_path( 'includes/main/main-start.php' );
		
		return ob_get_clean();
		
	} // End get_template_parts
	
	
} // End Header_Ignite