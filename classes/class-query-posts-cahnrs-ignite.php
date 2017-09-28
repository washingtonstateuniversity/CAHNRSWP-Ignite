<?php

class Query_Posts_CAHNRS_Ignite {
	
	protected $query_args = array();
	
	protected $default_args = array(
		'base_url' 					=> '',
		'post_type'					=> 'post',
		'post_status'				=> 'publish',
		'per_page' 					=> 5,
		'page'						=> 0,
		'tags'						=> '',
		'categories' 				=> '',
		'order_by'					=> 'date',
		'offset'					=> 0,
		'category_relation' 		=> 'IN',
		'tag_relation' 				=> 'IN',
		'order' 					=> 'ASC',
		'exclude'					=> '',
		'meta_relation' 			=> 'OR',
		'include_remote' 			=> false,
		'include_local' 			=> true,
		'exclude_already_shown' 	=> 0,
		'remote_exclude'			=> '',
		'remote_categories' 		=> '',
		'remote_category_relation' 	=> 'OR',
		'remote_tags' 				=> '',
		'remote_tag_relation' 		=> 'OR',
		'keyword'					=> '',
		'allow_paged'				=> 1,
		'is_ajax'					=> 0,
		'prefix'					=> '',
	);
	
	protected $args = array();

	
	public function __construct( $args = array() ){
		
		$this->args = shortcode_atts( $this->default_args, $args );
			
		$this->set_query_args();
	
	} // End __construct
	
	
	public function get_query_args(){
		
		return $this->query_args;
		
	} // End get_query_args
	
	
	protected function set_query_args(){
		
		$q_args = array(
			'post_type' 		=> $this->args['post_type'],
			'posts_per_page' 	=> $this->args['per_page'],
			'post_status' 		=> $this->args['post_status'],
		);
		
		$this->set_page_args( $q_args );
		
		$this->set_category_args( $q_args );
		
		$this->set_order_args( $q_args );
		
		$this->set_tag_args( $q_args );
		
		//if ( isset( $_GET['test'])) var_dump( $q_args );
		
		$this->query_args = array_merge( $this->query_args, $q_args );
	
	} // End set_query_args
	
	
	protected function set_page_args( &$q_args ){
		
		if ( $this->args['allow_paged'] ){
			
			$page = false;
			
			$key = ( ! empty( $this->args['prefix'] ) )? $this->args['prefix'] . '-ci-page' : 'ci-page';
			
			if ( ! empty( $_REQUEST[ $key ] ) ){
				
				$page = sanitize_text_field( $_REQUEST[ $key ] );
				
			} else if ( $this->args['page'] ){
				
				$page = $this->args['page'];
			
			} // End if
			
			if ( $page ){
				
				$q_args['paged'] = $page;
				
			} // End if
		
		} // End if
		
	} // End set_page_args
	
	protected function set_category_args( &$q_args ){
		
		if ( ! empty( $this->args['categories'] ) ){
			
			$cats = explode( ',', $this->args['categories'] );
			
			$cat_query = array(
				'taxonomy' 	=> 'category',
				'terms' 	=> $cats,
				'field' 	=> ( is_numeric( $cats[0] )) ? 'term_id' : 'slug',
				'operator' 	=> $this->args['category_relation'],
			);
			
			if ( ! isset( $q_args['tax_query'] ) ) $q_args['tax_query'] = array();
			
			$q_args['tax_query'][] = $cat_query;
			
		} // End if
		
	} // End get_category_args
	
	protected function set_tag_args( &$q_args ){
		
		if ( ! empty( $this->args['tags'] ) ){
			
			$tags = explode( ',', $this->args['tags'] );
			
			$tag_query = array(
				'taxonomy' 	=> 'post_tag',
				'terms' 	=> $tags,
				'field' 	=> ( is_numeric( $tags[0] )) ? 'term_id' : 'slug',
				'operator' 	=> $this->args['tag_relation'],
			);
			
			if ( ! isset( $q_args['tax_query'] ) ) $q_args['tax_query'] = array();
			
			$q_args['tax_query'][] = $tag_query;
			
		} // End if
		
	} // End get_category_args
	
	
	protected function set_order_args( &$q_args ){
		
		$q_args['order'] = $this->args['order'];
		
		$q_args['order_by'] = $this->args['order_by'];
		
	} // End set_order_args

} // End Query_Posts_CAHNRS_Ignite