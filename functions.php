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
		
		include_once CAHNRSIGNITEPATH . 'classes/class-scripts-cahnrs-ignite.php';
		
		include_once CAHNRSIGNITEPATH . 'classes/class-customizer-cahnrs-ignite.php';
		
		include_once CAHNRSIGNITEPATH . 'classes/class-css-cahnrs-ignite.php';
		
		include_once CAHNRSIGNITEPATH . 'classes/class-post-editor-cahnrs-ignite.php';
		
		$this->add_sidebars();
		
		$this->add_post_types();
		
		$this->add_shortcodes();
		
	} // end init_theme_functions
	
	
	protected function add_shortcodes(){
		
		include_once CAHNRSIGNITEPATH . 'shortcodes/cahnrs-news/class-cahnrs-news-shortcode-ignite.php';
		
	} // End add_shortcodes
	
	
	protected function add_post_types(){
		
		include_once CAHNRSIGNITEPATH . 'classes/class-news-cahnrs-ignite.php';
		
	} // End add_post_types
	
	
	protected function add_sidebars(){
		
		include_once CAHNRSIGNITEPATH . 'classes/class-sidebars-cahnrs-ignite.php';
		
	} // End add_sidebars

	
} // end Functions_Ignite

$ignite_theme = new Functions_Ignite();