<?php

class Slide_Factory_Ignite {
	
	protected $query_args = array(
			'post_type' => 'slides',
			'post_status' => 'publish',
			'per_page' => 4,
	);
	
	
	public function get_slides( $args ){
		
		$default_args = array(
			'query_type' 	=> 'recent',
		);
		
		$args = array_merge( $default_args, $args );
		
		$slides = array();
		
		switch( $args['query_type'] ){
				
			case 'recent':
			default:
				$query_args = $this->get_basic_query_args( $args );
				$slides = $this->get_slides_from_query( $query_args );
				break;
		} // End switch
		
		
		return $slides;
		
	} // End get_slides
	
	
	public function get_slide(){
		
		ignite_load_class( 'lib/objects/class-slide-object-ignite.php', true );
		
		$slide = new Slide_Object_Ignite();
		
		return $slide;
		
	} // End get_slide
	
	
	protected function get_slides_from_query( $query_args ){
		
		$slides = array();
		
		$the_query = new WP_Query( $query_args );
		
		if ( $the_query->have_posts() ) {
			
			while ( $the_query->have_posts() ) {
				
				$the_query->the_post();
				
				$slide = $this->get_slide();
				
				$slide->set_from_loop();
				
				$slides[] = $slide;
				
			} // End while

			wp_reset_postdata();
			
		} // End if
		
		return $slides;
		
	} // End get_slides_from_query
	
	
	protected function get_basic_query_args( $args ){
		
		return $this->query_args;
		
	} // End get_basic_query_args
	
} // End Slide_Factory_Ignite