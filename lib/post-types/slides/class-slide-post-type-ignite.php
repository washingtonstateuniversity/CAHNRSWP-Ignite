<?php

class Slide_Post_Type_Ignite extends Post_Type_Ignite {
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_post_type' ) );
		
		//add_filter( 'cwpb_register_items', array( $this, 'add_pagebuilder_item' ) );
		
		add_action( 'edit_form_after_title' , array( $this, 'add_edit_form' ) );
		
		add_action( 'save_post_slides' , array( $this, 'save' ) );
		
		//add_action( 'template_include' , array( $this, 'check_redirect' ), 1 );
		
	} // End __construct
	
	
	public function register_post_type(){
		
		if ( $this->check_enabled( 'slides' ) ){
		
			$labels = array(
				'name'               => 'Slides',
				'singular_name'      => 'Slides', 
				'menu_name'          => 'Slides',
				'name_admin_bar'     => 'Slides',
				'add_new'            => 'Add Slide',
				'add_new_item'       => 'Add Slide', 
				'new_item'           => 'New Slide', 
				'edit_item'          => 'Edit Slide', 
				'view_item'          => 'View Slide', 
				'all_items'          => 'All Slides', 
				'search_items'       => 'Search Slides', 
				'parent_item_colon'  => 'Parent Slides:', 
				'not_found'          => 'No slides found.',
				'not_found_in_trash' => 'No slides found in Trash.',
			);
		
			$args = array(
				'labels'			 => $labels,
				'description'        => 'Slides for Theme use.', 
				'public'             => true,
				'exclude_from_search' => true,
				//'publicly_queryable' => true,
				//'show_ui'            => true,
				'show_in_menu'       => true,
				'taxonomies'          => array( 'category', ' post_tag' ),
				'rewrite'            => array( 'slug' => 'slides' ),
				'capability_type'    => 'post',
				'show_in_rest'		 => true,
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title','revisions','excerpt','thumbnail' )
			);
			
			register_post_type( 'slides', $args );
		
		} // End if
		
		
	} // End register_post_type
	
	
	public function add_edit_form( $post ){
		
		$subtitle = get_post_meta( $post->ID, '_subtitle', true );
			
		$redirect_url = get_post_meta( $post->ID, '_redirect_url', true );
		
		if ( 'slides' === $post->post_type ){
			
			include 'includes/editor.php';
			
		} // End if
		
	} // End add_edit_form
	
	
	public function save( $post_id){
		
		$save_fields = array(
			'_redirect_url' => 'text',
			'_subtitle'		=> 'text',
		);
		
		if ( $this->check_can_save( $post_id ) ){
			
			$clean_fields = $this->get_clean_fields( $save_fields );
			
			foreach( $clean_fields as $key => $value ){
				
				update_post_meta( $post_id, $key, $value );
				
			} // End if
			
		} // End if
		
	} // End save
	
	
} // End Slide_Post_Type_Ignite

$slides_post_type_ignite = new Slide_Post_Type_Ignite();