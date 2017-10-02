<?php

class Slide_Object_Ignite {
	
	protected $title = '';
	
	protected $images = array();
	
	protected $post_id = false;
	
	protected $excerpt = '';
	
	protected $link = '';
	
	protected $redirect = '';
	
	protected $index = '';
	
	protected $show_caption = frue;
	
	
	public function set_from_loop( $index = ''){
		
		$this->title = get_the_title();
		
		$this->post_id = get_the_ID();
		
		$this->excerpt = get_the_excerpt();
		
		$this->link = get_post_permalink();
		
		$this->images = ignite_get_post_image_array( get_the_ID() );
		
		$this->redirect = get_post_meta( $this->post_id, '_redirect_url', true );
		
		$this->index = $index;
		
	} // End set_from_loop
	
	
	public function set_show_caption( $value ){
		
		$this->show_caption = $value;
		
	} // end set_show_caption
	
	
	public function get_excerpt(){
		
		return $this->excerpt;
		
	} // End get_excerpt
	
	
	public function get_image_src( $size ){
		
		$image_src = '';
		
		if ( ! empty( $this->images ) && ! empty( $this->images[$size] ) ){
			
			$image_src = $this->images[ $size ]['src'];
			
		} // End if
		
		return $image_src;
		
	} // End get_image
	
	
	public function get_image_alt_text(){
		
		$alt = '';
		
		
		if ( ! empty( $this->images ) && ! empty( $this->images['thumbnail'] ) ){
			
			$alt = $this->images['thumbnail']['alt'];
			
		} // End if
		
		return $alt;
		
	} // End get_alt_text()
	
	
	public function get_index(){
		
		return $this->index;
		
	} // End get_index
	
	
	public function get_link( $include_post_link = false ){
		
		$link = '';
		
		if ( ! empty( $this->redirect ) ){
			
			$link = $this->redirect;
			
		} else if( $include_post_link ){
			
			$link = $this->link;
			
		} // End if
		
		return $link;
		
	} // End get_link
	
	public function get_title(){
		
		return $this->title;
		
	} // End get_title
	
	
	public function show_caption(){
		
		return $this->show_caption;
		
	} // End show_caption
	
} // End Slide_Object_Ignite