<?php

class Basic_Slideshow_Banner_Ignite {
	
	protected $args = array();
	
	protected $context = '';
	
	protected $post_id = false;
	
	
	public function __construct( $args, $context, $post_id ){
		
		$this->args = $args;
		
		$this->context = $context;
		
		$this->post_id = $post_id;
		
	} // End __construct
	
	
	public function get_banner(){
		
		$html = 'Basic Slideshow';
		
		$slides = ignite_get_slides();
		
		var_dump( $slides );
		
		return $html;
		
	} // End get_banner

	
} // End Basic_Slideshow_Banner_Ignite