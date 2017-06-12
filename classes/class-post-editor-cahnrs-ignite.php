<?php

class Post_Editor_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'edit_form_after_title', array( $this, 'edit_form_after_title' ), 1 );
		
	} // end __construct
	
	
	public function edit_form_after_title( $post ){
		
		$post_id = $post->ID;
		
		include locate_template( 'includes/forms/edit-post/basic.php', false );
		
	} // end edit_form_after_title
	
	
	public function save_post( $post_id ){
		
		if ( ! is_admin() ) return;
		
		if( ( wp_is_post_revision( $post_id) || wp_is_post_autosave( $post_id ) ) ) return;
		
	} // end save_post
	
	
} // end Post_Editor_CAHNRS_Ignite

$post_editor_cahnrs_ignite = new Post_Editor_CAHNRS_Ignite();