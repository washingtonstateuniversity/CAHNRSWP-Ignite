<?php
/**
 * Custom functionality required by your child theme can go here. Use this
 * to override any defaults provided by the Spine parent theme through
 * the provided actions and filters.
 */

class Functions_Ignite {
	
	
	public function __construct(){
		
		$this->init_theme_functions();
		
	} // end __construct
	
	
	protected function init_theme_functions(){
	} // end init_theme_functions
	
	
} // end Functions_Ignite

$ignite_theme = new Functions_Ignite();