<?php

class Page_Banner_Ignite {
	
	
	public function the_banner( $type = 'contained', $size = 'large', $post_id = false, $image_url = false ){
		
		// If no post ID but is single get the id from WP
		if ( ! $post_id && is_singular() ){
			
			$post_id = get_the_ID();
			
		} // end if
		
		// If $image_url not supplied and post id exists get the image url
		if ( ! $image_url && $post_id ) {
			
			$image_url = $this->get_post_image( $post_id, $size );
		
		} // end if
		
		$html = apply_filters( 'cahnrs_ignite_banner_html', '', $type, $size, $post_id, $image_url );
		
		if ( empty( $html ) ){
			
			ob_start();
		
			switch( $type ){
				
				case 'contained':
					break;
				case 'parallax-banner':
					include CAHNRSIGNITEPATH . 'includes/banners/static-image-wide.php';
					break;
				
			} // end switch
			
			$html = ob_get_clean();
		
		} // end if
		
		$html = apply_filters( 'cahnrs_ignite_banner_html_after', $html, $type, $size, $post_id, $image_url );
		
		echo $html;
		
	} // end the_banner
	
	
	public function get_post_image( $post_id, $size ){
		
		$image_url = false;
		
		if ( has_post_thumbnail( $post_id ) ){
		
			$img_id = get_post_thumbnail_id( $post_id );
				
			$img_url_array = wp_get_attachment_image_src( $img_id, $size, true );
				
			$image_url = $img_url_array[0];
		
		} // end if
		
		return $image_url;
		
	} // end get_post_image
	
	
} // end Page_Banner_Ignite