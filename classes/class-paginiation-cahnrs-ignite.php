<?php

class Pagination_CAHNRS_Ignite {
	
	public $page_key = 'ci-page';
	
	public $page = 1;
	
	public $per_page = 0;
	
	public $pages = 1;
	
	public $next_page = 1;
	
	public $prev_page = false;
	
	public $total_posts = 0;
	
	
	public function __construct( $current_page, $per_page, $total_posts, $page_key = false ){
		
		if ( $page_key ) $this->page_key = $page_key;
		
		$this->page = $current_page;
		
		$this->per_page = $per_page;
		
		$this->total_posts = $total_posts;
		
		$this->set_values();
		
	} // End __construct
	
	
	public function get_pagination( $display = 'default', $args = array() ){
		
		$html = '';
		
		switch( $display ){
			
			case 'default':
			default:
				$html .= $this->get_display_default( $args );
				break;
			
		} // End switch
		
		return $html;
		
		
	} // End get_pagination
	
	
	/*
	* DEPERCATED do not use
	* USE get_pagination instead
	*/
	public function get_pagination_html( $display = 'basic'){
		
		$html = '';
		
		switch( $display ){
			
			case 'basic':
			default:
				$html .= $this->get_display_basic();
				break;
			
		} // End switch
		
		return $html;
		
	} // End get_pagination
	
	
	protected function get_display_default( $args = array() ){
		
		$start_index = $this->get_index_start();
		
		$end_index = $this->get_index_end( $start_index );
		
		$last_index = $this->get_index_last();
		
		$classes = array();
		
		if ( ! empty( $args['is_after'])) $classes[] = 'is-after';
		
		if ( $this->pages > 1 ){
			
			ob_start();
			
			if ( ! empty( $args['is_shortcode'] ) ){
				
				include locate_template( 'theme-parts/pagination/displays/default-shortcode.php', false );
				
			} else {
				
				include locate_template( 'theme-parts/pagination/displays/default.php', false );
				
			}
		
			$html .= ob_get_clean();
		
		} // End if
		
		return $html;
		
	} // End get_display_default
	
	
	protected function get_index_start(){
		
		if ( 3 >= $this->pages ) {
			
			$start_index = 1;
			
		} else if ( ( $this->page + 1 ) >= $this->pages ){
			
			$start_index = $this->pages - 2;
			
		} else if ( $this->page < 3 ){
			
			$start_index = 1;
			
		} else {
			
			$start_index = $this->page - 1;
			
		}// End if
		
		$end_val = ( $start_index + 2 );
		
		if ( ( $this->pages <= $end_val ) && ( $this->pages > 3 ) ) $start_index = $end_val - 2;
		
		return $start_index;

	} // End get_index_start
	
	
	protected function get_index_end( $start_index ){
		
		$end_val = ( $start_index + 2 );
		
		$end_index = ( $this->pages >= $end_val ) ? $end_val : $this->pages;
		
		return $end_index;
		
	} // End get_index_end
	
	
	protected function get_index_last(){
		
		$last_index = ( ( $this->pages > 3 ) && ( ( $this->page + 1 ) < $this->pages )  ) ? $this->pages : false;
		
		return $last_index;
		
	} // End get_index_last
	
	
	protected function get_display_basic(){
		
		if ( ( $this->page + 1 ) >= $this->pages ){
			
			$start_index = $this->pages - 2;
			
		} else if ( $this->page < 3 ){
			
			$start_index = 1;
			
		} else {
			
			$start_index = $this->page - 1;
			
		}// End if
		
		$end_val = ( $start_index + 2 );
		
		if ( ( $this->pages <= $end_val ) && ( $this->pages > 3 ) ) $start_index = $end_val - 2;
		
		$end_index = ( $this->pages >= $end_val ) ? $end_val : $this->pages;
		
		$last_index = ( ( $this->pages > 3 ) && ( ( $this->page + 1 ) < $this->pages )  ) ? $this->pages : false;
		
		$html = '';
		
		if ( $this->pages > 1 ){
		
			ob_start();
		
			include locate_template( 'includes/pagination/displays/basic.php', false );
		
			$html .= ob_get_clean();
		
		} // End if
		
		return $html;
		
		//var_dump( $start_index );
		//var_dump( $end_val );
		//var_dump( $end_index  );
		//var_dump( $last_index );
		
	} // End get_display_basic
	
	
	protected function set_values(){
		
		if ( $this->total_posts ){
			
			$pages = ceil( $this->total_posts / $this->per_page );
			
			$this->pages = $pages;
			
		} // End if
		
		$next_page = ( $this->page + 1 );
		
		$prev_page = ( $this->page - 1 );
		
		$this->next_page = ( $next_page <= $this->total_posts ) ? $next_page : false;
		
		$this->prev_page = ( $prev_page > 0 ) ? $prev_page : false;
		
	} // End set_values
	
	
	protected function get_page_link( $page, $is_shortcode = false, $prefix = '' ){
		
		if ( $is_shortcode ){
				
			$url = (isset( $_SERVER['HTTPS'] ) ? 'https' : 'http') . '://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
				
			$url_parts = parse_url($url);
				
			parse_str($url_parts['query'], $params);
			
			$page_key = $prefix . 'ci-page';
			
			$params[ $page_key ] = $page;
			
			$url_parts['query'] = http_build_query($params);
			
			$link = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?' . $url_parts['query'];
			
		} else {
			
			$link = get_pagenum_link( $page );
			
		};
		
		return $link;
		
		
	} // End get_page_link
	
	
} // End Pagination_CAHNRS_Ignite