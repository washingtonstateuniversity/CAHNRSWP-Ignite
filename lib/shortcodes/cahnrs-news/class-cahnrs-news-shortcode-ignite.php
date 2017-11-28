<?php

class CAHNRS_News_Shortcode_Ignite extends Shortcode_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_shortcode' ) );
		
	} // End __construct
	
	
	public function register_shortcode(){
		
		add_shortcode( 'cahnrs_news', array( $this, 'render_shortcode' ) );
		
	} // End register_shortcode
	
	
	public function render_shortcode( $atts, $content, $tag ){
		
		$shortcode_atts = $atts;
		
		$html = '';
		
		$inner_html = '';
		
		$default_atts = array(
			'url' 					=> 'http://news.cahnrs.wsu.edu/',
			'per_page' 				=> 5,
			'show_images' 			=> 1,
			'show_title' 			=> 1,
			'show_date'				=> 1,
			'do_link' 				=> 1,
			'display' 				=> 'promo-list',
			'tags'					=> '',
			'cpage'					=> 1,
			'categories' 			=> '',
			'excerpt_length'		=> 25,
			'orderby'				=> 'date',
			'offset'				=> 0,
			'category_relation' 	=> 'OR',
			'tag_relation' 			=> 'OR',
			'order' 				=> 'ASC',
			'exclude'				=> '',
			'article_placement' 	=> '',
			'article_topic'			=> '',
			'article_subject' 		=> '',
			'subject_relation'		=> 'OR',
			'topic_relation' 		=> 'OR',
			'article_relation' 		=> 'AND',
			'sites' 				=> '',
			'site_relation' 		=> 'OR',
			'meta_relation' 		=> 'OR',
			'include_remote' 		=> false,
			'include_local' 		=> true,
			'exclude_already_shown' => 0,
			'remote_exclude'			=> '',
			'remote_categories' 		=> '',
			'remote_category_relation' 	=> 'OR',
			'remote_tags' 				=> '',
			'remote_tag_relation' 		=> 'OR',
			'keyword'					=> '',
			'show_pagination'		=> 0,
			'show_pagination_before'	=> 0,
			'hide_pagination_after'	=> 0,
			'show_read_more'		=> 0,
		);
		
		$atts = shortcode_atts( $default_atts, $atts, $tag );
		
		$atts = $this->get_form_overrides( $atts, $tag );
		
		/*$cache_content = $this->get_content_cache( $atts, 'cahnrs_news' );
		
		if( isset( $_GET['debug'] )) var_dump( $cache_content ); 
		
		if ( $cache_content ){
			
			return $cache_content;
			
		} // End if*/
		
		$query = $this->get_news_query( $atts );
		
		$query->set_displayed();
		
		require_once locate_template( 'classes/class-paginiation-cahnrs-ignite.php', false );
		
		$pagination = new Pagination_CAHNRS_Ignite( $atts['cpage'], $atts['per_page'], $query->total_posts );
		
		$pagination_html = '';
		
		if ( $atts['show_pagination'] || $atts['show_pagination_before'] ) $pagination_html = $pagination->get_pagination_html();
		
		$news = $query->posts;
		
		switch( $atts['orderby'] ){
				
			case 'rand':
				break;
			default:
				$news = $this->order_by_date( $news );
				break;
			
		} // End switch
		
		switch( $atts['display'] ) {
			
			case 'spotlight':
				$inner_html .= $this->get_display_spotlight( $query, $atts, $pagination );
				break;
			
			default:
				$inner_html .= $this->get_display_promo_list( $query, $atts, $pagination );
				break;
			
		} // End switch
		
		ob_start();
		
			include CAHNRSIGNITEPATH . 'lib/shortcodes/cahnrs-news/includes/wrapper.php';
		
		$html .= ob_get_clean();
		
		//$this->set_content_cache( $atts, 'cahnrs_news', $html );
		
		return $html;
		
	} // End render_shortcode
	
	
	protected function get_news_query( $atts ){
		
		$news = array();
		
		require_once locate_template( 'classes/class-query-cahnrs-ignite.php', false );
		
		$args = array(
			'post_type' => 'article',
		);
		
		$args = array_merge( $args, $atts );
		
		$query = new Query_CAHNRS_Ignite( $args );
		
		$query->set_displayed();
		
		return $query;
		
	} // End get_news
	
	
	protected function get_form_overrides( $atts, $tag ){
		
		foreach( $atts as $key => $value ){
			
			if ( ! empty( $_GET[ 'ci-' . $key ] ) ){
				
				switch( $key ){
					
					case 'keyword':
						$atts[ 'search' ] = sanitize_text_field( $_GET[ 'ci-' . $key ] );
						$atts[ $key ] = sanitize_text_field( $_GET[ 'ci-' . $key ] );
						break;
					default:
						$atts[ $key ] = sanitize_text_field( $_GET[ 'ci-' . $key ] );
						break;
					
				} // End switch
				
			} // End if
			
		} // End foreach
		
		return $atts;
		
	} // End get_form_overrides
	
	
	protected function get_display_promo_list( $query, $atts ){
		
		$news = $query->posts;
		
		$html = '';
		
		foreach( $news as $post ){
			
			$has_redirect = get_post_meta( $post->id, '_article_redirect_url', true );
			
			ob_start();
		
				include CAHNRSIGNITEPATH . 'lib/shortcodes/cahnrs-news/includes/displays/promo-list-news-item.php';
		
			$html .= ob_get_clean();
			
		} // End foreach
		
		return $html;
		
	} // End get_display_promo_list
	
	
	protected function get_display_spotlight( $query, $atts, $pagination  ){
		
		$html = '';
		
		$news = $query->posts;
		
		foreach( $news as $post ){
			
			ob_start();
		
				include CAHNRSIGNITEPATH . 'lib/shortcodes/cahnrs-news/includes/displays/spotlight.php';
		
			$html .= ob_get_clean();
			
		} // End foreach
		
		return $html;
		
	} // End get_display_promo_list  
	
	
	protected function order_by_date( $news ){
		
		usort(
			$news,
			function( $a, $b ){
				$a_date = strtotime( $a->post_date );
				$b_date = strtotime( $b->post_date );
				
				return ( $a_date < $b_date ) ? 1 : -1;
				
			}
		);
		
		return $news;
		
	} // End order_by_date
	
	
} // end CAHNRS_News_Shortcode_Ignite

$cahnrs_news_shortcode_ignite = new CAHNRS_News_Shortcode_Ignite();