<?php

class Banner_Slideshow_Ignite {
	
	protected $args = array();
	
	protected $context = '';
	
	protected $post_id = false;
	
	
	public function __construct( $args, $context, $post_id ){
		
		$this->args = $args;
		
		$this->context = $context;
		
		$this->post_id = $post_id;
		
	} // End __construct
	
	
	public function get_banner( $args = array(), $prefix = '' ){
		
		$html = '';
		
		$settings = $this->get_slide_settings( $args, $prefix );
		
		$query_args = $this->get_slide_query_args( $settings );
		
		$slides = ignite_get_slides( $query_args );
		
		$slide_html_array = array();
		
		foreach( $slides as $index => $slide ){
			
			ob_start();
			
			include ignite_get_theme_path( 'lib/displays/slides/banner-slideshow/slide.php' );
			
			$slide_html_array[] = ob_get_clean();
			
		} // End foreach
		
		$slides_html = implode('', $slide_html_array );
		
		if ( count( $slides ) > 1 ){
		
			ob_start();

			include ignite_get_theme_path( 'lib/displays/slides/banner-slideshow/slide-nav.php' );

			$slide_nav_html = ob_get_clean();

		} else {
			
			$slide_nav_html = '';

		} // End if
		
		ob_start();
		
		include ignite_get_theme_path( 'lib/displays/slides/banner-slideshow/slideshow.php' );
		
		$html .= ob_get_clean();
		
		return $html;
		
	} // End get_banner
	
	
	protected function get_slide_settings( $args = array(), $prefix = '' ){
		
		$default_args = array(
			'posts_per_page' => 3,
			'slide_category' => false,
			'order'				=> ASC,
			
		);
		
		$q_args = array();
		
		if ( is_front_page() ){
			
			$q_args['posts_per_page'] = get_theme_mod('_cahnrswp_ignite_fronpage_feature_slide_count', 3 );
			
			$q_args['slide_category'] = get_theme_mod( '_cahnrswp_ignite_frontpage_banner_slideshow_category', false );
			
		} // End if
		
		$args = array_merge( $default_args, $args );
		
		$args = array_merge( $args, $q_args );
		
		return $args;
		
	} // End 
	
	
	protected function get_slide_query_args( $args ){
		
		$query_args = array();
		
		if ( ! empty( $args['posts_per_page'] ) ){
			
			$query_args['posts_per_page'] = $args['posts_per_page'];
			
		} // End if
		
		if ( ! empty( $args['slide_category'] ) ){
			
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'slideshow_category',
					'field'    => 'term_id',
					'terms'    => $args['slide_category'],
				),
			);
			
		} // End if
		
		return $query_args;
		
	} // get_slide_query_args

	
} // End Basic_Slideshow_Banner_Ignite