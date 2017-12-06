<?php

class Query_CAHNRS_Ignite {
	
	public $args_default = array(
		'url' 						=> 'http://cahnrs.wsu.edu/',
		'request_base'				=> '/wp-json/wp/v2/',
		'include_remote' 			=> false,
		'include_local' 			=> true,
		'query_type' 				=> 'post',
		'post_type' 				=> 'any',
		'post_status'				=> 'publish',
		'categories' 				=> '',
		'category_relation' 		=> 'OR',
		'tags' 						=> '',
		'tag_relation' 				=> 'OR',
		'meta_relation' 			=> 'OR',
		'per_page' 					=> 10,
		'orderby' 					=> 'date',
		'order' 					=> 'ASC',
		'offset' 					=> 0,
		'exclude' 					=> '',
		'remote_exclude'			=> '',
		'remote_categories' 		=> '',
		'remote_category_relation' 	=> 'OR',
		'remote_tags' 				=> '',
		'remote_tag_relation' 		=> 'OR',
		'exclude_already_shown' 	=> 0,
		'search'					=> '',
		'page'						=> 1,
	);
	
	public $args = array();
	
	public $context = 'not-set';
	
	public $response = array();
	
	public $posts = array();
	
	public $page = 1;
	
	public $pages = 1;
	
	public $next_page = 1;
	
	public $previous_page = false;
	
	public $local_post_index = 0;
	
	public $remote_post_index = 0;
	
	public $total_posts = 0;
	
	
	public function __construct( $args, $context = 'not-set' ) {
		
		$default_args = apply_filters('cahnrs_ignite_default_query_args', $this->args_default, $args, $context );
		
		$args = $this->query_args( $args, $default_args );
		
		$this->args = apply_filters('cahnrs_ignite_query_args', $args, $context );
		
		$this->context = $context;
		
		$this->the_query();
		
	} // End __construct
	
	
	public function set_displayed( $ignite_posts = false ){
		
		if ( ! $ignite_posts ) {
			
			$ignite_posts = $this->posts;
			
			$post_type = $this->args['post_type'];
			
		} else {
			
			$post_type = $ignite_posts->post_type;
			
		}// End if
		
	
		global $cahnrs_displayed_posts;
		
		if ( empty( $cahnrs_displayed_posts ) )
			$cahnrs_displayed_posts = array();
			
		if ( empty( $cahnrs_displayed_posts[ $post_type ] ) ) 
				$cahnrs_displayed_posts[ $post_type ] = array();
			
		foreach( $ignite_posts as $ignite_post ){
			
			if ( $ignite_post->is_remote ){
				
				if ( ! empty( $cahnrs_displayed_posts[ $post_type ]['remote'] ) ){
					
					if ( ! in_array( $ignite_post->id, $cahnrs_displayed_posts[ $post_type ]['remote'] ) ){
						
						$cahnrs_displayed_posts[ $post_type ]['remote'][] = $ignite_post->id;
						
					} // End if
					
				} else {
					
					$cahnrs_displayed_posts[ $post_type ]['remote'][] = $ignite_post->id;
					
				} // End if
				
			} else {
				
				if ( ! empty( $cahnrs_displayed_posts[ $post_type ]['local'] ) ){
					
					if ( ! in_array( $ignite_post->id, $cahnrs_displayed_posts[ $post_type ]['local'] ) ){
						
						$cahnrs_displayed_posts[ $post_type ]['local'][] = $ignite_post->id;
						
					} // End if
					
				} else {
					
					$cahnrs_displayed_posts[ $post_type ]['local'][] = $ignite_post->id;
					
				} // End if
				
			} // End if
			
		} // End Foreach
		
	} // End
	
	
	public function set_pagination(){
		
		if ( $this->total_posts ){
			
			$pages = ceil( $this->total_posts / $this->args['per_page'] );
			
			$this->pages = $pages;
			
		} // End if
		
		$this->page = $this->args['page'];
		
		$next_page = ( $this->page + 1 );
		
		$prev_page = ( $this->page - 1 );
		
		$this->next_page = ( $next_page <= $this->total_posts ) ? $next_page : false;
		
		$this->prev_page = ( $prev_page <= 0 ) ? $prev_page : false;
		
	} // End set_pagination
	
	
	public function get_displayed( $remote = false ){
		
		$displayed = array();
		
		$post_type = $this->args['post_type'];
		
		global $cahnrs_displayed_posts;
		
		if ( $remote ){
			
			if ( ! empty( $cahnrs_displayed_posts[ $post_type ]['remote'] ) ) {
				
				$displayed = $cahnrs_displayed_posts[ $post_type ]['remote'];
				
			} // End if
			
		} else {
			
			if ( ! empty( $cahnrs_displayed_posts[ $post_type ]['local'] ) ) {
				
				$displayed = $cahnrs_displayed_posts[ $post_type ]['local'];
				
			} // End if
			
		} // End if
		
		return $displayed;
		
	} // End get_displayed
	
	
	protected function the_query(){
		
		switch( $this->args['query_type'] ){
			
			case 'post':
			default:
				$this->the_post_query();
				break;
			
		} // End switch
		
		$this->set_pagination();
		
	} // End
	
	
	protected function the_post_query(){
		
		$posts = array();
		
		if ( ! empty( $this->args['include_local'] ) ){
			
			$posts = array_merge( $posts, $this->get_posts_local() );
			
		} // End if
		
		if ( ! empty( $this->args['include_remote'] ) ){
			
			$posts = array_merge( $posts, $this->get_posts_remote() );
			
		} // End if
		
		$this->posts = $posts;
		
	} // End
	
	
	protected function get_posts_remote(){
		
		$posts = array();
		
		$remote_url = $this->get_remote_query_url();
		
		$remote_response = $this->get_remote_response( $remote_url );
		
		require_once locate_template( 'classes/class-post-cahnrs-ignite.php', false );
		
		foreach( $remote_response as $remote_post ){
				
			$ignite_post = new Post_CAHNRS_Ignite();
				
			$ignite_post->set_remote( $remote_post );
				
			$posts[] = $ignite_post;
			
		} // End foreach
		
		return $posts;
		
	} // End get_posts_remote
	
	
	protected function get_posts_local(){
		
		require_once locate_template( 'classes/class-post-cahnrs-ignite.php', false );
		
		$query_args = apply_filters('cahnrs_ignite_query_args_local', $this->get_local_post_query_args(), $this->args, $this->context );
		
		$posts = array();
		
		$the_query = new WP_Query( $query_args );

		if ( $the_query->have_posts() ) {
			
			$this->total_posts = $this->total_posts + $the_query->found_posts;
			
			while ( $the_query->have_posts() ) {
				
				$the_query->the_post();
				
				$ignite_post = new Post_CAHNRS_Ignite();
				
				$ignite_post->set_local( $the_query->post );
				
				$posts[] = $ignite_post;

			} // End while

			wp_reset_postdata();
			
		} // End if
		
		return $posts;
		
	} // End get_posts_local
	
