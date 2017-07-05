<?php

class Slide_Factory_CAHNRS_Ignite {
	
	public function get_slides( $args = array() ){
		
		$options = array(
			'count' 		=> 3,
			'post_type' 	=> 'any',
			'taxonomy' 		=> 'category',
			'term_id' 		=> false,
			'order' 		=> 'newest',
		);
		
		foreach( $options as $key => $value ){
			
			if ( ! empty( $args[ $key ] ) ){
				
				$options[ $key ] = $args[ $key ];
				
			} // End if
			
		} // end foreach
		
	} // end get_slides
	
	
}