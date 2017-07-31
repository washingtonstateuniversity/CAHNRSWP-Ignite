<?php

class Articles_Post_Type_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_post_type' ) );
		
	} // End __construct
	
	
	public function register_post_type(){
		
		$labels = array(
			'name'               => 'News Articles',
			'singular_name'      => 'News Articles', 
			'menu_name'          => 'News Articles',
			'name_admin_bar'     => 'News Articles',
			'add_new'            => 'Add New Item',
			'add_new_item'       => 'Add News Item', 
			'new_item'           => 'New News Item', 
			'edit_item'          => 'Edit News Item', 
			'view_item'          => 'View News Item', 
			'all_items'          => 'All News Articles', 
			'search_items'       => 'Search News Articles', 
			'parent_item_colon'  => 'Parent News:', 
			'not_found'          => 'No news found.',
			'not_found_in_trash' => 'No news found in Trash.',
		);
	
		$args = array(
			'labels'			 => $labels,
			'description'        => 'News & Announcements.', 
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'article' ),
			'capability_type'    => 'post',
			'show_in_rest'		 => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'taxonomies'		=> array( 'category', 'post_tag' ),
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'post-formats' )
		);
		
		register_post_type( 'article', $args );
		
		
	} // End register_post_type
	
} // End Articles_Post_Type_CAHNRS_Ignite

$article_post_type = new Articles_Post_Type_CAHNRS_Ignite();