	protected function get_local_post_query_args(){
		
		$query_args = array(
			'post_type' 		=> $this->args['post_type'],
			'posts_per_page' 	=> $this->args['per_page'],
			'status'			=> $this->args['post_status'],
		);
		
		if ( ! empty( $this->args['page'] ) && ( $this->args['page'] > 1 ) ){
			
			$query_args['paged'] = $this->args['page'];
			
		} // End if
		
		if ( $this->args['exclude_already_shown'] ){
			
			$displayed_posts = $this->get_displayed();
			
			if ( ! empty( $displayed_posts ) ){
			
				$query_args[ 'post__not_in' ] = $displayed_posts;
			
			} // End if
			
		} // End If
		
		if ( $this->args['orderby'] ){
			
			$query_args[ 'orderby' ] = $this->args['orderby'];
			
		} // End If
		
		if ( $this->args['keyword'] ){
			
			$query_args[ 's' ] = $displayed_posts; 
			
		} // End If
		
		return $query_args;
		
	} // End get_local_query_args
	
	
	protected function query_args( $args, $defaults ){
		
		foreach ( $defaults as $key => $value ){
			
			if ( ! isset( $args[ $key ] ) ){
				
				$args[ $key ] = $defaults[ $key ];
				
			} // End if
			
		} // End foreach
		
		return $args;
		
	} // End query_args
	
	
	protected function get_remote_query_url(){
		
		$request_url = $this->build_request_url();
		
		$fields =  array( 'per_page', 'exclude', 'search' );
		
		$query = array();
		
		foreach( $fields as $field ){
			
			if ( ! empty( $this->args[ $field ] ) ){
			
				$query[ $field ] = $this->args[ $field ];
				
			} // End if
			
		} // End foreach
		
		if ( ! empty( $this->args['remote_categories'] ) ){
			
			$cats = explode( ',', $this->args['remote_categories'] );
			
			if ( is_numeric( $cats[0] ) ){
				
				$query[ 'categories' ] = $this->args['remote_categories'];
				
			} else {
				
				$query[ 'remote_categories' ] = $this->args['remote_categories'];
				
			} // End if
			
		} // End if
	
		
		if ( $this->args['exclude_already_shown'] ){
			
			$displayed_posts = $this->get_displayed( true );
			
			if ( ! empty( $displayed_posts ) ){
			
				$query[ 'exclude' ] = implode( ',', $displayed_posts );
			
			} // End if
			
		} // End If
		
		$query = apply_filters( 'cahnrs_ignite_query_args_remote', $query, $this->args, $this->context );
		
		if ( ! empty( $query ) ){
			
			$request_url .= '?' . http_build_query( $query );
			
		} // End if
		
		if ( isset( $_GET['debug'] ) ) var_dump( $request_url );
		
		return $request_url;
		
	} // End get_article_query
	
	
	protected function build_request_url(){
		
		$remote_url = '';
		
		if ( 'post' === $this->args['query_type'] ) { 
		
			$remote_url = $this->args['url'] . $this->args['request_base'] . $this->args['post_type'];
		
		} // End if
		
		return $remote_url;
		
	} // End build_request_url
	
	
	protected function get_remote_response( $request_url ){
		
		$response = array();
		
		$request_response = wp_remote_get( $request_url, array( 'timeout' => 15 ) );
		
		if( ! is_wp_error( $request_response ) ) {
			
			$json = wp_remote_retrieve_body( $request_response );
			
			$headers = wp_remote_retrieve_headers( $request_response );
			
			if ( ! empty( $headers['x-wp-total'] ) ) $this->total_posts = $this->total_posts + $headers['x-wp-total'];
			
			$response_json = json_decode( $json, true );
			
			if ( is_array( $response_json ) ){
				
				$response = $response_json;
				
			} // End if
			
		} // End if
		
		return $response;
		
	} // End get_response
	
	
	
	
	/* OLD *****************************************************************************/
	
	
	protected function get_response(){
		
		$request_type = ( ! empty( $this->args['request_type'] ) )? $this->args['request_type'] : 'post';
		
		switch( $request_type ){
			
			case 'post':
			default:
				$response = $this->get_post_response();
				break;
			
		} // End switch
		
		return $response;
		
	} // End get_response
	
	
	protected function get_post_response(){
		
		$post_type = ( ! empty( $this->args['post_type'] ) )? $this->args['post_type'] : 'article';
		
		switch( $request_type ){
			
			case 'article':
			default:
				$response = $this->get_article_response();
				break;
			
		} // End switch
		
		return $response;
		
	} // End get_post_response

	
	protected function get_article_response() {
		
		$default_args = array(
			'url' 					=> 'http://cahnrs.wsu.edu/news',
			'request_base'			=> '/wp-json/wp/v2/',
			'request_type' 			=> 'post',
			'post_type' 			=> 'article',
			'categories' 			=> '',
			'category_relation' 	=> 'OR',
			'tags' 					=> '',
			'tag_relation' 			=> 'OR',
			'per_page' 				=> 10,
			'order_by' 				=> 'date',
			'order' 				=> 'ASC',
			'offset' 				=> 0,
			'exclude' 				=> '',
			'article_placement' 	=> '',
			'article_topic'			=> '',
			'article_subject' 		=> '',
			'subject_relation'		=> 'OR',
			'topic_relation' 		=> 'OR',
			'article_relation' 		=> 'AND',
			'sites' 				=> '',
			'site_relation' 		=> 'OR',
		);
		
		$this->args = $this->get_args( $default_args );
		
		$request_url = $this->get_article_query_url();
		
		$response = $this->get_remote_response( $request_url );
		
		return $response;
		
	}
	
