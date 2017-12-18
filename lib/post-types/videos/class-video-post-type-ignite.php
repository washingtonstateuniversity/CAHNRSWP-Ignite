<?php

class Video_Post_Type_Ignite extends Post_Type_Ignite {
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_post_type' ) );
		
		//add_filter( 'cwpb_register_items', array( $this, 'add_pagebuilder_item' ) );
		
		add_action( 'edit_form_after_title' , array( $this, 'add_edit_form' ) );
		
		add_action( 'save_post_video' , array( $this, 'save' ) );
		
		add_filter( 'the_content' , array( $this, 'add_video_player' ), 1 );
		
		add_filter('ignite-post-image', array( $this, 'filter_post_image' ), 1, 3 );
		
	} // End __construct
	
	
	public function register_post_type(){
		
		if ( $this->check_enabled( 'video' ) ){
		
			$labels = array(
				'name'               => 'Videos',
				'singular_name'      => 'Videos', 
				'menu_name'          => 'Videos',
				'name_admin_bar'     => 'Videos',
				'add_new'            => 'Add Video',
				'add_new_item'       => 'Add Video', 
				'new_item'           => 'New Video', 
				'edit_item'          => 'Edit Video', 
				'view_item'          => 'View Video', 
				'all_items'          => 'All Videos', 
				'search_items'       => 'Search Videos', 
				'parent_item_colon'  => 'Parent Videos:', 
				'not_found'          => 'No Videos found.',
				'not_found_in_trash' => 'No Videos found in Trash.',
			);
		
			$args = array(
				'labels'			 => $labels,
				'description'        => 'Videos for Theme use.', 
				'public'             => true,
				//'exclude_from_search' => true,
				//'publicly_queryable' => true,
				//'show_ui'            => true,
				'show_in_menu'       => true,
				'rewrite'            => array( 'slug' => 'videos' ),
				'capability_type'    => 'post',
				'show_in_rest'		 => true,
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title','editor','thumbnail' )
			);
			
			register_post_type( 'video', $args );
		
		} // End if
		
		
	} // End register_post_type
	
	
	public function add_edit_form( $post ){
		
		if ( 'video' === $post->post_type ){
			
			$video = $this->get_video( $post->ID );
			
			include 'includes/editor.php';
			
		} // End if
		
	} // End add_edit_form
	
	
	public function save( $post_id){
		
		$save_fields = array(
			'_video_id' 		=> 'text',
			'_video_img_src' 	=> 'text',
		);
		
		if ( $this->check_can_save( $post_id ) ){
			
			$clean_fields = $this->get_clean_fields( $save_fields );
			
			if ( empty( $clean_fields['_video_img_src'] ) ){
				
				$video_id = $this->get_video_id_from_url( $clean_fields['_video_id'] );
				
				$clean_fields['_video_img_src'] = 'https://img.youtube.com/vi/' . $video_id . '/0.jpg'; 
				
			} // End if
			
			foreach( $clean_fields as $key => $value ){
				
				update_post_meta( $post_id, $key, $value );
				
			} // End if
			
		} // End if
		
	} // End save
	
	
	public function add_video_player( $content ){
		
		if ( is_singular( 'video' ) ){
			
			global $post;
			
			$post_id = get_the_ID();
			
			$video = $this->get_video( $post_id );
			
			//$video_id = get_post_meta( $post_id, '_video_id', true );
			
			//var_dump( get_post_meta( $post_id ) );
			
			$video_id = $this->get_video_id_from_url( $video['id'] );
			
			$video_url = 'https://www.youtube.com/embed/' . $video_id;
			
			if ( strpos( $video_url, 'rel' ) === false) $video_url . '?rel=0';

			ob_start();

			include 'includes/video.php';

			$content = ob_get_clean() . $content;
			
			remove_filter( 'the_content' , array( $this, 'add_video_player' ), 1 );
			
		} // End if
		
		return $content;
		
	} // End add_video_player
	
	
	public function filter_post_image( $image, $post_id, $post_type ){
		
		$video = $this->get_video( $post_id );
		
		if ( ! empty( $video['img_src'] ) ) {
			
			$image['src'] = $video['img_src'];
			
		} // End if
		
		return $image;
		
	} // End filter_post_image
	
	
	protected function get_video( $post_id ){
		
		$video = array(
			'id' => get_post_meta( $post_id, '_video_id', true ),
			'img_src' => get_post_meta( $post_id, '_video_img_src', true ),
		);
		
		$video = $this->get_legacy_support( $video, $post_id );
		
		return $video;
		
	} // End get_video
	
	
	protected function get_legacy_support( $video, $post_id ){
		
		if ( empty( $video['id'] ) ){
			
			$video_legacy = get_post_meta( $post_id, '_video', true );
			
			if ( ! empty( $video_legacy['video_url'] ) ) { 
				
				$video['id'] = $video_legacy['video_url'] ;
				
			} // End if
			
		} // End if
		
		if ( empty( $video['img_src'] ) ){
			
			$video['img_src'] = get_post_meta( $post_id, '_default_img_src', true );
			
		} // End if
		
		return $video;
		
	} // End get_legacy_support
	
	
	/*
	 * @desc - Extracts video id from url
	 * @return string - The video id.
	*/
	protected function get_video_id_from_url( $url ){
		
		$video_id = $url;
		
		if ( strpos( $url,'watch?v=' ) ){
			
			$url = explode( 'watch?v=', $url );
			
			$video_id = $url[1];
			
		} else if ( strpos( $url,'.be/' ) ){ //https://youtu.be/nkXGohB02V0
			
			$url = explode( '.be/', $url );
			
			$video_id = $url[1];
			
		} // End if
		
		$url = explode( 'watch?v=' , $url );
			
		return $video_id;
		
	} // end cwp_get_video_id_from_url
	
	
} // End Slide_Post_Type_Ignite

$videos_post_type_ignite = new Video_Post_Type_Ignite();