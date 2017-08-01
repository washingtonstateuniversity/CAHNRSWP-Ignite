<?php

class Page_Banner_CAHNRS_Ignite extends Theme_Part_Ignite {
	
	protected $default_args = array(
		'type' 		=> 'dynamic-scroll',
		'menu' 		=> '',
		'image' 	=> '',
		'parallax' 	=> 1,
	);
	
	protected $settings = array(
	);
	
	public function the_banner( $context = 'single', $args = array(), $post_id = false ){
		
		$args['type'] = $this->get_banner_type( $args, $context, $post_id );
		
		$args = $this->get_customizer_args( $args );
		
		$html = '';
		
		if ( 'none' !== $args['type'] ){
		
			switch( $args['type'] ){
				
				case 'wide-static-slides':
					$html .= $this->get_wide_static_slides( $args, $context, $post_id );
					break;
				case 'dynamic-scroll':
				default:
					$html .= $this->get_dynamic_scroll( $args, $context, $post_id );
					break;
				
			} // End switch
		
		} // End if
		
		echo $html;
		
	} // End the_banner
	
	
	protected function get_banner_type( $args, $context, $post_id ){
		
		if( empty( $args['type'] ) ){
			
			if ( is_front_page() ){
				
				$type = get_theme_mod( '_cahnrswp_ignite_fronpage_feature', '' );
				
			} else if ( is_singular() ){
				
				$post_type = get_post_type();
			
				$post_type = str_replace( '-', '_', $post_type );
				
				$type = get_theme_mod( '_cahnrswp_ignite_banner_' . $post_type . '_type', '' );
			
			} // End if
		
		} else {
			
			$type = $args['type'];
			
		} // End if
		
		return $type;
		
	} // End get_banner_type
	
	
	private function get_wide_static_slides( $args, $context, $post_id  ){
		
		if ( ! $post_id ) $post_id = get_the_ID();
		
		$html = '';
		
		ob_start();
		
		include locate_template( 'includes/banners/types/wide-static-slides/wide-static-slides.php', false );
		
		$html .= ob_get_clean();
		
		return $html; 
		
	} // End get_wide_static_slides
	
	
	private function get_dynamic_scroll( $args, $context, $post_id ){
		
		if ( ! $post_id ) $post_id = get_the_ID();
		
		$html = '';
		
		$banner_image = $this->get_banner_image( $args, $context, $post_id );
		
		$height = $this->get_banner_height( $args, $context, $post_id );
		
		$parallax = $this->get_banner_parallax( $args, $context, $post_id );
		
		$classes = array();
		
		if ( $height ) $classes[] = 'banner-' . $height;
		
		ob_start();
		
		include locate_template( 'includes/banners/types/dynamic-scroll.php', false );
		
		$html .= ob_get_clean();
		
		return $html; 
		
	} // End get_dynamic_scroll 
	
	
	protected function get_menu_banner_full( $args, $context, $post_id ) {
		
		$html = '';
		
		$classes = array();
		
		switch( $args['type'] ){
			
			case 'dynamic-scroll-short':
				$classes[] = 'short-banner';
				break;
			case 'dynamic-scroll':
				$classes[] = 'medium-banner';
				break;
			case 'dynamic-scroll-tall':
				$classes[] = 'tall-banner';
				break;
		} // End switch
		
		$bgimage = get_theme_mod( '_cahnrswp_ignite_fronpage_feature_image', '' );
		
		ob_start();
		
		include locate_template( 'theme-parts/page-banners/includes/menu-banner.php', false );
		
		$html .= ob_get_clean();
		
		return $html;
		
	} // End get_menu_banner_full
	
	
	protected function get_banner_image( $args, $context, $post_id ){
		
		$image = '';
		
		if ( is_singular() ){
		
			if ( $post_id && has_post_thumbnail( $post_id ) ){
				
				$image = $this->get_post_image( $post_id, 'full', $args, $context  );
				
			} else if ( is_front_page() ){
				
				$image = get_theme_mod( '_cahnrswp_ignite_fronpage_feature_image', '' );
				
			} // End if
			
			if ( empty( $image ) ){
				
				$post_type = get_post_type( $post_id );
				
				$name = str_replace( '-', '_', $post_type );
				
				$image = get_theme_mod( '_cahnrswp_ignite_banner_' . $name . '_image', '' );
				
			} // End if
			
		} // End if
		
		return $image;
		
	} // End get_banner_image
	
	
	protected function get_banner_height( $args, $context, $post_id ){
		
		$height = '';
		
		if ( is_singular() ){
		
			if ( $post_id && get_post_meta( $post_id, '_banner_height', true ) ){
				
				$height = get_post_meta( $post_id, '_banner_height', true );
				
			} else if ( is_front_page() ){
				
				$height = get_theme_mod( '_cahnrswp_ignite_fronpage_feature_height', '' );
				
			} // End if
			
			if ( empty( $height ) ){
				
				$post_type = get_post_type( $post_id );
				
				$name = str_replace( '-', '_', $post_type );
				
				$height = get_theme_mod( '_cahnrswp_ignite_banner_' . $name . '_height', '' );
				
			} // End if
			
		} // End if
		
		return $height;
		
	} // End get_banner_height
	
	
	protected function get_banner_parallax( $args, $context, $post_id ){
		
		$parallax = '';
		
		if ( is_singular() ){
		
			if ( $post_id && get_post_meta( $post_id, '_banner_parallax', true ) ){
				
				$parallax = get_post_meta( $post_id, '_banner_parallax', true );
				
			} else if ( is_front_page() ){
				
				$parallax = get_theme_mod( '_cahnrswp_ignite_fronpage_feature_parallax', '1' );
				
			} // End if
			
			if ( empty( $parallax ) ){
				
				$post_type = get_post_type( $post_id );
				
				$name = str_replace( '-', '_', $post_type );
				
				$parallax = get_theme_mod( '_cahnrswp_ignite_banner_' . $name . '_parallax', '1' );
				
			} // End if
			
		} // End if
		
		return $parallax;
		
	} // End get_banner_parallax
	
	
} // End Page_Banner_CAHNRS_Ignite