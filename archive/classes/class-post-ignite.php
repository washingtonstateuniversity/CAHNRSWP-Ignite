<?php

class Post_Ignite {
	
	protected $featured_image_id = '';
	protected $link = '';
	protected $post_id = '';
	protected $post_type = '';
	protected $settings = array(
		'_show_title_single_ignite' => '',
	);
	protected $wp_post = false;
	
	public function get_featured_image_id(){ return $this->featured_image_id; }
	public function get_link(){ return $this->link; }
	public function get_settings(){ return $this->settings; }
	public function get_setting( $key ){ return $this->get_the_setting( $key ); } 
	public function get_post_type(){ return $this->post_type; }
	public function get_post_id(){ return $this->post_id; }
	public function get_wp_post(){ return $this->wp_post; }
	
	
	public function set_featured_image_id( $value ){ $this->featured_image_id = $value; }
	public function set_link( $value ){ $this->link = $value; }
	public function set_post_id( $value ){ $this->post_id = $value; }
	public function set_post_type( $value ){ $this->post_type = $value; }
	public function set_wp_post( $value ){ $this->wp_post = $value; }
	
	
	public function __construct( $wp_post = false ){
		
		if ( $wp_post ){
			
			$this->the_post( $wp_post );
		
		} // end if
		
	} // end construct
	
	
	public function the_post( $wp_post ){
		
		$this->set_wp_post( $wp_post );
		
		$this->set_post_id( $wp_post->ID );
		
		if ( has_post_thumbnail( $wp_post ) ){
			
			$image_id = get_post_thumbnail_id( $this->get_post_id() );
			
			$this->set_featured_image_id( $image_id );
			
		} // end if 
		
		$this->set_link( get_post_permalink( $this->get_post_id() ) );
		
		$this->set_post_type( $wp_post->post_type );
		
		$this->settings = $this->get_the_settings();
	
	} // end the_post
	
	
	public function get_the_content( $settings = array() ){
		
		ob_start();
		
		include CAHNRSIGNITEPATH . 'parts/content/content.php';
		
		return ob_get_clean();
		
	}
	
	
	public function get_the_title( $settings = array() ){
		
		if ( empty( $settings ) ) $settings = $this->get_settings();
		
		$html = '';
		
		if ( empty( $settings['_show_title_single_ignite'] ) || $settings['_show_title_single_ignite'] == 'show'  ) {
		
			ob_start();
		
			include CAHNRSIGNITEPATH . 'parts/content/title.php';
		
			$html .= ob_get_clean();
		
		} // end if
		
		return $html;
		
	} // end get_the_title
	
	
	public function get_the_setting( $key ){
		
		$settings = $this->get_settings();
		
		if ( empty( $settings[ $key ] ) ) {
			
			return '';
			
		} else {
			
			return $settings[ $key ];
			
		} // end if
		
	} // end get_the_setting
	
	
	public function get_the_settings(){
		
		$settings = $this->get_settings();
		
		foreach( $settings as $key => $value ){
			
			$meta = get_post_meta( $this->get_post_id(), $key, true );
			
			if ( $meta !== '' ){
				
				$settings[ $key ] = $meta; 
				
			} // end if
			
		} // end foreach
		
		return $settings;
		
	} // end get_the_settings

	
} // end Post_Ignite