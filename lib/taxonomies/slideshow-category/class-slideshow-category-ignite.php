<?php

class Slideshow_Category_Ignite {
	
	
	public function __construct(){
		
		
		add_action( 'init', array( $this, 'register_taxonomy'), 999 );
		
		
	} // End __construct
	
	
	public function register_taxonomy(){
		
		$labels = array(
			'name'              => 'Slideshow Categories',
			'singular_name'     => 'Slideshow Category',
			'search_items'      => 'Search Categories',
			'all_items'         => 'All Categories', 
			'parent_item'       => 'Parent Slideshow Category',
			'parent_item_colon' => 'Parent Slideshow Category:',
			'edit_item'         => 'Edit Slideshow Category',
			'update_item'       => 'Update Slideshow Category',
			'add_new_item'      => 'Add New Slideshow Category',
			'new_item_name'     => 'New Slideshow Category',
			'menu_name'         => 'Slideshow Category',
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'slideshows' ),
		);

		register_taxonomy( 'slideshow_category', array( 'slides' ), $args );
		
		
	} // End register taxonomy
	
	
} // End Slideshow_Category_Ignite

$slideshow_category_ignite = new Slideshow_Category_Ignite();