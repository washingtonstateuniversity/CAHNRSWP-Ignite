<?php 

class CAHNRSWP_Ignite {
	
	public static $version = '0.0.1';
	
	private static $instance;
	
	/**
	 * Get the current instance or set it and return
	 * @return CAHNRSWP_Spine_Child 
	*/
	public static function get_instance(){
		 
		 if ( null == self::$instance ) {
			 
            self::$instance = new self;
			self::$instance->init();
			
		} // end if
 
		return self::$instance;
		 
	} // end get_instance
	 
	/**
	 * Gets called when instance of CAHNRSWP_Spine_Child
	 * is created
	**/
	private function init(){
		 
		define( 'CAHNRSIGNITEPATH' , get_stylesheet_directory() . '/' );
		define( 'CAHNRSIGNITEURL' , get_stylesheet_directory_uri() . '/' );
		
		require_once 'classes/class-post-editor-ignite.php';
		require_once 'classes/class-single-post-ignite.php';
		require_once 'classes/class-forms-ignite.php';
		require_once 'classes/class-theme-options-ignite.php';
		require_once 'classes/class-sidebars-ignite.php';
		 
		$forms = new Forms_Ignite();
		$theme_options = new Theme_Options_Ignite( $forms );
		$sidebars = new Sidebars_Ignite();
		$post_editor = new Post_Editor_Ignite( $forms );
		 
		$theme_options->init();
		$sidebars->init();
		$post_editor->init();
		
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		 
	} // end init
	
	
	public function wp_enqueue_scripts(){
		
		wp_enqueue_script( 'ignite-js', CAHNRSIGNITEURL . 'js/ignite.js', array( 'jquery' ), self::$version, true );
		
		wp_enqueue_style( 'font-awesome', CAHNRSIGNITEURL . 'font-awesome/css/font-awesome.min.css', array(), self::$version );
		
	} // end wp_enqueue_scripts
	
	
} // end CAHNRSWP_Spine_Child

/** 
 * Get instance. Using a singlton pattern since there
 * should never be two instances of CAHNRSWP_Spine_Child
**/ 
$cahnrswp_ignite = CAHNRSWP_Ignite::get_instance();