<?php
/**
 * Custom functionality required by your child theme can go here. Use this
 * to override any defaults provided by the Spine parent theme through
 * the provided actions and filters.
 */

class Functions_Ignite {
	
	public static $version = '0.0.1';
	
	public function __construct(){
		
		$this->init_theme_functions();
		
	} // end __construct
	
	
	protected function init_theme_functions(){
		
		define( 'CAHNRSIGNITEPATH' , get_stylesheet_directory() . '/' );
		define( 'CAHNRSIGNITEURL' , get_stylesheet_directory_uri() . '/' );
		
		include_once CAHNRSIGNITEPATH . 'classes/class-sidebars-cahnrs-ignite.php';
		
		include_once CAHNRSIGNITEPATH . 'classes/class-scripts-cahnrs-ignite.php';
		
		include_once CAHNRSIGNITEPATH . 'classes/class-customizer-cahnrs-ignite.php';
		
		include_once CAHNRSIGNITEPATH . 'classes/class-css-cahnrs-ignite.php';
		
		include_once CAHNRSIGNITEPATH . 'classes/class-post-editor-cahnrs-ignite.php';
		
	} // end init_theme_functions

	
} // end Functions_Ignite

$ignite_theme = new Functions_Ignite();