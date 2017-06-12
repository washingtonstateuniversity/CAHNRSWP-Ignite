<?php

class Theme_Options_Ignite {
	
	protected $theme_options_defaults = array(
		'_cahnrswp_header_type' => 'cahnrs-college'
	);
	
	protected $theme_options = array();
	
	
	/***********************************************
	 ** Public Methods **
	************************************************/
	
	
	public function __construct( $set_options = true, $override_options = array() ){
		
		if ( $set_options ){
			
			$this->set_theme_options( $override_options );
			
		} // end if
		
	} // end __construct
	
	
	public function get_theme_options( $context = false){
		
		return apply_filters( 'theme_options_ignite_get', $this->theme_options, $context, $this->theme_options_defaults );
		
	} // end get_theme_options
	
	
	public function get_theme_option( $key, $default, $context = false ){
		
		if ( array_key_exists( $key, $this->theme_options ) ){
			
			return $this->theme_options[ $key ];
			
		} else {
			
			return $default;
			
		} // end if
		
	} // end get_theme_option
	
	
	public function set_theme_options( $override = array() ){
		
		foreach( $this->theme_options_defaults as $key => $default ){
			
			if ( array_key_exists( $key, $override ) ){
				
				$this->theme_options[ $key ] = $override[ $key ];
				
			} else {
				
				$this->theme_options[ $key ] = get_theme_mod( $key, $default );
				
			}// end if
			
		} // end foreach
		
	} // end set_theme_options
	
	
	/***********************************************
	 ** Private/Protected Methods **
	************************************************/
	
} // end Theme_Options_Ignite