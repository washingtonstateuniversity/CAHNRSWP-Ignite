<?php

class Post_Editor_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'edit_form_after_title', array( $this, 'edit_form_after_title' ), 1 );
		
		add_action( 'save_post', array( $this, 'save_post') );
		
		add_filter( 'cahnrswp_pagebuilder_header_tags', array( $this, 'add_h1_tags') );
		
	} // end __construct
	
	
	public function add_h1_tags( $tags ){
		
		$post_id = get_the_ID();
			
		if ( $post_id ){
			
			$meta = get_post_meta( $post_id, '_show_title_single_ignite', true );
			
			if ( 'remove' === $meta ){
				
				$tags = array_merge( array( 'h1' => 'H1' ), $tags );
				
			} // End if
			
		} // End if
		
		return $tags;
		
	} // End add_h1_tags
	
	
	public function edit_form_after_title( $post ){
		
		$post_id = $post->ID;
		
		echo '<div class="ignite-edit-form">';
		
		wp_nonce_field( 'save_ignite_post_' . $post_id, 'save_ignite_post' );
		
		include locate_template( 'includes/forms/edit-post/basic.php', false );
		
		echo '</div>';
		
	} // end edit_form_after_title
	
	
	public function save_post( $post_id ){
		
		if ( ! is_admin() ) return;
		
		if( ( wp_is_post_revision( $post_id) || wp_is_post_autosave( $post_id ) ) ) return;
		
		if ( ! isset( $_POST['save_ignite_post'] ) ) return;
		
		$nonce = $_POST['save_ignite_post'];
		
		if ( ! wp_verify_nonce( $nonce, 'save_ignite_post_' . $post_id ) ) return;
		
		$fields = array(
			'_show_title_single_ignite' => 'text',
		);
		
		foreach( $fields as $key => $type ){
			
			if ( isset( $_POST[ $key ] ) ){
			
				$clean_value = $this->sanitize_input( $_POST[ $key ], $type );
				
				update_post_meta( $post_id, $key, $clean_value );
			
			} // end if
			
		} // end foreach
		
	} // end save_post
	
	
	protected function sanitize_input( $value, $type ){
		
		switch( $type ){
			
			case 'text':
			default:
				$clean_value = sanitize_text_field( $value );
			
		} // end switch
		
		return $clean_value;
		
	} // end sanitize_input
	
	
} // end Post_Editor_CAHNRS_Ignite

$post_editor_cahnrs_ignite = new Post_Editor_CAHNRS_Ignite();