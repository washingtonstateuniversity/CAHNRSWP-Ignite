<?php

class CAHNRS_Theme_part_Shortcode_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_shortcode' ) );
		
		add_filter( 'shortcode_content_ignite', 'wptexturize'        );
		add_filter( 'shortcode_content_ignite', 'convert_smilies'    );
		add_filter( 'shortcode_content_ignite', 'convert_chars'      );
		add_filter( 'shortcode_content_ignite', 'wpautop'            );
		add_filter( 'shortcode_content_ignite', 'shortcode_unautop'  );
		add_filter( 'shortcode_content_ignite', 'prepend_attachment' );
		
	} // End __construct
	
	
	public function register_shortcode(){
		
		add_shortcode( 'cahnrs_theme_part', array( $this, 'render_shortcode' ) );
		
	} // End register_shortcode
	
	
	public function render_shortcode( $atts, $content, $tag ){
		
		$html = '';
		
		//$inner_html = '';
		
		$default_atts = array(
			'part_id' => '',
		);
		
		$atts = shortcode_atts( $default_atts, $atts, $tag );
		
		if ( $atts['part_id'] ){
		
			$post = get_post( $atts['part_id'] );
			
			//var_dump( $post );
			
			if ( $post ){
				
				$content = apply_filters( 'widget_content_ignite', $post->post_content );
				
				$html .= do_shortcode( $content );
				
			} // end if
			
		} // End if
		
		return $html;
		
	} // End render_shortcode
	
	
} // end Search_Shortcode_Ignite

$cahnrs_theme_part_shortcode_ignite = new CAHNRS_Theme_part_Shortcode_Ignite();