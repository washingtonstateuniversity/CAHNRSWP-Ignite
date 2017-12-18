<?php

class Indexed_Content_Post_Type_Ignite extends Post_Type_Ignite {
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_post_type' ) );
		
		
		add_action( 'init', array( $this, 'register_taxonomy' ) );
	} // End __construct
	
	
	public function register_post_type(){
		
		if ( $this->check_enabled( 'indexed_content' ) ){
		
			$labels = array(
				'name'               => 'Indexed Content',
				'singular_name'      => 'Indexed Content', 
				'menu_name'          => 'Indexed Content',
				'name_admin_bar'     => 'Indexed Content',
				'add_new'            => 'Add Indexed Content',
				'add_new_item'       => 'Add Indexed Content', 
				'new_item'           => 'New Indexed Content', 
				'edit_item'          => 'Edit Indexed Content', 
				'view_item'          => 'View Indexed Content', 
				'all_items'          => 'All Indexed Content', 
				'search_items'       => 'Search Indexed Content', 
				'parent_item_colon'  => 'Parent Indexed Content:', 
				'not_found'          => 'No Indexed Content found.',
				'not_found_in_trash' => 'No Indexed Content found in Trash.',
			);
		
			$args = array(
				'labels'			 => $labels,
				'description'        => 'Indexed Content for Theme use.', 
				'public'             => true,
				'show_in_menu'       => true,
				'rewrite'            => array( 'slug' => 'content' ),
				'capability_type'    => 'post',
				'show_in_rest'		 => true,
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title','editor','thumbnail','excerpt','post-formats' )
			);
			
			register_post_type( 'indexed_content', $args );
		
		} // End if
		
		
	} // End register_post_type
	
	
	public function register_taxonomy(){
		
		register_taxonomy(
			'content_category',
			'indexed_content',
			array(
				'label' => 'Content Categories',
				'rewrite' => array( 'slug' => 'content-category' ),
				'hierarchical' => true,
			)
		);
		
	} // End register_taxonomy

	
} // Indexed_Content_Post_Type_Ignit

$indexed_content_post_type_ignite = new Indexed_Content_Post_Type_Ignite();