<?php

class Theme_Setup_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'set_default_template' ), 9999 );
		
		add_action( 'init', array( $this, 'add_page_taxonomy' ) );
		
		add_filter( 'cahnrs_ignite_page_html', array( $this, 'check_cropped_spine' ) );
		
		add_action( 'rest_api_init', array( $this, 'do_register_rest_field' ) );
		
		add_action( 'rest_query_vars', array( $this, 'add_custom_query_vars' ) );
		
		add_action( 'init', array( $this, 'init' ), 999 );
		
		add_action( 'template_include' , array( $this, 'add_templates' ), 9999 );
		
	} // End __construct
	
	
	public function add_templates( $template ){
		
		if ( isset( $_GET['rest-ext'] ) || isset( $_GET['get-post-json'] ) ){
			
			global $post;
			
			$site_url = get_site_url() . '/wp-json/wp/v2/';
			
			if ( $post->post_type !== 'post' ){
				
				$site_url .= $post->post_type .'/';
				
			} else {
				
				$site_url .= 'posts/';
				
			} // End if
			
			$site_url .= $post->ID;
		
			wp_redirect( $site_url );
			
		} // End If
		
		if ( isset( $_GET['not-found'] ) && empty( $_GET['has-page'] ) ){
			
			$template = locate_template( 'ignite-404.php', false );
			
		} // End if
		
		return $template;
		
	} // End if
	
	
	public function add_page_taxonomy(){
		
		// Add tag metabox to page
		register_taxonomy_for_object_type('post_tag', 'page');
		
		// Add category metabox to page
		register_taxonomy_for_object_type('category', 'page');  
		
	} // End add_page_taxonomy
	
	
	public function init(){
		
		$post_types = get_post_types( array(), 'objects' );
		
		foreach( $post_types as $post_type ){
			
			add_filter( 'rest_' . $post_type->name . '_query', array( $this, 'custom_rest_query_args'), 10, 2 );
			
		} // End foreach
		
	} // End init
	
	
	public function set_default_template(){
		
		$builder_setting = get_theme_mod( '_cahnrswp_enable_spine_builder', 'disable');
		
		if ( 'disable' === $builder_setting ){
		
			add_filter( 'spine_enable_builder_module', array( $this, 'disable_builder_module'), 9999 );
		
		} // End if
		
	} // End set_default_template
	
	
	public function disable_builder_module( $setting ){
		
		return false;
		
	} // End $setting
	
	
	public function check_cropped_spine( $html ){
		
		$is_cropped = get_theme_mod( '_cahnrs_ignite_global_cropped_spine', false );
		
		if ( $is_cropped ){
			
			$html = preg_replace_callback( 
				'/id="spine"(.*?)class="/', 
				function( $match ){ 
					return $match[0] . 'cropped '; 
				}, 
				$html
			); 
			
		} // End if
		
		return $html;
		
	} // End check_cropped_spine
	
	
	public function do_register_rest_field(){
		
		register_rest_field( 
			'article', 
			'post_images', 
			array( 
				'get_callback' => array( $this, 'add_rest_image')
			)
		);
		
	} // End register_rest_field
	
	
	public function add_rest_image( $object, $field_name, $request ){
		
		$images = array();
		
		$post_id = $object[ 'id' ];
		
		if ( has_post_thumbnail( $post_id ) ){
			
			$image_sizes = array('full','large','medium','thumbnail');
			
			$img_id = get_post_thumbnail_id( $post_id );
			
			foreach( $image_sizes as $size ){
				
				$img_url_array = wp_get_attachment_image_src( $img_id, $size, true );
				
				$images[ $size ] = $img_url_array[0];
				
			} // End foreach
			
		} // End if
		
		return $images;
		
	} // End add_rest_image
	
	
	public function add_custom_query_vars( $vars ){
		
		$fields = array( 'remote_categories' );
		
		$vars = array_merge( $vars, $fields );
		
		return $vars;
		
	} // End function add_custom_query_vars
	
	
	public function custom_rest_query_args( $args, $request ){
		
		$tax_query = array();
		
		$cat_ids = array();
		
		if ( ! empty( $_GET['remote_categories'] ) ){
			
			$cats = explode( ',', $_GET['remote_categories'] );
			
			foreach( $cats as $cat_name ){
				
				$cat_id = get_cat_ID( $cat_name );
				
				if ( $cat_id ){
					
					$cat_ids[] = $cat_id;
					
				} // End if
				
			} // End foreach
			
		} // End if
		
		if ( ! empty( $cat_ids ) ){
			
			$args['cat'] = implode( ',', $cat_ids );
			
		} // End if
		
		return $args;
		
	} // End custom_rest_query_args
	
	
} // End Theme_Setup_CAHNRS_Ignite

$theme_setup = new Theme_Setup_CAHNRS_Ignite();