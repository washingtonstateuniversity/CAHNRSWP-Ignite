<?php

class Remote_Request_CAHNRS_Ignite {
	
	public function get_request_response( $args, $context ) {
		
		$response = array();
		
		$default_args = array(
			'url' 				=> 'http://cahnrs.wsu.edu',
			'request_base'		=> '/wp-json/wp/v2/',
			'request_type' 		=> 'posts',
			'post_type' 		=> 'news_release',
			'categories' 		=> '',
			'category_relation' => 'OR',
			'tags' 				=> '',
			'tag_relation' 		=> 'OR',
			'per_page' 			=> 10,
			'order_by' 			=> 'date',
			'order' 			=> 'ASC',
			'offset' 			=> 0,
		);
		
		$args = $this->get_args( $default_args, $args, $context );
		
		switch( $args['request_type'] ){
			
			case 'posts':
				$response = $this->get_posts_request_response( $args, $context );
				break;
				
		} // End switch
		
		return $response;
		
	} // End get_request
	
	
	private function get_posts_request_response( $args, $context ){
		
		$response = array();
		
		$request_url = $this->get_posts_request_response_url( $args, $context );
		
		$request_response = wp_remote_get( $request_url );
		
		if( ! is_wp_error( $request_response ) ) {
			
			$json = wp_remote_retrieve_body( $request_response );
			
			$response_json = json_decode( $json );
			
			if ( is_array( $response_json ) ){
				
				$response = $response_json;
				
			} // End if
			
		} // End if
		
		return $response;
		
	} // End get_posts_request_response
	
	
	private function get_posts_request_response_url( $args, $context ){
		
		$remote_url = $args['url'] . $args['request_base'] . $args['post_type'];
		
		$query_params = array();
		
		if ( isset( $args['per_page'] ) ){
			
			$query_params['per_page'] = $args['per_page'];
			
		} // End if
		
		if ( isset( $args['categories'] ) ){
			
			$query_params['categories'] = $args['categories'];
			
		} // End if
		
		if ( ! empty( $query_params ) ){
			
			$remote_url .= '?' . http_build_query( $query_params );
			
		} // End if
		
		return $remote_url;
		
	} // End get_posts_request_response_url
	
	
	private function get_args( $defaut_args, $args, $context ){
		
		$args = apply_filters( 'ignite_remote_request_args', $default_args, $args, $context );
		
		foreach( $defaut_args as $key => $value ){
			
			if ( ! empty( $args[ $key ] ) ){
				
				$defaut_args[ $key ] = $args[ $key ];
				
			} // End if
			
		} // End foreach
		
		return $defaut_args;
		
	} // End get_args
	
} // End Remote_Request_CAHNRS_Ignite