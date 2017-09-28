<?php

class CAHNRS_Search_Shortcode_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_shortcode' ) );
		
	} // End __construct
	
	
	public function register_shortcode(){
		
		add_shortcode( 'cahnrs_search', array( $this, 'render_shortcode' ) );
		
	} // End register_shortcode
	
	
	public function render_shortcode( $atts, $content, $tag ){
		
		$html = '';
		
		$inner_html = '';
		
		$default_atts = array(
			'results_url'				=> '',
			'post_type'					=> '',
			'per_page' 					=> '',
			'show_images' 				=> '',
			'show_title' 				=> '',
			'show_date'					=> '',
			'do_link' 					=> '',
			'display' 					=> 'basic',
			'search_type'				=> 'site',
			'tags'						=> '',
			'categories' 				=> '',
			'excerpt_length'			=> '',
			'order_by'					=> '',
			'offset'					=> '',
			'category_relation' 		=> '',
			'tag_relation' 				=> '',
			'order' 					=> '',
			'exclude'					=> '',
			'article_placement' 		=> '',
			'article_topic'				=> '',
			'article_subject' 			=> '',
			'subject_relation'			=> '',
			'topic_relation' 			=> '',
			'article_relation' 			=> '',
			'sites' 					=> '',
			'site_relation' 			=> '',
			'meta_relation' 			=> '',
			'include_remote' 			=> '',
			'include_local' 			=> '',
			'exclude_already_shown' 	=> '',
			'remote_exclude'			=> '',
			'remote_categories' 		=> '',
			'remote_category_relation' 	=> '',
			'remote_tags' 				=> '',
			'remote_tag_relation' 		=> '',
			'keyword'					=> '',
			'resluts_page'				=> '',
			'show_results'				=> 1,	
		);
		
		$atts = shortcode_atts( $default_atts, $atts, $tag );
		
		ob_start( );
		
		$exclude = array('resluts_page','show_results','keyword','display');
		
		switch( $atts['display'] ){
			
			case 'cahnrs-query':
				$keyword_name = 'ci-keyword';
				break;
			case 'site':
			default:
				$keyword_name = 's';
				break;
		} // End switch
		
		switch( $atts['display'] ) {
			
			default:
				include locate_template( 'lib/shortcodes/cahnrs-search/includes/display-basic.php', false );
				break;
			
		} // End switch
		
		$html .= ob_get_clean();
		
		return $html;
		
	} // End render_shortcode
	
	
} // end Search_Shortcode_Ignite

$cahnrs_search_shortcode_ignite = new CAHNRS_Search_Shortcode_Ignite();