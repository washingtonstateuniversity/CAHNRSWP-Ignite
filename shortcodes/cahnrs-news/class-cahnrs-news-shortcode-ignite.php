<?php

class CAHNRS_News_Shortcode_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_shortcode' ) );
		
	} // End __construct
	
	
	public function register_shortcode(){
		
		add_shortcode( 'cahnrs_news', array( $this, 'render_shortcode' ) );
		
	} // End register_shortcode
	
	
	public function render_shortcode( $atts, $content, $tag ){
		
		$html = '';
		
		$inner_html = '';
		
		$default_atts = array(
			'per_page' 				=> 5,
			'show_images' 			=> 1,
			'show_title' 			=> 1,
			'do_link' 				=> 1,
			'display' 				=> 'promo-list',
			'include_remote'		=> 0,
			'tag'					=> '',
			'category' 				=> '',
			'remote_category' 		=> '',
			'remote_tag' 			=> '',
			'tax_query'				=> '',
			'meta_query'			=> '',
			'excerpt_length'		=> 25,
			'order_by'				=> 'date',
		);
		
		$atts = shortcode_atts( $default_atts, $atts, $tag );
		
		$news = $this->get_news( $atts );
		
		$news = array_slice( $news, 0, $atts['per_page'] ); 
		
		switch( $atts['order_by'] ){
			
			default:
				$news = $this->order_by_date( $news );
				break;
			
		} // End switch
		
		switch( $atts['display'] ) {
			
			default:
				$inner_html .= $this->get_display_promo_list( $news, $atts );
				break;
			
		} // End switch
		
		ob_start();
		
			include CAHNRSIGNITEPATH . 'shortcodes/cahnrs-news/includes/wrapper.php';
		
		$html .= ob_get_clean();
		
		return $html;
		
	} // End render_shortcode
	
	
	protected function get_news( $atts ){
		
		$news = $this->get_local_news( $atts );
		
		if ( ! empty( $atts['include_remote'] ) ){
			
			$news = array_merge( $news, $this->get_remote_news( $atts ) );
			
		} // End if
		
		return $news;
		
	} // End get_news
	
	
	protected function get_local_news( $atts ){
		
		$news = array();
		
		$query_args = array(
			'post_type' 		=> 'news',
			'status' 			=> 'publish',
			'posts_per_page' 	=> $atts['per_page'],
		);
		
		$query = new WP_Query( $query_args );
		
		if ( $query->have_posts() ){
			
			while( $query->have_posts() ){
				
				$query->the_post();
				
				$news_item = array();
				
				$news_item['title'] = get_the_title();
				
				$news_item['content'] = get_the_content();
				
				$news_item['link'] = get_post_permalink();
				
				$news_item['excerpt'] = get_the_excerpt();
				
				$news_item['id'] = get_the_ID();
				
				$news_item['date'] = get_the_date();
				
				$news_item['link_start'] = '<a href="' . $news_item['link'] . '">';
				
				$news_item['link_end'] = '</a>';
				
				if ( has_post_thumbnail() ){
					
					$thumb_id = get_post_thumbnail_id();
					
					$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'large', true );
					
					$image_url = $thumb_url_array[0];
					
				} else {
					
					$image_url = '';
					
				} // end if
				
				$news_item['image'] = $image_url;
				
				$news[] = $news_item;
				
			} // End while
			
			wp_reset_postdata();
			
		} // End if
		
		return $news;
		
	} // End get_local_news
	
	
	protected function get_remote_news( $atts ){
		
		$news = array();
		
		$query_params = array();
		
		$remote_url = 'http://stage.cahnrs.wsu.edu/wp-json/wp/v2/news-release';
		
		if ( ! empty( $atts['per_page'] ) ){
			
			$query_params['per_page'] = $atts['per_page'];
			
		} // End if
		
		if ( ! empty( $atts['remote_category'] ) ){
			
			$query_params['categories'] = $atts['remote_category'];
			
		} // End if
		
		if ( ! empty( $query_params ) ){
			
			$remote_url .= '?' . http_build_query( $query_params );
			
		} // End if
		
		$response = wp_remote_get( $remote_url );
		
		if( ! is_wp_error( $response ) ) {
			
			$json = wp_remote_retrieve_body( $response );
			
			$remote_news = json_decode( $json, true );
			
			if ( is_array( $remote_news ) ){
				
				foreach( $remote_news as $remote_news_item ){
					
					$news_item = array();
					
					$news_item['image'] = ( ! empty( $remote_news_item['image_url'] ) ) ? $remote_news_item['image_url'] : '';
					
					$news_item['link'] = ( ! empty( $remote_news_item['link'] ) ) ? $remote_news_item['link'] : '';
					
					$news_item['title'] = ( ! empty( $remote_news_item['title']['rendered'] ) ) ? $remote_news_item['title']['rendered'] : '';
					
					$news_item['content'] = ( ! empty( $remote_news_item['content']['rendered'] ) ) ? $remote_news_item['content']['rendered'] : '';
					
					$news_item['excerpt'] = ( ! empty( $remote_news_item['excerpt']['rendered'] ) ) ? $remote_news_item['excerpt']['rendered'] : '';
					
					$news_item['date'] = ( ! empty( $remote_news_item['date'] ) ) ? $remote_news_item['date'] : '';
					
					$news_item['id'] = ( ! empty( $remote_news_item['id'] ) ) ? $remote_news_item['id'] : '';
					
					$news_item['link_start'] = '<a href="' . $news_item['link'] . '">';
				
					$news_item['link_end'] = '</a>';
					
					$news[] = $news_item;
					
				} // end foreach
				
			} // End if
			
		} // End if
		
		return $news;
		
	} // End get_remote_request
	
	
	protected function get_display_promo_list( $news, $atts ){
		
		$html = '';
		
		ob_start();
		
			include CAHNRSIGNITEPATH . 'shortcodes/cahnrs-news/includes/displays/promo-list-style.php';
	
		$html .= ob_get_clean();
		
		foreach( $news as $news_item ){
			
			ob_start();
		
				include CAHNRSIGNITEPATH . 'shortcodes/cahnrs-news/includes/displays/promo-list-news-item.php';
		
			$html .= ob_get_clean();
			
		} // End foreach
		
		return $html;
		
	} // End get_display_promo_list 
	
	
	protected function order_by_date( $news ){
		
		usort(
			$news,
			function( $a, $b ){
				$a_date = strtotime( $a['date'] );
				$b_date = strtotime( $b['date'] );
				
				return ( $a_date < $b_date ) ? 1 : -1;
				
			}
		);
		
		return $news;
		
	} // End order_by_date
	
	
} // end CAHNRS_News_Shortcode_Ignite

$cahnrs_news_shortcode_ignite = new CAHNRS_News_Shortcode_Ignite();