<?php 

class Publications_Post_Type_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_post_type' ) );
		
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		
		//add_filter( 'cwpb_register_items', array( $this, 'add_pagebuilder_item' ) );
		
		add_action( 'edit_form_after_title' , array( $this, 'add_edit_form' ) );
		
		add_action( 'save_post_publications' , array( $this, 'save' ) );
		
		add_action( 'template_include' , array( $this, 'check_redirect' ), 1 );
		
	} // End __construct
	
	
	public function add_pagebuilder_item( $items_array ) {
		
		/*if ( class_exists( 'CPB_Item' ) ){
		
			$items_array['cahnrs_theme_part'] = array(
				'class'   	=> 'Theme_Part_Pagebuilder_Item_CAHNRS_Ignite',
				'file_path' => locate_template( 'lib/pagebuilder-items/theme-part/class-theme-part-pagebuilder-item-cahnrs-ignite.php', false ),
				'exclude' 	=> 1,
				'priority'  => 8,
			);
		
		} // End if
		
		return $items_array;*/
		
	} // End add_pagebuilder_item
	
	
	public function register_taxonomy(){
		
		if ( $this->check_enabled() ){
		
			register_taxonomy(
				'journals',
				'publications',
				array(
					'label' => __( 'Journals' ),
					'rewrite' => array( 'slug' => 'journal' ),
					'hierarchical' => true,
				)
			);
			
			register_taxonomy(
				'departments',
				'publications',
				array(
					'label' => __( 'Departments & Units' ),
					'rewrite' => array( 'slug' => 'units' ),
					'hierarchical' => true,
				)
			);
			
			register_taxonomy(
				'publication_author',
				'publications',
				array(
					'label' => __( 'Publication Authors' ),
					'rewrite' => array( 'slug' => 'pub-authors' ),
					'hierarchical' => true,
				)
			);
		
		} // End if
		
	} // End register_taxonomy
	
	
	public function register_post_type(){
		
		if ( $this->check_enabled() ){
		
			$labels = array(
				'name'               => 'Publications',
				'singular_name'      => 'Publications', 
				'menu_name'          => 'Publications',
				'name_admin_bar'     => 'Publications',
				'add_new'            => 'Add Publication',
				'add_new_item'       => 'Add Publication', 
				'new_item'           => 'New Publication', 
				'edit_item'          => 'Edit Publication', 
				'view_item'          => 'View Publication', 
				'all_items'          => 'All Publications', 
				'search_items'       => 'Search Publications', 
				'parent_item_colon'  => 'Parent Publications:', 
				'not_found'          => 'No parts found.',
				'not_found_in_trash' => 'No parts found in Trash.',
			);
		
			$args = array(
				'labels'			 => $labels,
				'description'        => 'Publications.', 
				'public'             => true,
				//'publicly_queryable' => true,
				//'show_ui'            => true,
				'show_in_menu'       => true,
				'taxonomies'          => array( 'category', ' post_tag' ),
				'rewrite'            => array( 'slug' => 'publications' ),
				'capability_type'    => 'post',
				'show_in_rest'		 => true,
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'revisions','excerpt','thumbnail' )
			);
			
			register_post_type( 'publications', $args );
		
		} // End if 
		
		
	} // End register_post_type
	
	
	public function add_edit_form( $post ){
		
		if ( 'publications' == $post->post_type ){
			
			$authors = get_post_meta( $post->ID, '_authors', true );
			
			if ( empty( $authors ) ) { 
			
				$authors = array( array( 'name' => '', 'email' => '' ) );
				
			} // end if
			
			include locate_template( 'lib/post-types/publications/includes/edit-form.php', false );
			
		} // End if
		
	} // End add_edit_form
	
	
	public function check_enabled(){
		
		return ( get_theme_mod( '_cahnrswp_enable_publications', false ) ) ? true : false;
		
	} // End check_enabled
	
	
	public function save( $post_id ){
		
		if ( isset( $_POST['_redirect_url'] ) ){
			
			$clean = sanitize_text_field( $_POST['_redirect_url'] );
			
			update_post_meta( $post_id, '_redirect_url', $clean );
			
		} // End if
		
		if ( isset( $_POST['_authors'] ) ){
			
			$clean_authors = array();
			
			foreach( $_POST['_authors'] as $index => $author ){
				
				$name = ( ! empty( $author['name'] ) ) ? sanitize_text_field( $author['name'] ) : '';
				
				$email = ( ! empty( $author['email'] ) ) ? sanitize_text_field( $author['email'] ) : '';
				
				$dept = ( ! empty( $author['dept'] ) ) ? sanitize_text_field( $author['dept'] ) : '';
				
				$clean_authors[] = array( 'name' => $name, 'email' => $email, 'dept' => $dept );
				
			} // End foreach
			
			update_post_meta( $post_id, '_authors', $clean_authors );
			
		} // End if
		
	} // End save
	
	
	public function check_redirect( $template ){
		
		if ( is_singular( 'publications' ) ){
			
			global $post;
			
			$redirect = get_post_meta( $post->ID, '_redirect_url', true );
			
			if ( ! empty( $redirect ) ){
				
				wp_redirect( $redirect );
				
			} // End if
			
		} // End if
		
		
		return $template;
		
	} // End check_redirect
	
	
} // End Theme_Part_Post_Type_CAHNRS_Ignite

$publications_post_type_cahnrs_ignite = new Publications_Post_Type_CAHNRS_Ignite();