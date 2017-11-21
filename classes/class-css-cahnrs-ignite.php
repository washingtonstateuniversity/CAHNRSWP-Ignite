<?php

class CSS_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'wp_head', array( $this, 'wp_head'), 98 );
		
		add_filter( 'body_class', array( $this, 'filter_body_class' ) ); 
		
		
	} // end __construct
	
	
	public function wp_head(){
		
		$css_array = array();
		
		$css_array = $this->add_header_css( $css_array );
		
		$css_array = $this->add_theme_css( $css_array );
		
		$css_array = $this->add_secondary_menu_css( $css_array );
		
		echo '<style>' . $this->css_to_string( $css_array ) . '</style>';
		
	} // end wp_footer
	
	
	private function add_secondary_menu_css( $css_array ){
		
		$cahnrswp_secondary_menu_bg_color = get_theme_mod( '_cahnrswp_secondary_menu_bg_color', '' );
		$cahnrswp_secondary_menu_font_color = get_theme_mod( '_cahnrswp_secondary_menu_font_color', '' );
		
		$css = array(
			array( '#secondary-menu', 'background-color', $cahnrswp_secondary_menu_bg_color ),
			array( '#secondary-menu:before', 'background-color', $cahnrswp_secondary_menu_bg_color ),
			array( '#secondary-menu:after', 'background-color', $cahnrswp_secondary_menu_bg_color ),
			array( '#secondary-menu .menu > .menu-item a', 'color', $cahnrswp_secondary_menu_font_color ),
		);
		
		foreach( $css as $instance ){
			
			$css_array = $this->add_css_property( $css_array, $instance[0], $instance[1], $instance[2] );
			
		} // end foreach
		
		
		return $css_array;
		
	} // End add_secondary_menu_css
	
	
	private function add_header_css( $css_array ){
		
		$cahnrswp_header_bg_color = get_theme_mod( '_cahnrswp_header_bg_color', '' );
		$cahnrswp_header_bg_image_size = get_theme_mod( '_cahnrswp_header_bg_image_size', '' );
		$cahnrswp_header_bg_image_position = get_theme_mod( '_cahnrswp_header_bg_image_position', '' );
		$cahnrswp_header_bg_image = get_theme_mod( '_cahnrswp_header_bg_image', '' );
		$college_global_nav_bg_color = get_theme_mod( '_cahnrswp_header_college_global_nav_bg_color', '' );
		$college_global_nav_text_color = get_theme_mod( '_cahnrswp_header_college_global_nav_text_color', '' );
		$cahnrswp_header_banner_text_color = get_theme_mod( '_cahnrswp_header_banner_text_color', '' ); 
		$cahnrswp_header_horizontal_nav_text_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_text_color', '' );
		$cahnrswp_header_horizontal_nav_bg_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_bg_color', '' );
		$cahnrswp_header_horizontal_nav_link_active_text_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_link_active_text_color', '' );
		$cahnrswp_header_horizontal_nav_link_active_bg_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_link_active_bg_color', '' );
		$cahnrswp_header_horizontal_nav_link_hover_text_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_link_hover_text_color', '' );
		$cahnrswp_header_horizontal_nav_link_hover_bg_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_link_hover_bg_color', '' );
		$cahnrswp_global_top_bar_bg_color = get_theme_mod( '_cahnrswp_global_top_bar_bg_color', '' );
		$cahnrswp_global_top_bar_text_color = get_theme_mod( '_cahnrswp_global_top_bar_text_color', '' );
		$cahnrswp_header_search_color = get_theme_mod( '_cahnrswp_header_search_color', '' );
		
		$css = array(
			array( '#site-header', 'background-image', 'url(' . $cahnrswp_header_bg_image . ')' ),
			array( '#site-header', 'background-color', $cahnrswp_header_bg_color ),
			array( '#site-header:before', 'background-color', $cahnrswp_header_bg_color ),
			array( '#site-header:after', 'background-color', $cahnrswp_header_bg_color ),
			array( '#site-header', 'background-size', $cahnrswp_header_bg_image_size ),
			array( '#site-header', 'background-position', $cahnrswp_header_bg_image_position ),
			array( '#college-global-header, #global-top-header-bar', 'background-color', $college_global_nav_bg_color ),
			array( '#college-global-header:before, #global-top-header-bar:before', 'background-color', $college_global_nav_bg_color ),
			array( '#college-global-header:after, #global-top-header-bar:after', 'background-color', $college_global_nav_bg_color ),
			array( '#college-global-nav > ul > li > a.active:after', 'border-top-color', $college_global_nav_bg_color ),
			array( '#college-global-header', 'color', $college_global_nav_text_color ),
			array( '#college-global-actions a:before', 'background-color', $college_global_nav_text_color ),
			array( '#college-header-banner .site-logo-text span a', 'color', $cahnrswp_header_banner_text_color ),
			array( '#college-header-horiz-menu ul.menu > li > a', 'color', $cahnrswp_header_horizontal_nav_text_color ),
			array( '#college-header-horiz-menu.has-dividers ul.menu > li > a:after', 'background-color', $cahnrswp_header_horizontal_nav_text_color ),
			array( '#college-header-horiz-menu', 'background-color', $cahnrswp_header_horizontal_nav_bg_color ),
			array( '#college-header-horiz-menu:before', 'background-color', $cahnrswp_header_horizontal_nav_bg_color ),
			array( '#college-header-horiz-menu:after', 'background-color', $cahnrswp_header_horizontal_nav_bg_color ),
			array( '#college-header-horiz-menu ul.menu > li.current-menu-item > a', 'color', $cahnrswp_header_horizontal_nav_link_active_text_color ),
			array( '#college-header-horiz-menu ul.menu > li.current-menu-parent > a', 'color', $cahnrswp_header_horizontal_nav_link_active_text_color ),
			array( '#college-header-horiz-menu ul.menu > li.current-menu-item > a', 'background-color', $cahnrswp_header_horizontal_nav_link_active_bg_color ),
			array( '#college-header-horiz-menu ul.menu > li.current-menu-parent > a', 'background-color', $cahnrswp_header_horizontal_nav_link_active_bg_color ),
			array( '#college-header-horiz-menu ul.menu > li:hover > a', 'color', $cahnrswp_header_horizontal_nav_link_hover_text_color ),
			array( '#college-header-horiz-menu ul.menu > li:hover > a', 'background-color', $cahnrswp_header_horizontal_nav_link_hover_bg_color ),
			array( '#global-top-header-bar', 'background-color', $cahnrswp_global_top_bar_bg_color),
			array( '#global-top-header-bar:before', 'background-color', $cahnrswp_global_top_bar_bg_color ),
			array( '#global-top-header-bar:after', 'background-color', $cahnrswp_global_top_bar_bg_color ),
			array( '#global-top-header-bar', 'color', $cahnrswp_global_top_bar_text_color ),
			array( '#global-top-header-bar .top-header-bar-secondary-nav a:before', 'background-color', $cahnrswp_global_top_bar_text_color ),
			array( '#global-top-header-bar .top-header-bar-primary-nav .menu li:before', 'background-color', $cahnrswp_global_top_bar_text_color ),
			array( '#global-top-header-bar .top-header-bar-secondary-nav .menu li:before', 'background-color', $cahnrswp_global_top_bar_text_color ),
			array( '.cahnrs-ignite-search-form.basic-search-form .ignite-search-form-field-submit', 'background-color', $cahnrswp_header_search_color ),
		);
		
		foreach( $css as $instance ){
			
			$css_array = $this->add_css_property( $css_array, $instance[0], $instance[1], $instance[2] );
			
		} // end foreach
		
		return $css_array;
		
	} // end get_header_css
	
	
	public function filter_body_class( $classes ){
		
		$cahnrswp_theme_use_spine = get_theme_mod( '_cahnrswp_theme_use_spine', '' );
		
		$cahnrswp_theme_use_spine_mobile = get_theme_mod( '_cahnrswp_theme_use_spine_mobile', '' );
		
		$cahnrswp_header_horizontal_nav_mobile = get_theme_mod( '_cahnrswp_header_horizontal_nav_mobile', '' );
		
		if ( $cahnrswp_theme_use_spine == 'disable' ){
			
			$classes[] = 'disable-spine';
			
		} // end if
		
		if ( $cahnrswp_header_horizontal_nav_mobile ) {
			
			$classes[] = 'hide-horiz-nav-mobile';
			
		} // End if
		
		if ( $cahnrswp_theme_use_spine_mobile === 'enable' ){
			
			$classes[] = 'enable-spine-mobile';
			
		} // End if
		
		$is_cropped = ( function_exists( 'spine_get_option' ) && ( true === spine_get_option( 'crop' ) && is_front_page() ) ) ? true : false;
		
		if ( get_theme_mod( '_cahnrs_ignite_global_cropped_spine', false ) ){
			
			$is_cropped = true;
			
		} // End if
		
		if ( ( 'disable' === $cahnrswp_theme_use_spine ) || $is_cropped ) {
	
			$classes[] = 'full-width-content';
			
		} // End if
		
		return $classes;
		
	} // end filter_body_class
	
	
	private function add_theme_css( $css_array ){
		
		$cahnrswp_theme_bg_color = get_theme_mod( '_cahnrswp_theme_bg_color', '#fff' );
		
		$css = array(
			array( 'html', 'background-color', $cahnrswp_theme_bg_color ),
			array( 'body', 'background-color', $cahnrswp_theme_bg_color ),
			array( 'body:not(.has-background-image)', 'background-color', $cahnrswp_theme_bg_color ),
			array( '#site-content', 'background-color', $cahnrswp_theme_bg_color ),
			array( '#site-content:before', 'background-color', $cahnrswp_theme_bg_color ),
			array( '#site-content:after', 'background-color', $cahnrswp_theme_bg_color ),
		);
		
		foreach( $css as $instance ){
			
			$css_array = $this->add_css_property( $css_array, $instance[0], $instance[1], $instance[2] );
			
		} // end foreach
		
		return $css_array;
		
	} // end add_theme_css
	
	
	protected function add_css_property( $css_array, $selector, $property_name, $property_value, $check_property = true ){
		
		// Check and make sure there is a value to add
		if ( $check_property && ! $this->is_set( $property_value ) ){
			
			return $css_array;
			
		} // end if
		
		// Check if selector exists - if not add as empty array
		if ( ! array_key_exists( $selector, $css_array ) ){
			
			$css_array[ $selector ] = array();
			
		} // end if
		
		$css_array[ $selector ][] = $property_name . ':' . $property_value;
		
		return $css_array;
		
	} // end add_css_property
	
	
	private function is_set( $value ){
		
		if ( $value !== '' && $value != 'default' ) {
			
			return true;
			
		} // end if
		
		return false;
		
	} // end is_set
	
	
	protected function css_to_string( $css ){
		
		$style = '';
		
		foreach( $css as $selector => $values ){
			
			// check for values before doing anything
			if ( ! empty( $values ) ){
				
				$style_values = implode( '; ', $values );
				
				$style .= $selector . ' {' . $style_values . '} ';
				
			} // end if
			
		} // end foreach
		
		return $style;
		
	} // end css_to_string
	
	
} // end CSS_CAHNRS_Ignite

$css_cahnrs_ignite = new CSS_CAHNRS_Ignite();