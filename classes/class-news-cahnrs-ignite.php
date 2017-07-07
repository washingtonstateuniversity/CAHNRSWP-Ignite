<?php

class News_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_post_type' ) );
		
	} // End __construct
	
	
	public function register_post_type(){
		
		$labels = array(
			'name'               => 'News',
			'singular_name'      => 'News', 
			'menu_name'          => 'News',
			'name_admin_bar'     => 'News',
			'add_new'            => 'Add New Item',
			'add_new_item'       => 'Add News Item', 
			'new_item'           => 'New News Item', 
			'edit_item'          => 'Edit News Item', 
			'view_item'          => 'View News Item', 
			'all_items'          => 'All News', 
			'search_items'       => 'Search News', 
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
			'rewrite'            => array( 'slug' => 'news' ),
			'capability_type'    => 'post',
			'show_in_rest'		 => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions' )
		);
		
		register_post_type( 'news', $args );
		
		
	} // End register_post_type
	
	
} // End News_CAHNRS_Ignite

$news_cahnrs_ignite = new News_CAHNRS_Ignite();