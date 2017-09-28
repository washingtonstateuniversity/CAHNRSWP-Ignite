<?php

class Post_Type_Ignite {
	
	
	public function check_enabled( $post_type ){
		
		return ( get_theme_mod( "_cahnrswp_enable_{$post_type}", false ) ) ? true : false;
		
	} // End check_enabled
	
	
	public function check_redirect( $template ){
		
		if ( is_singular() ){
			
			$post_id = get_the_ID();
			
			$post_type = get_post_type();
			
			$redirect_url = get_post_meta( $post_id , '_article_redirect_url', true );
			
			$pt_redirect_url = get_post_meta( $post_id , "_{$post->post_type}_redirect_url", true );
			
			if ( ! empty( $redirect_url ) ){
				
				wp_redirect( $redirect_url );
				
				exit;
				
			} // End if
			
		} // End if
		
		return $template;
		
	} // End check_redirect
	
	
	public function check_can_save( $post_id ){
		
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

			return false;

		} // end if
		
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

			return false;

		} // end if

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {

				return false;

			} // end if

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {

				return false;

			} // end if

		} // end if
		
		//if ( ! isset( $_POST['cahnrs_pagebuilder_key'] ) || ! wp_verify_nonce( $_POST['cahnrs_pagebuilder_key'], 'save_cahnrs_pagebuilder_' . $post_id ) ) {
		  
			// return false;
		  
		//}
		
		return true;
		
	}
	
	protected function get_clean_fields( $fields ){
		
		$clean = array();
		
		foreach( $fields as $key => $type ){
			
			if ( isset( $_POST[ $key ] ) ){
				
				$value = $_POST[ $key ];
				
				switch( $type ){
					case 'text':
						$clean[ $key ] = sanitize_text_field( $value );
						break;
						
				} // End swtich
				
			} // End if
			
		} // End foreach
		
		return $clean;
		
	} // End clean_fields
	

} // End Post_Type_Ignite