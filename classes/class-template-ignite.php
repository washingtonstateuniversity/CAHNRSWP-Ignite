<?php

class Template_Ignite {
	
	public $banner;
	public $header;
	public $template = 'generic';
	
	public function __construct(){
		
		require_once 'class-post-ignite.php';
		require_once 'class-header-ignite.php';
		require_once 'class-banner-ignite.php';

		$this->header = new Header_Ignite();
		$this->banner = new Banner_Ignite();
		
	} // end __construct
	
	
	public function get_the_banner(){
		
		$html = '';
		
		if ( is_singular() ){
			
			$html .= $this->banner->get_the_banner();
			
		} // end if
		
		return $html;
		
	} //end get_the_banner
	
	
	public function get_the_content(){
		
		$html = '<div id="site-content">';
		
		while ( have_posts() ) {
			
			the_post();
			
			$wp_post = get_post();
			
			//var_dump( $wp_post );
			
			$ignite_post = new Post_Ignite( $wp_post );
			
			$html .= $ignite_post->get_the_title(); 
			
			$html .= $ignite_post->get_the_content(); 
			
		} // end while
		
		$html .= '</div>';
		
		return $html;
		
	} // end get_the_content
	
	
	public function get_the_html_footer(){
		
		ob_start();
		
		get_footer();
		
		include CAHNRSIGNITEPATH . 'includes/footers/footer-after-widget-area.php';
		
		return ob_get_clean();
		
	} // end get_the_html_footer
	
	
	public function get_the_header(){
		
		$html = $this->header->get_the_header();
		
		return $html;
		
	} // end get_the_header

	
	public function get_the_html_header(){
		
		ob_start();
		
		get_header();
		
		return ob_get_clean();
		
	} // end get_the_header
	
	
	public function get_the_main_html( $main_html ){
		
		$is_cropped = ( true === spine_get_option( 'crop' ) && is_front_page() ) ? ' is-cropped-spine':'';
		
		$html = '<main id="wsuwp-main" class="spine-page-default' . $is_cropped . '">';
		
		$html .= $main_html;
		
		ob_start();
		
		include CAHNRSIGNITEPATH . 'includes/footers/footer-before-widget-area.php';
		
		$html .= ob_get_clean();
		
		$html .= '</main>';
		
		return $html;
		
	} // end get_the_main_html
	
	
	public function the_template(){
		
		$html = $this->get_the_html_header();
		
		$main_html = $this->get_the_header();
		
		$main_html .= $this->get_the_banner();
		
		$main_html .= $this->get_the_content();
		
		$html .= $this->get_the_main_html( $main_html );
		
		$html .= $this->get_the_html_footer();
		
		echo $html;
		
	} // end the_template
	
	
} // end Template_Ignite