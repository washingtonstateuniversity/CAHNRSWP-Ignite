<?php

class Theme_Part_Ignite {
	
	protected $default_args = array();
	
	protected $settings = array();
	
	
	protected function parse_args( $defaults, $args, $context ){
		
		if ( ! is_array( $defaults ) ) $defaults = array();
		
		if ( ! is_array( $args ) ) $args = array();
		
		foreach( $defaults as $key => $value ){
			
			if ( isset( $args[ $key ] ) ){
				
				$defaults[ $key ] = $args[ $key ];
				
			} // End if
			
		} // End foreach
		
		return $defaults;
		
	} // End parse_args
	
	
	protected function get_customizer_args( $args ){
		
		$new_args = array();
		
		foreach( $this->default_args as $key => $value ){
			
			if ( array_key_exists( $key, $args ) ){
				
				$new_args[ $key ] = $args[ $key ];
				
			} else if ( array_key_exists( $key, $this->settings ) ){
				
				$new_args[ $key ] = get_theme_mod( $this->settings[ $key ], $value );
				
			} else {
				
				$new_args[ $key ] = $value;
				
			}// End if	
			
		} // End foreach
		
		return $new_args;
		
	} // End settings
	
} // End Theme_Part_Ignite