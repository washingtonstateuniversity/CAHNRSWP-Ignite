<?php

class Template_Ignite {
	
	protected $theme_options = false;
	
	protected $template_slug = 'base';
	protected $site_title = '';
	protected $site_description = '';
	
	
	/***********************************************
	 ** Public Methods **
	************************************************/
	
	public function __construct(){
		
		require_once 'class-theme-options-ignite.php';
		
		$this->theme_options = new Theme_Options_Ignite();
		
		$this->theme_options->set_theme_options();
		
	} // end __construct
	
	
	public function get_theme_option( $key, $default = array(), $context = '' ){
		
		return $this->theme_options->get_theme_option( $key, $default, $context );
		
	} // end get_site_option
	
	
	public function the_template(){
		
		ob_start();
		
		if ( method_exists( $this, 'render_template' ) ){
			
			$theme_options = $this->theme_options->get_theme_options();
			
			$this->render_template( $theme_options );
			 
		} // end if
		
		$html = ob_get_clean();
		
		echo apply_filters( 'template_ignite_html' , $html, $this->template_slug );
		
	} // end render_template
	
	
	/***********************************************
	 ** Private/Protected Methods **
	************************************************/
	
	
	protected function get_post_image( $post_id, $size ){
		
		$image_url = false;
		
		if ( has_post_thumbnail( $post_id ) ){
		
			$img_id = get_post_thumbnail_id( $post_id );
				
			$img_url_array = wp_get_attachment_image_src( $img_id, $size, true );
				
			$image_url = $img_url_array[0];
		
		} // end if
		
		return $image_url;
		
	} // end get_post_image
	
	
	protected function the_content( $post_display_style = 'promo' ){
		
		$html = '<div id="site-content">';
		
		while ( have_posts() ) {
			
			the_post();
			
			$wp_post = get_post();
			
			ob_start();
			
			switch( $post_display_style ){
				
				case 'promo':
					include CAHNRSIGNITEPATH . 'includes/content/promo.php';  
					break;
				case 'single-page':
					include CAHNRSIGNITEPATH . 'includes/content/single-page.php'; 
					break;
					
			} // end switch
			
			$html .= ob_get_clean();
			
		} // end while
		
		$html .= '</div>';
		
		echo $html;
		
	} // end get_the_content
	
	
	protected function the_content_main( $position, $add_classes = array() ){
		
		$html = '';
		
		if ( empty( $html ) ){
		
			switch( $position ){
				
				case 'start':
				
					$main_classes = $add_classes;
					
					$main_classes[] = 'spine-page-default';
				
					if ( true === spine_get_option( 'crop' ) && is_front_page() ) {
						
						$main_classes[] = 'is-cropped-spine';
						
					} // end if
					
					$main_classes = apply_filters( 'template_ignite_main_css', $main_classes, $this->template_slug );
					
					$html .= '<main id="wsuwp-main" class="' . implode( ' ', $main_classes ) . '">';
					
					break;
					
				case 'end':
				
					$html .= '</main>';
					
					break;
				
			} // end switch
		
		} // end if
		
		echo apply_filters( 'template_ignite_main_html', $html, $position, $this->template_slug );
		
	} // end the_content_main
	
	
	protected function the_banner( $type, $post = false ){
		
		switch( $type ){
			
			case 'dynamic-scroll':
				$this->the_banner_dynamic_scroll( $post );
				break;
			
		} // end switch
		
	} // end the_frontpage_banner
	
	
	protected function the_banner_dynamic_scroll( $post ){
		
		$image_url = $this->get_post_image( $post->ID, 'full' );
		
		include CAHNRSIGNITEPATH . '/includes/banners/dynamic-scroll.php';
		
	} // end the_banner_dynamic_scroll
	
	
	protected function the_header( $header_type = false ){
		
		if ( ! $header_type ){
		
			$header_type = $this->get_theme_option( '_cahnrswp_header_type', 'cahnrs-college', $this->template_slug );
		
		} // end if
		
		switch( $header_type ){
			
			case 'spine':
				$this->the_header_spine();
				break;
			case 'cahnrs-college':
			default:
				echo '<header id="site-header">';
				$this->the_header_cahnrs_college();
				echo '</header>';
				break;
			
		} // end switch
		
	} // end the_header
	
	
	protected function the_header_spine(){
			
		get_template_part( 'parts/headers' ); // in spine theme
	
		get_template_part( 'parts/featured-images' ); // in spine theme
		
	} // end the_header_spine
	
	
	protected function the_header_cahnrs_college(){
		
		$show_college_global = $this->get_theme_option( '_cahnrswp_header_show_college_global', 1, $this->template_slug );
		$show_banner = $this->get_theme_option( '_cahnrswp_header_display_banner', 1, $this->template_slug );
		$show_horz_nav = $this->get_theme_option( '_cahnrswp_header_horizontal_nav', 0, $this->template_slug );
		
		if ( $show_college_global ) {
    
			get_template_part( 'includes/headers/college-global-nav' );
		
		} // end if
	
		if ( $show_banner ) {
		
			get_template_part( 'includes/headers/college-banner' );
		
		} // end if 
		
		if ( $show_horz_nav ){
			
			get_template_part( 'includes/headers/college-horizontal-menu' );
			
		} // end if
		
	} // end the_header_cahnrs_college
	
	
	protected function the_wp_footer(){
		
		get_footer();
		
	} // end the_header
	
	
	protected function the_wp_header(){
		
		get_header();
		
	} // end the_header
	
	
} // end Template_Ignite