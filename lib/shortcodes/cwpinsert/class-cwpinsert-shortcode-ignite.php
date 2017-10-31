<?php

class CAHNRS_Cwpinsert_Shortcode_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_shortcode' ) );
		
	} // End __construct
	
	
	public function register_shortcode(){
		
		add_shortcode( 'cwpinsert', array( $this, 'render_shortcode' ) );
		
	} // End register_shortcode
	
	
	public function render_shortcode( $atts, $content, $tag ){
		
		$html = '';
		
		$default_atts = array(
			'display' 	=> 'full',
			'title'   	=> '',
			'url'   	=> '',
		);
		
		$atts = shortcode_atts( $default_atts, $atts, $tag );
		
		if ( $atts['url'] ){
			
			$rest_post = $this->get_rest_request( $atts['url'] );
			
			switch( $atts['display'] ){
					
				case 'full':
					$html .= $this->get_display_full( $rest_post, $atts );
					break;
				case 'article-accordion':
					$html .= $this->get_display_accordion( $rest_post, $atts );
					break;
			} // End switch
			
		} // End if
		
		return $html;
		
	} // End render_shortcode
	
	
	protected function get_display_full( $rest_post, $atts ){
		
		$html = $rest_post['content'];
		
		return $html;
		
	} // End get_display_full
	
	protected function get_display_accordion( $rest_post, $atts ){
			
		$title = ( $atts['title'] ) ? $atts['title'] : $rest_post['title'];
		
		$content = $rest_post['content'];
		
		ob_start();
		
		include ignite_get_theme_path( 'lib/post-formats/content-accordion/accordion.php' );
		
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

$cahnrs_cwpinsert_shortcode_ignite = new CAHNRS_Cwpinsert_Shortcode_Ignite();