<?php

class CAHNRS_Cwpaccordion_Shortcode_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_shortcode' ) );
		
	} // End __construct
	
	
	public function register_shortcode(){
		
		add_shortcode( 'CWPACCORDION', array( $this, 'render_shortcode' ) );
		
		add_shortcode( 'cwpaccordion', array( $this, 'render_shortcode' ) );
		
	} // End register_shortcode
	
	
	public function render_shortcode( $atts, $content, $tag ){
		
		$html = '';
		
		$default_atts = array(
			'display' 	=> 'basic',
			'title'   	=> '',
			'url'   	=> '',
		);
		
		$atts = shortcode_atts( $default_atts, $atts, $tag );
		
		$title = $atts['title'];
		
		if ( $atts['url'] ){
			
			$rest_post = $this->get_rest_request( $atts['url'] );
			
			if ( empty( $title ) ) {
				
				$title = $rest_post['title'];
				
			} // End if
			
			$content = $rest_post['content'];
			
		} // End if
		
		$html .= $this->get_display_accordion( $title, $content, $atts );
		
		
		return $html;
		
	} // End render_shortcode
	
	
	protected function get_display_accordion( $title, $content, $atts ){
		
		ob_start();
		
		include ignite_get_theme_path( 'lib/post-formats/basic-accordion/accordion.php' );
		
		$html = ob_get_clean();
		
		return $html;
		
	} // End get_display_full
	
	
	protected function get_rest_request( $request_url ){
		
		$rest_post = array();
		
		$response = wp_remote_get( $request_url . '?get-post-json=true' );
		
		$content = wp_remote_retrieve_body( $response );
		
		$rest_post_array = json_decode( $content, true );
		
		if ( is_array( $rest_post_array ) ){
			
			$rest_post = array(
				'title' => $rest_post_array['title']['rendered'],
				'content' => $rest_post_array['content']['rendered'],
				'excerpt' => $rest_post_array['excerpt']['rendered'],
			);
			
		} // End if
		
		return $rest_post;
		
	} // End get_rest_request
	
	
} // end Search_Shortcode_Ignite

$cahnrs_cwpaccordion_shortcode_ignite = new CAHNRS_Cwpaccordion_Shortcode_Ignite();