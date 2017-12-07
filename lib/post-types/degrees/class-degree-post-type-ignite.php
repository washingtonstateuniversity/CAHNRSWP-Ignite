<?php

class Degree_Post_Type_Ignite {
	
	protected $fields = array(
		'_ignite_degree_type' => 'text',
	);
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_post_type' ) );
		
		add_action( 'edit_form_after_title', array( $this, 'add_edit_form' ) );
		
	} // End __construct
	
	
	public function register_post_type(){
		
		if ( ignite_check_active_post_type( 'degree' ) ){
		
			$labels = array(
				'name'               => 'Degrees',
				'singular_name'      => 'Degree',
				'menu_name'          => 'Degrees',
				'name_admin_bar'     => 'Degree',
				'add_new'            => 'Add New',
				'add_new_item'       =>  'Add New Degree',
				'new_item'           =>  'New Degree',
				'edit_item'          =>  'Edit Degree',
				'view_item'          =>  'View Degree',
				'all_items'          =>  'All Degrees',
				'search_items'       =>  'Search Degrees',
				'parent_item_colon'  =>  'Parent Degrees:',
				'not_found'          =>  'No degrees found.',
				'not_found_in_trash' =>  'No degrees found in Trash.',
			);

			$args = array(
				'labels'             => $labels,
				'description'        => 'Description.',
				'public'             => true,
				'rewrite'            => array( 'slug' => 'degree' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'supports'           => array( 'title', 'thumbnail', 'excerpt', )
			);

			register_post_type( 'degree', $args );
			
		} // End if
		
	} // End register_post_type
	
	
	public function add_edit_form( $post ){
		
		if ( 'degree' === $post->post_type ){
			
			$settings = $this->get_settings( $post->ID );
			
			$degree_types = array(
				'ba' => 'BA',
				'bs' => 'BS',
				'ma' => 'MA',
				'ms' => 'MS',
				'phd' => 'PHD'
			);
			
			include ignite_get_theme_path('lib/post-types/degrees/editor/degree-type.php');
			
			include ignite_get_theme_path('lib/post-types/degrees/editor/degree-type-undergraduate.php');
			
		} // End if
		
	} // End add_edit_form
	
	
	public function get_settings( $post_id ){
		
		$settings = array();
		
		foreach( $this->fields as $key => $type ){
			
			$settings[$key] = get_post_meta( $post_id, $key, true );
			
		} // End foreach
		
		return $settings;
		
	} // End get_settings
	
} // End Degree_Post_Type_Ignite

$degrees_post_type_ignite = new Degree_Post_Type_Ignite();