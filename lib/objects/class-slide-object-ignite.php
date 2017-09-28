<?php

class Slide_Object_Ignite {
	
	protected $title = '';
	
	protected $images = array();
	
	protected $post_id = false;
	
	protected $excerpt = '';
	
	protected $link = '';
	
	
	public function set_from_loop(){
		
		$this->title = get_the_title();
		
		$this->post_id = get_the_ID();
		
		$this->excerpt = get_the_excerpt();
		
		$this->link = get_post_permalink();
		
		$this->images = ignite_get_post_image_array( get_the_ID() );
		
	} // End set_from_loop
	
} // End Slide_Object_Ignite