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
		
		if ( is_active_sidebar( 'banner_before' ) ) {
			
			ob_start();
			
			dynamic_sidebar( 'banner_before' );
			
			$html .= '<div id="widget-area-banner-before">' . ob_get_clean() .'</div>';
			
		} // End if
		
		if ( 'none' !== $args['type'] ){
		
			switch( $args['type'] ){
				
				case '404':
					$html .= $this->get_404_banner( $args, $context, $post_id );
					break;
				case 'banner-slideshow':
					include_once ignite_get_theme_path('lib/parts/page-banners/banner-slideshow/class-banner-slideshow-ignite.php');
					$banner_slideshow = new Banner_Slideshow_Ignite( $args, $context, $post_id );
					$html = $banner_slideshow->get_banner();
					break;
				case 'wide-static-slides':
					$html .= $this->get_wide_static_slides( $args, $context, $post_id );
					break;
				case 'dynamic-scroll':
				default:
					$html .= $this->get_dynamic_scroll( $args, $context, $post_id );
					break;
				
			} // End switch
		
		} // End if
		
		if ( is_active_sidebar( 'banner_after' ) ) {
			
			ob_start();
			
			dynamic_sidebar( 'banner_after' );
			
			$html .= '<div id="widget-area-banner-after">' . ob_get_clean() .'</div>';
			
		} // End if
		
		echo apply_filters( 'cahnrs_ignite_page_html', $html );
		
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
	
	
	private function get_basic_slideshow( $args, $context, $post_id ){
		
		if ( ! $post_id ) $post_id = get_the_ID();
		
		$slides = array();
		
	} // End get_basic_slideshow
	
	
	private function get_wide_static_slides( $args, $context, $post_id  ){
		
		if ( ! $post_id ) $post_id = get_the_ID();
		
		$slides = array();
		
		$args = array(
			'url' 				=> 'http://news.cahnrs.wsu.edu/',
			'per_page' 			=> 4,
			'request_type' 		=> 'post',
			'post_type' 		=> 'article',
			'article_placement'	=> 'feature-slideshow',
			'include_local'		=> false,
			'include_remote' 	=> true,
		);
		
		require_once locate_template( 'classes/class-query-cahnrs-ignite.php', false );
		
		$query = new Query_CAHNRS_Ignite( $args );
		
		//$query->set_displayed( $query->posts[0] );
		
		foreach( $query->posts as $index => $ignite_post ){
			
			if ( 0 === $index ) $ignite_post->set_displayed();
			
			$ignite_post->post_excerpt = wp_trim_words( strip_tags( $ignite_post->post_excerpt ), 25 );
			
			$slides[] = $ignite_post;
			
		} // End foreach
		
		$html = '';
		
		ob_start();
		
		include locate_template( 'theme-parts/page-banners/wide-static-slides/wide-static-slides.php', false );
		
		$html .= ob_get_clean();
		
		return $html; 
		
	} // End get_wide_static_slides
	
	
	private function get_404_banner( $args, $context, $post_id ){
		
		$banner_image = $this->get_banner_image_by_slug( '404', $args, $context, $post_id, $banner_image_override );
		
		ob_start();
		
		include locate_template( 'theme-parts/page-banners/displays/404-banner.php', false );
		
		$html .= ob_get_clean();
		
		return $html; 
		
	} // End get_dynamic_scroll
	
	
	private function get_dynamic_scroll( $args, $context, $post_id ){
		
		if ( ! $post_id ) $post_id = get_the_ID();
		
		$html = '';
		
		$banner_image_override = $this->get_banner_property( 'override', '', $post_id, $args, $context, false );
		
		$banner_image = $this->get_banner_image( $args, $context, $post_id, $banner_image_override );
		
		//$height = $this->get_banner_height( $args, $context, $post_id );
		
		$height = $this->get_banner_property( 'height', '', $post_id, $args, $context, false );
		
		$parallax = $this->get_banner_property( 'parallax', '1', $post_id, $args, $context, false );
		
		//$parallax = $this->get_banner_parallax( $args, $context, $post_id );
		
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
	
	
	protected function get_banner_image( $args, $context, $post_id, $override = false ){
		
		$image = '';
		
		if ( is_tax() || is_category() || is_tag() ){
			
			$term = get_queried_object();
			
			$image = get_theme_mod( '_cahnrswp_ignite_banner_' . $term->taxonomy . '_image', '' );
			
		} else if ( is_singular() ){
			
			$post_remove_banner = get_post_meta( $post_id, '_remove_page_banner', true );
		
			if ( ! $override && $post_id && has_post_thumbnail( $post_id ) ){
				
					$image = $this->get_post_image( $post_id, 'full', $args, $context  );
				
			} else if ( is_front_page() ){
				
				$image = get_theme_mod( '_cahnrswp_ignite_fronpage_feature_image', '' );
				
			} // End if
			
			if ( empty( $image ) ){
				
				$post_type = get_post_type( $post_id );
				
				$name = str_replace( '-', '_', $post_type );
				
				if ( get_theme_mod( '_cahnrswp_ignite_banner_' . $name . '_inherit_image', false ) ){
					
					$ancestors = get_post_ancestors( $post_id );
					
					if ( is_array( $ancestors ) ){
					
						foreach( $ancestors as $ancestor_id ){
							
							if ( has_post_thumbnail( $ancestor_id ) ){
								
								$image = $this->get_post_image( $ancestor_id, 'full', $args, $context  );
								
								break;
								
							} // End if
							
						} // End foreach
					
					} // End if
					
				} // End if
				
				if ( empty( $image ) ){
					
					$image = get_theme_mod( '_cahnrswp_ignite_banner_' . $name . '_image', '' );
					
				} // End if
				
			} // End if empty( $image )
			
			if ( $image && $post_remove_banner ) $image = '';
			
		} else if ( is_post_type_archive() ){
			
			$image = get_theme_mod( '_cahnrswp_ignite_banner_' . $this->get_post_type_name() . '_archive_image', '' );
			
		}// End if
		
		return $image;
		
	} // End get_banner_image
	
	
	protected function get_banner_image_by_slug( $slug, $args, $context, $post_id = false, $override = false ){
		
		$image = '';
		
		if ( $post_id && ! $override && has_post_thumbnail( $post_id ) ){
			
			$image = $this->get_post_image( $post_id, 'full', $args, $context  );
			
		} else {
			
			$image = get_theme_mod( '_cahnrswp_ignite_banner_' . $slug . '_image', '' );
			
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
				
				$height = get_theme_mod( '_cahnrswp_ignite_banner_' . $this->get_post_type_name( $post_id ) . '_height', '' );
				
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
	
	
	protected function get_banner_property( $key, $default, $post_id, $args, $context, $override = false ){
		
		$value = $default;
		
		if ( is_singular() ){
		
			if ( ! $override && $post_id && get_post_meta( $post_id, '_banner_' . $key, true ) ){
				
				$value = get_post_meta( $post_id, '_banner_' . $key, true );
				
			} else if ( is_front_page() ){
				
				$value = get_theme_mod( '_cahnrswp_ignite_fronpage_feature_' . $key, $default );
				
			} // End if
			
			if ( empty( $value ) ){
				
				$post_type = get_post_type( $post_id );
				
				$name = str_replace( '-', '_', $post_type );
				
				$value = get_theme_mod( '_cahnrswp_ignite_banner_' . $name . '_' . $key, $default );
				
			} // End if
			
		} else if ( is_post_type_archive() ){
			
			$value = get_theme_mod( '_cahnrswp_ignite_banner_' . $this->get_post_type_name() . '_archive_' . $key, $default );
			
		} // End if
		
		return $value;
		
	} // End get_banner_parallax
	
	
	protected function get_post_type_name( $post_id = false, $post_type = false ){
		
		if ( is_post_type_archive() && ! $post_type ){
			
			$post_type = get_post_type();
			
		} else if ( $post_id ) {
			
			$post_type = get_post_type( $post_id );
			
		} else {
			
			$name = '';
			
		}// End if
				
		$name = str_replace( '-', '_', $post_type );
		
		return $name;
		
	} // End get_post_type_name
	
	
	protected function set_is_displayed_post( $post_type, $ids ){
		
		if ( ! is_array( $ids ) ) {
			
			$ids = array( $ids );
			
		} // End if
		
		global $cahnrs_displayed_posts;
		
		if ( empty( $cahnrs_displayed_posts ) )
			$cahnrs_displayed_posts = array();
			
		if ( empty( $cahnrs_displayed_posts[ $post_type ] ) ) 
				$cahnrs_displayed_posts[ $post_type ] = array();
			
		foreach( $ids as $id ){
			
			$cahnrs_displayed_posts[ $post_type ][] = $id;
			
		} // End Foreach
		
	} // End 
	
	
} // End Page_Banner_CAHNRS_Ignite