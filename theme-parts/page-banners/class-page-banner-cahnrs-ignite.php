<?php

class Page_Banner_CAHNRS_Ignite extends Theme_Part_Ignite {
	
	protected $default_args = array(
		'type' => 'dynamic-scroll',
	);
	
	protected $settings = array(
		'type' => '_cahnrswp_single_banner_type'
	);
	
	public function the_banner( $context = 'single', $args = array(), $post_id = false ){
		
		$post_type = get_post_type();
		
		$post_type = str_replace( '-', '_', $post_type );
		
		$post_type_default = get_theme_mod( '_cahnrswp_ignite_banner_' . $post_type . '_type' );
		
		if ( empty( $args['type'] ) )  $args['type'] = $post_type_default;
		
		$args = $this->get_customizer_args( $args );
		
		$html = '';
		
		if ( 'none' !== $args['type'] ){
		
			switch( $args['type'] ){
				
				case 'wide-static-slides':
					$html .= $this->get_wide_static_slides( $args, $context, $post_id );
					break;
					
				case 'dynamic-scroll':
				case 'dynamic-scroll-short':
				case 'dynamic-scroll-tall':
				default:
					$html .= $this->get_dynamic_scroll( $args, $context, $post_id );
					break;
				
			} // End switch
		
		} // End if
		
		echo $html;
		
	} // End the_banner
	
	
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
		
		if ( has_post_thumbnail( $post_id ) ){
		
			$img_id = get_post_thumbnail_id( $post_id );
					
			$img_url_array = wp_get_attachment_image_src( $img_id, 'full', true );
					
			$banner_image = $img_url_array[0];
			
		} else if ( is_front_page() ){
			
			$banner_image = get_theme_mod( '_cahnrswp_ignite_fronpage_feature_image', '' );
			
		} else {
			
			$banner_image = '';
			
		}// end if
		
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
		
		ob_start();
		
		include locate_template( 'includes/banners/types/dynamic-scroll.php', false );
		
		$html .= ob_get_clean();
		
		return $html; 
		
	} // End get_dynamic_scroll 
	
} // End Page_Banner_CAHNRS_Ignite