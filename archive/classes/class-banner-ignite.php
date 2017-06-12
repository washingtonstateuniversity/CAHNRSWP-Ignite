<?php

class Banner_Ignite {
	
	public function get_the_banner( $type = 'parallax-banner' ){
		
		$html ='';
		
		if ( is_singular() ){
			
			$post_id = get_the_ID();
			
			if ( has_post_thumbnail( $post_id ) ){
			
				ob_start();
				
				switch( $type ){
					
					case 'contained':
						break;
					case 'parallax-banner':
						$image_url = $this->get_post_image( $post_id, 'full' );
						include CAHNRSIGNITEPATH . 'includes/banners/static-image-wide.php';
						break;
					
				} // end switch
				
				$html .= ob_get_clean();
			
			} // end if
			
		} // end if
		
		return $html;
		
	} // end get_the_banner
	
	
	public function get_post_image( $post_id, $size ){
		
		$image_url = false;
		
		if ( has_post_thumbnail( $post_id ) ){
		
			$img_id = get_post_thumbnail_id( $post_id );
				
			$img_url_array = wp_get_attachment_image_src( $img_id, $size, true );
				
			$image_url = $img_url_array[0];
		
		} // end if
		
		return $image_url;
		
	} // end get_post_image
	
}