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
		
		$html .= $this->get_slideshow( $slides, $settings );
		
		/*$slide_html_array = array();
		
		foreach( $slides as $index => $slide ){
			
			$slide_html_array[] = $this->get_slide( $slide, $index );
			
		} // End foreach
		
		$slides_html = implode('', $slide_html_array );
		
		if ( count( $slides ) > 1 ){
		
			ob_start();

			include ignite_get_theme_path( 'lib/displays/slideshows/basic/slide-nav.php' );

			$slide_nav_html = ob_get_clean();

		} else {
			
			$slide_nav_html = '';

		} // End if
		
		ob_start();
		
		include ignite_get_theme_path( 'lib/displays/slideshows/banner-slideshow/slideshow.php' );
		
		$html .= ob_get_clean();*/
		
		return $html;
		
	} // End get_banner
	
	
	protected function get_slideshow( $slides, $show_settings ){
		
		$slideshow = array(
			'height' 		=> ( ! empty( $show_settings['height'] ) )? $show_settings['height'] : '',
			'height_class' 	=> ( ! empty( $show_settings['height_class'] ) )? $show_settings['height_class'] : '',
			'isauto' 		=> ( ! empty( $show_settings['isauto'] ) )? $show_settings['isauto'] : true,
			'show_caption' 	=> ( ! empty( $show_settings['show_caption'] ) )? $show_settings['show_caption'] : true,
			'speed' 		=> ( ! empty( $show_settings['speed'] ) )? $show_settings['speed'] : 1000,
			'delay' 		=> ( ! empty( $show_settings['delay'] ) )? $show_settings['delay'] : 6000,
			'show_nav'		=> ( ! empty( $show_settings['show_nav'] ) )? $show_settings['show_nav'] : true,
		);
		
		$slideshow = array_merge( $slideshow, $show_settings );
		
		$slides_html = '';
		
		foreach( $slides as $index => $slide ){
			
			$slides_html .= $this->get_slide( $slide, $index, $slideshow );
			
		} // End foreach
		
		$slide_nav_html = $this->get_slideshow_nav( $slides, $slideshow );
		
		ob_start();
		
		include ignite_get_theme_path( 'lib/displays/slideshows/banner-slideshow/slideshow.php' );
		
		$html .= ob_get_clean();
		
		return $html;
		
		
	} // End get_slideshow
	
	
	protected function get_slideshow_nav( $slides, $slideshow ){
		
		$slide_nav_html = '';
		
		if ( count( $slides ) > 1 ){
		
			ob_start();

			include ignite_get_theme_path( 'lib/displays/slideshows/basic/slide-nav.php' );

			$slide_nav_html = ob_get_clean();

		} // End if
		
		return $slide_nav_html;
		
	} // End get_slideshow_nav
	
	
	protected function get_slide( $slide_obj, $index, $slideshow ){
		
		$slide = array(
			'link' 			=> $slide_obj->get_link(),
			'index' 		=> $index,
			'image' 		=> $slide_obj->get_image_src( 'full' ),
			'alt' 			=> $slide_obj->get_image_alt_text(),
			'show_caption' 	=> $slide_obj->show_caption(),
			'title' 		=> $slide_obj->get_title(),
			'excerpt' 		=> $slide_obj->get_excerpt(),
		);
		
		ob_start();
			
		include ignite_get_theme_path( 'lib/displays/slides/basic/slide.php' );

		$slide_html = ob_get_clean();
		
		return $slide_html;
		
	} // End get_slide
	
	
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
			
			$q_args['height_class'] = get_theme_mod( '_cahnrswp_ignite_frontpage_banner_slideshow_height', 'css-height-400' );
			
			$q_args['isauto'] = get_theme_mod( '_cahnrswp_ignite_frontpage_banner_slideshow_isauto', true );
			
			$q_args['speed'] = get_theme_mod( '_cahnrswp_ignite_frontpage_banner_slideshow_speed', 1000 );
			
			$q_args['delay'] = get_theme_mod( '_cahnrswp_ignite_frontpage_banner_slideshow_delay', 6000 );
			
			$q_args['show_caption'] = get_theme_mod( '_cahnrswp_ignite_frontpage_banner_slideshow_show_caption', 1 );
			
			$q_args['show_nav'] = get_theme_mod( '_cahnrswp_ignite_frontpage_banner_slideshow_show_nav', 1 );
			
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