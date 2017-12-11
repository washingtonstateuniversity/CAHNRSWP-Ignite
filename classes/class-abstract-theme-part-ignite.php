<?php

class Abstract_Theme_Part {
	
	
	public function get_part( $context, $args ){
		
		$html = '';
		
		$html .= $this->get_the_part( $context, $args );
		
		return apply_filters( 'cahnrs_ignite_part_html', $html, $context, $args );
		
	} // End get_part
	
	
	protected function get_settings( $ctmzr_fields, $args = array() ){
		
		$settings = array();
		
		foreach( $ctmzr_fields as $key => $default ){
			
			if ( array_key_exists( $key, $args ) ){
				
				$settings[ $key ] = $args['key'];
				
			} else {
				
				$value = get_theme_mod( $key, $default );
			
				$settings[ $key ] = $value;
				
			} // End if
			
		} // End foreach
		
		return $settings;
		
	} // End get_settings
	
} // End Abstract_Theme_Part