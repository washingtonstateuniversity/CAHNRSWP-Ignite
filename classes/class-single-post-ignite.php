<?php
/**
 * This class is for setting up properties and methods used on single
 * post views
**/
class Single_Post_Ignite {
	
	protected $post_id = false;
	
	protected $settings = array(
		'_show_title_single_ignite' 	=> '',
		'_title_tag_single_ignite' 		=> '',
		'_show_content_single_ignite' 	=> '',
		'_show_footer_ignite' 			=> '',
		'post_images'  					=> array(),
	);

	
	public function __construct( $post = false ){
		
		$this->set_by_wp_post( $post );
		
	} // end __construct
	
	
	public function get_post_image( $size = 'large', $post_id = false ){
		
		$this->set_settings( $post_id );
		
		if ( ! empty( $this->settings['post_images'][ $size ] ) ){
			
			return $this->settings['post_images'][ $size ];
			
		} // end if
		
		return '';
		
	} // end get_post_image
	
	
	public function get_setting( $field, $post_id = false ){
		
		$this->set_settings( $post_id );
		
		if ( isset( $this->settings[ $field ] ) ){
			
			return $this->settings[ $field ];
			
		} // end if
		
		return '';
		
	} // end get_setting
	
	
	public function get_settings( $post_id = false ){
		
		$this->set_settings( $post_id );
		
		return $this->settings;
		
	} // end get_settings
	
	
	public function set_by_wp_post( $post ){
		
		if ( $post ){
			
			$post_id = ( is_numeric( $post ) ) ? $post : $post->ID;
			
			$this->set_settings( $post_id );
			
			return true;
			
		} // end if
		
		return false;
		
	} // end set_by_wp_post
	
	
	public function set_settings( $post_id ){
		
		if ( ! $post_id || ( $this->post_id && $this->post_id == $post_id ) ){
			
			return false;
			
		} // end if
		
		$this->post_id = $post_id;
		
		$settings = $this->get_settings_customizer( array(), $post_id );
		
		$settings = $this->get_settings_meta( $settings, $post_id );
		
		$settings = $this->get_settings_post( $settings, $post_id );
		
		$this->settings = $settings;
		
	} // end get_settings
	
	
	protected function get_settings_meta( $settings, $post_id ){
		
		foreach( $this->settings as $meta_key => $mvalue ){
			
			$value = get_post_meta( $post_id, $meta_key, true );
			
			if ( $value !== '' ) {
			
				$settings[ $meta_key ] = $value;
			
			} // end if
			
		} // end foreach
		
		return $settings;
		
	} // end get_settings_meta
	
	
	protected function get_settings_customizer( $settings, $post_id ){
		
		foreach( $this->settings as $option_key => $ovalue ){
			
			$value = get_theme_mod( $option_key, '' );
			
			$settings[ $option_key ] = $value;
			
		} // end foreach
		
		return $settings;
		
	} // end get_settings_meta
	
	
	protected function get_settings_post( $settings, $post_id ){
		
		$settings['post_images'] = $this->get_post_images( $post_id );
		
		return $settings;
		
	} // end $post_id
	
	
	public function get_post_images( $post_id ){
		
		$image = array();
		
		if ( has_post_thumbnail( $post_id ) ){
		
			$img_id = get_post_thumbnail_id();
			
			$sizes = array( 'full','large','medium','thumbnail' );
			
			foreach( $sizes as $size ){
				
				$img_url_array = wp_get_attachment_image_src( $img_id, $size, true);
				
				$image[ $size ] = $img_url_array[0];
				
			} // end foreach
		
		} // end if
		
		return $image;
		
	} // end get_post_image
	
} // end Single_Post_Ignite