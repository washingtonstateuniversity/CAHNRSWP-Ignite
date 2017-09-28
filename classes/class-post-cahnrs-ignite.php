<?php 

class Post_CAHNRS_Ignite {
	
	public $id = '';
	public $post = '';
	public $post_id = '';
	public $post_title = '';
	public $post_content = '';
	public $post_excerpt = '';
	public $post_type = '';
	public $post_date = '';
	public $post_status = '';
	public $post_images = array();
	public $post_link = '';
	public $is_remote = false;
	
	
	public function set_local( $post ){
		
		$this->id = get_the_ID();
		
		$this->post = $post;
		
		$this->post_id = get_the_ID();
		
		$this->post_title = apply_filters( 'the_title', get_the_title() );
		
		$this->post_content = apply_filters( 'the_content', get_the_content() );
		
		$this->post_excerpt = get_the_excerpt();
		
		$this->post_type = get_post_type();
		
		$this->post_date = get_the_date();
		
		$this->post_status = get_post_status();
		
		$this->post_images = $this->get_local_images( get_the_ID() );
		
		$this->post_link = get_post_permalink();
		
	} // End set_local
	
	
	public function set_remote( $remote_post ){
		
		//var_dump( $remote_post );
		
		$this->post = $remote_post;
		
		$this->post_id = ( ! empty( $remote_post['id'] ) ) ? $remote_post['id'] : '';
		
		$this->post_images = ( ! empty( $remote_post['post_images'] ) ) ? $remote_post['post_images'] : '';
			
		$this->post_link = ( ! empty( $remote_post['link'] ) ) ? $remote_post['link'] : '';
		
		$this->post_title = ( ! empty( $remote_post['title']['rendered'] ) ) ? $remote_post['title']['rendered'] : '';
		
		$this->post_content = ( ! empty( $remote_post['content']['rendered'] ) ) ? $remote_post['content']['rendered'] : '';
		
		$this->post_excerpt = ( ! empty( $remote_post['excerpt']['rendered'] ) ) ? $remote_post['excerpt']['rendered'] : '';
		
		$this->post_date = ( ! empty( $remote_post['date'] ) ) ? $remote_post['date'] : '';
		
		$this->id = ( ! empty( $remote_post['id'] ) ) ? $remote_post['id'] : '';
		
		$this->post_type = ( ! empty( $remote_post['type'] ) ) ? $remote_post['type'] : '';
		
		$this->is_remote = true;
		
		//$this->post_type = '';
		
		//$this->post_status = '';
		
	} // End set_remote
	
	
	public function set_displayed(){
		
		global $cahnrs_displayed_posts;
		
		if ( ! isset( $cahnrs_displayed_posts ) ) $cahnrs_displayed_posts = array();
		
		if ( ! isset( $cahnrs_displayed_posts[ $this->post_type ] ) ) $cahnrs_displayed_posts[ $this->post_type ] = array();
		
		if ( ! isset( $cahnrs_displayed_posts[ $this->post_type ]['local'] ) ) $cahnrs_displayed_posts[ $this->post_type ]['local'] = array();
		
		if ( ! isset( $cahnrs_displayed_posts[ $this->post_type ]['remote'] ) ) $cahnrs_displayed_posts[ $this->post_type ]['remote'] = array();
		
		if ( $this->is_remote ){
			
			$cahnrs_displayed_posts[ $this->post_type ]['remote'][] = $this->id;
			
		} else {
			
			$cahnrs_displayed_posts[ $this->post_type ]['local'][] = $this->id;
			
		} // End if
		
	} // End set_displayed
	
	
	public function get_link_html( $end = false ){
		
		if ( $end ){
			
			return '</a>';
			
		} else {
		
			return '<a href="' . $this->post_link . '">';
		
		} // End if
		
	} // End get_link_html
	
	
	protected function get_local_images( $post_id ){
		
		$post_images = array();
		
		$sizes = array( 'thumbnail','medium','large','full');
		
		if ( has_post_thumbnail( $post_id ) ){
					
			$img_id = get_post_thumbnail_id( $post_id );
			
			foreach( $sizes as $size ){
				
				$img = wp_get_attachment_image_src( $img_id, $size, true );
				
				$post_images[ $size ] = $img[0];
				
			} // End foreach
			
		} // End if
		
		return $post_images;
		
	} // End get_local_images

	
	
} // End Post_CAHNRS_Ignite