	protected function get_article_query_url(){
		
		$request_url = $this->build_request_url();
		
		$add_fields = array( 'article_placement','article_topic','article_subject','subject_relation','topic_relation','article_relation','sites','site_relation' );
		
		$query_params = $this->get_basic_post_query( $add_fields );
		
		if ( ! empty( $query_params ) ){
			
			$request_url .= '?' . http_build_query( $query_params );
			
		} // End if
		
		return $request_url;
		
	} // End get_article_query
	
	
	protected function get_args( $defaut_args ){
		
		$args = apply_filters( 'ignite_remote_request_args', $this->args, $defaut_args , $this->context );
		
		foreach( $defaut_args as $key => $value ){
			
			if ( ! empty( $args[ $key ] ) ){
				
				$defaut_args[ $key ] = $args[ $key ];
				
			} // End if
			
		} // End foreach
		
		return $defaut_args;
		
	} // End get_args
	
	
	protected function get_basic_post_query( $add_fields = array() ){
		
		$base_fields = array( 'per_page', 'exclude' );
		
		$fields = array_merge( $add_fields, $base_fields );
		
		$query = array();
		
		foreach( $fields as $field ){
			
			if ( ! empty( $this->args[ $field ] ) ){
			
				$query[ $field ] = $this->args[ $field ];
				
			} // End if
			
		} // End foreach
		
		return $query;
		
	} // End get_basic_post_query
	
	
	/*public function get_request_response( $args, $context = 'not-set' ) {
		
		//var_dump( $args );
		
		$response = array();
		
		$default_args = array(
			'url' 				=> 'http://cahnrs.wsu.edu/news',
			'request_base'		=> '/wp-json/wp/v2/',
			'request_type' 		=> 'posts',
			'post_type' 		=> 'article',
			'categories' 		=> '',
			'category_relation' => 'OR',
			'tags' 				=> '',
			'tag_relation' 		=> 'OR',
			'per_page' 			=> 10,
			'order_by' 			=> 'date',
			'order' 			=> 'ASC',
			'offset' 			=> 0,
			'exclude' 			=> '',
		);
		
		$args = $this->get_args( $default_args, $args, $context );
		
		//var_dump( $args );
		
		switch( $args['request_type'] ){
			
			case 'posts':
				$response = $this->get_posts_request_response( $args, $context );
				break;
				
		} // End switch
		
		return $response;
		
	} // End get_request*/
	
	
	/*private function get_article_response( $args, $context ){
		
		$request_url = $this->build_request_url( $args, $context );
		
	} // End get_article_response
	
	
	private function get_article_query( $args, $context ){
		
		$query_params = $this->get_basic_post_query( $args, $context );
		
	} // End get_article_query
	
	
	private function get_basic_post_query( $args, $context ){
		
		$query = array();
		
		if ( ! empty( $args['per_page'] ) ){
			
			$query['per_page'] = $args['per_page'];
			
		} // End if
		
		if ( ! empty( $args['exclude'] ) ){
			
			$query['exclude'] = $args['exclude'];
			
		} // End if
		
		return $query;
		
	} // End get_basic_post_query
	
	
	private function build_request_url( $args, $context ){
		
		$remote_url = '';
		
		if ( 'post' === $args['request_type'] ) { 
		
			$remote_url = $args['url'] . $args['request_base'] . $args['post_type'];
		
		} // End if
		
		return $remote_url;
		
	} // End build_request_url
	
	
	private function get_response( $request_url ){
		
		$response = array();
		
		if( ! is_wp_error( $request_response ) ) {
			
			$json = wp_remote_retrieve_body( $request_response );
			
			$response_json = json_decode( $json, true );
			
			if ( is_array( $response_json ) ){
				
				$response = $response_json;
				
			} // End if
			
		} // End if
		
		return $response;
		
	} // End get_response
	
	
	private function get_posts_request_response( $args, $context ){
		
		$response = array();
		
		$request_url = $this->get_posts_request_response_url( $args, $context );
		
		//var_dump( $request_url );
		
		$request_response = wp_remote_get( $request_url );
		
		if( ! is_wp_error( $request_response ) ) {
			
			$json = wp_remote_retrieve_body( $request_response );
			
			$response_json = json_decode( $json, true );
			
			if ( is_array( $response_json ) ){
				
				$response = $response_json;
				
			} // End if
			
		} // End if
		
		return $response;
		
	} // End get_posts_request_response
	
	
	private function get_posts_request_response_url( $args, $context ){
		
		//var_dump( $args );
		
		$remote_url = $args['url'] . $args['request_base'] . $args['post_type'];
		
		$query_params = array();
		
		if ( ! empty( $args['per_page'] ) ){
			
			$query_params['per_page'] = $args['per_page'];
			
		} // End if
		
		if ( ! empty( $args['exclude'] ) ){
			
			$query_params['exclude'] = $args['exclude'];
			
		} // End if
		
		if ( ! empty( $query_params ) ){
			
			$remote_url .= '?' . http_build_query( $query_params );
			
		} // End if
		
		return $remote_url;
		
	} // End get_posts_request_response_url
	
	
	private function get_args( $defaut_args, $args, $context ){
		
		$args = apply_filters( 'ignite_remote_request_args', $args, $defaut_args , $context );
		
		foreach( $defaut_args as $key => $value ){
			
			if ( ! empty( $args[ $key ] ) ){
				
				$defaut_args[ $key ] = $args[ $key ];
				
			} // End if
			
		} // End foreach
		
		return $defaut_args;
		
	} // End get_args*/
	
} // End Remote_Request_CAHNRS_Ignite