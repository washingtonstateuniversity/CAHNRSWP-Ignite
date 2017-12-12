<?php 

class Theme_Part_Post_Type_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_post_type' ) );
		
		add_filter( 'cwpb_register_items', array( $this, 'add_pagebuilder_item' ) );
		
		add_action( 'edit_form_after_title' , array( $this, 'add_edit_form' ) );
		
		add_action( 'save_post_theme_part' , array( $this, 'save' ) );
		
		add_action( 'template_include' , array( $this, 'check_redirect' ), 1 );
		
	} // End __construct
	
	
	public function add_pagebuilder_item( $items_array ) {
		
		if ( class_exists( 'CPB_Item' ) ){
		
			$items_array['cahnrs_theme_part'] = array(
				'class'   	=> 'Theme_Part_Pagebuilder_Item_CAHNRS_Ignite',
				'file_path' => locate_template( 'lib/pagebuilder-items/theme-part/class-theme-part-pagebuilder-item-cahnrs-ignite.php', false ),
				'exclude' 	=> 1,
				'priority'  => 8,
			);
		
		} // End if
		
		return $items_array;
		
	} // End add_pagebuilder_item
	
	
	public function register_post_type(){
		
		if ( $this->check_enabled() ){
		
			$labels = array(
				'name'               => 'Theme Parts',
				'singular_name'      => 'Theme Parts', 
				'menu_name'          => 'Theme Parts',
				'name_admin_bar'     => 'Theme Parts',
				'add_new'            => 'Add Theme Part',
				'add_new_item'       => 'Add Theme Part', 
				'new_item'           => 'New Theme Part', 
				'edit_item'          => 'Edit Theme Part', 
				'view_item'          => 'View Theme Part', 
				'all_items'          => 'All Theme Parts', 
				'search_items'       => 'Search Theme Parts', 
				'parent_item_colon'  => 'Parent Theme Parts:', 
				'not_found'          => 'No parts found.',
				'not_found_in_trash' => 'No parts found in Trash.',
			);
		
			$args = array(
				'labels'			 => $labels,
				'description'        => 'Reusable Theme Content.', 
				'public'             => true,
				//'publicly_queryable' => true,
				//'show_ui'            => true,
				'show_in_menu'       => true,
				'taxonomies'          => array( 'category', ' post_tag' ),
				'rewrite'            => array( 'slug' => 'parts' ),
				'capability_type'    => 'post',
				'show_in_rest'		 => true,
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'revisions','excerpt','thumbnail' )
			);
			
			register_post_type( 'theme_part', $args );
		
		} // End if
		
		
	} // End register_post_type
	
	
	public function add_edit_form( $post ){
		
		if ( 'theme_part' == $post->post_type ){
			
			include locate_template( 'lib/post-types/theme-parts/includes/edit-form.php', false );
			
		} // End if
		
	} // End add_edit_form
	
	
	public function check_enabled(){
		
		return ( get_theme_mod( '_cahnrswp_enable_theme_parts', false ) ) ? true : false;
		
	} // End check_enabled
	
	
	public function save( $post_id ){
		
		if ( isset( $_POST['_redirect_url'] ) ){
			
			$clean = sanitize_text_field( $_POST['_redirect_url'] );
			
			update_post_meta( $post_id, '_redirect_url', $clean );
			
		} // End if
		
	} // End save
	
	
	public function check_redirect( $template ){
		
		if ( is_singular( 'theme_part' ) ){
			
			global $post;
			
			$redirect = get_post_meta( $post->ID, '_redirect_url', true );
			
			if ( ! empty( $redirect ) ){
				
				wp_redirect( $redirect );
				
				exit;
				
				//$template = locate_template( 'lib/theme-templates/redirect.php', false );
				
				//wp_redirect( $redirect );
				
			} // End if
			
		} // End if
		
		return $template;
		
	} // End check_redirect
	
	
} // End Theme_Part_Post_Type_CAHNRS_Ignite

$theme_part_post_type_cahnrs_ignite = new Theme_Part_Post_Type_CAHNRS_Ignite();