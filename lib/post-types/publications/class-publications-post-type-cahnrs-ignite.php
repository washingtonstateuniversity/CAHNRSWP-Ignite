<?php 

class Publications_Post_Type_CAHNRS_Ignite extends Post_Type_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_post_type' ) );
		
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		
		//add_filter( 'cwpb_register_items', array( $this, 'add_pagebuilder_item' ) );
		
		add_action( 'edit_form_after_title' , array( $this, 'add_edit_form' ) );
		
		add_action( 'save_post_publication' , array( $this, 'save' ) );
		
		add_action( 'template_include' , array( $this, 'check_redirect' ), 1 );
		
		add_filter( 'the_title', array( $this, 'add_title_data'), 1 );
		
	} // End __construct
	
	
	public function add_title_data( $title ){
		
		global $post;
		
		if ( is_singular( 'publication' ) && ( $post->post_title == $title ) ){
			
			$post_id = get_the_ID();
			
			$publication = $this->get_publication( $post_id );
			
			$title .= ' <span class="ignite-pub-title"><span class="ignite-pub-title-published">';
			
			if ( ! empty( $publication['journal'] ) ){
				
				$title .= 'Published In </span>' . $publication['journal'];
				
			} // End if
			
			if ( ! empty( $publication['volume'] ) ){
				
				$title .= ', ' .$publication['volume'];
				
			} // End if
			
			if ( ! empty( $publication['year'] ) ){
				
				$title .= ', ' .$publication['year'];
				
			} // End if
			
			if ( ! empty( $publication['authors'] ) ){
				
				$title .= ', by ' .$publication['authors'];
				
			} // End if
			
			$title .= '</span>';
			
			remove_filter( 'the_title', array( $this, 'add_title_data'), 1 );
			
		} // End if
		
		return $title;
		
	} // End add_title_data
	
	
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
		
		if ( $this->check_enabled('publication') ){
		
			register_taxonomy(
				'journals',
				'publication',
				array(
					'label' => __( 'Journals' ),
					'rewrite' => array( 'slug' => 'journal' ),
					'hierarchical' => true,
				)
			);
			
			register_taxonomy(
				'departments',
				'publication',
				array(
					'label' => __( 'Departments & Units' ),
					'rewrite' => array( 'slug' => 'units' ),
					'hierarchical' => true,
				)
			);
			
			register_taxonomy(
				'publication_author',
				'publication',
				array(
					'label' => __( 'Publication Authors' ),
					'rewrite' => array( 'slug' => 'pub-authors' ),
					'hierarchical' => true,
				)
			);
		
		} // End if
		
	} // End register_taxonomy
	
	
	public function register_post_type(){
		
		if ( $this->check_enabled( 'publication' ) ){
		
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
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'revisions','thumbnail' )
			);
			
			register_post_type( 'publication', $args );
		
		} // End if 
		
		
	} // End register_post_type
	
	
	public function add_edit_form( $post ){
		
		if ( ( 'publication' == $post->post_type ) && $this->check_enabled('publication')  ){
			
			$post_id = get_the_ID();
			
			$publication = $this->get_publication( $post_id );
			
			include locate_template( 'lib/post-types/publications/includes/editor.php', false );
			
		} // End if
		
	} // End add_edit_form
	
	
	public function save( $post_id ){
		
		$save_fields = array(
			'_pub_link' 		=> 'text',
			'_pub_journal' 		=> 'text',
			'_pub_volume' 		=> 'text',
			'_pub_year' 		=> 'text',
			'_pub_authors' 		=> 'text',
		);
		
		if ( $this->check_can_save( $post_id ) ){
			
			$clean_fields = $this->get_clean_fields( $save_fields );
			
			foreach( $clean_fields as $key => $value ){
				
				update_post_meta( $post_id, $key, $value );
				
			} // End if
			
		} // End if
		
	} // End save
	
	
	public function get_legacy_support( $post_id, $publication ){
		
		$meta = get_post_meta( $post_id , '_publication' , true );
		
		if ( empty( $publication['link'] ) && ! empty( $meta['source'] ) ) {
			
			$publication['link'] = $meta['source'];
			
		} // End if
		
		if ( empty( $publication['journal'] ) && ! empty( $meta['journal'] ) ) {
			
			$publication['journal'] = $meta['journal'];
			
		} // End if
		
		if ( empty( $publication['volume'] ) && ! empty( $meta['volume'] ) ) {
			
			$publication['volume'] = $meta['volume'];
			
		} // End if
		
		if ( empty( $publication['authors'] ) && ! empty( $meta['author'] ) ) {
			
			$publication['authors'] = $meta['author'];
			
		} // End if
		
		if ( empty( $publication['year'] ) && ! empty( $meta['year'] ) ) {
			
			$publication['year'] = $meta['year'];
			
		} // End if
		
		return $publication;
		
	} // End get_legacy_support
	
	
	public function check_redirect( $template ){
		
		if ( is_singular( 'publication' ) ){
			
			global $post;
			
			$redirect = get_post_meta( $post->ID, '_redirect_url', true );
			
			if ( ! empty( $redirect ) ){
				
				wp_redirect( $redirect );
				
			} // End if
			
		} // End if
		
		
		return $template;
		
	} // End check_redirect
	
	
	protected function get_publication( $post_id ){
		
		$publication = array(
			'link' => get_post_meta( $post_id, '_pub_link' , true ),
			'journal' => get_post_meta( $post_id, '_pub_journal' , true ),
			'volume' => get_post_meta( $post_id, '_pub_volume' , true ),
			'year' => get_post_meta( $post_id, '_pub_year' , true ),
			'authors' => get_post_meta( $post_id, '_pub_authors' , true ),
		);
		
		$publication = $this->get_legacy_support( $post_id, $publication );
		
		return $publication;
		
	} // End get_publication
	
	
} // End Theme_Part_Post_Type_CAHNRS_Ignite

$publications_post_type_cahnrs_ignite = new Publications_Post_Type_CAHNRS_Ignite();