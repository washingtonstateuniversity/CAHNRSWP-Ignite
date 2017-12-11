<?php
/**
 * Custom functionality required by your child theme can go here. Use this
 * to override any defaults provided by the Spine parent theme through
 * the provided actions and filters.
 */

class Functions_Ignite {
	
	public static $version = '0.0.5';
	
	public function __construct(){
		
		define( 'CAHNRSIGNITEPATH' , get_stylesheet_directory() . '/' );
		
		define( 'CAHNRSIGNITEURL' , get_stylesheet_directory_uri() . '/' );
		
		include_once 'lib/functions/global-functions.php';
		
		$this->init_theme_functions();
		
	} // end __construct
	
	
	protected function init_theme_functions(){
		
		if ( isset( $_GET['cahnrs-cache'] ) ){
			
			var_dump('cache cleared');
			
			wp_cache_flush();
	
			if ( class_exists( 'Memcache' ) ){
				$memcache_obj = new Memcache;
				$memcache_obj->connect('localhost', 11211);
				
				$memcache_obj->flush();
			};
			
		} // end if
		
		include_once ignite_get_theme_path('classes/class-theme-setup-cahnrs-ignite.php');
		
		include_once ignite_get_theme_path('classes/class-theme-part-ignite.php');
		
		include_once ignite_get_theme_path('classes/class-scripts-cahnrs-ignite.php');
		
		include_once ignite_get_theme_path('classes/class-customizer-cahnrs-ignite.php');
		
		include_once ignite_get_theme_path('classes/class-css-cahnrs-ignite.php');
		
		include_once ignite_get_theme_path('classes/class-post-editor-cahnrs-ignite.php');
		
		$this->add_sidebars();
		
		$this->add_post_types();
		
		$this->add_shortcodes();
		
		$this->add_menus();
		
		$this->add_taxonomies();
		
		$this->add_customizer_controls();
		
		$this->add_post_formats();
		
		add_action('widgets_init', array( $this, 'add_widgets' ) );
		
	} // end init_theme_functions
	
	
	protected function add_shortcodes(){
		
		include_once ignite_get_theme_path('lib/shortcodes/class-shortcode-cahnrs-ignite.php');
		
		include_once ignite_get_theme_path('lib/shortcodes/cahnrs-news/class-cahnrs-news-shortcode-ignite.php');
		
		include_once ignite_get_theme_path('lib/shortcodes/cahnrs-search/class-cahnrs-search-shortcode-ignite.php');
		
		include_once ignite_get_theme_path('lib/shortcodes/theme-part/class-cahnrs-theme-part-shortcode-ignite.php');
		
		include_once ignite_get_theme_path('lib/shortcodes/cahnrs-events/class-cahnrs-events-shortcode-ignite.php');
		
		include_once ignite_get_theme_path('lib/shortcodes/cahnrs-publications/class-cahnrs-publications-shortcode-ignite.php');
		
		include_once ignite_get_theme_path('lib/shortcodes/cahnrs-posts/class-cahnrs-posts-shortcode-ignite.php');
		
		include_once ignite_get_theme_path('lib/shortcodes/cwpinsert/class-cwpinsert-shortcode-ignite.php');
		
		include_once ignite_get_theme_path('lib/shortcodes/cwpaccordions/class-cwpaccordion-shortcode-ignite.php');
		
	} // End add_shortcodes
	
	
	protected function add_post_types(){
		
		include_once ignite_get_theme_path('lib/post-types/class-post-type-ignite.php');
		
		include_once ignite_get_theme_path('lib/post-types/articles/class-articles-post-type-cahnrs-ignite.php');
		
		include_once ignite_get_theme_path('lib/post-types/news-release/class-news-release-post-type-cahnrs-ignite.php');
		
		include_once ignite_get_theme_path('lib/post-types/theme-parts/class-theme-part-post-type-cahnrs-ignite.php');
		
		include_once ignite_get_theme_path('lib/post-types/publications/class-publications-post-type-cahnrs-ignite.php');
		
		include_once ignite_get_theme_path('lib/post-types/slides/class-slide-post-type-ignite.php');
		
		include_once ignite_get_theme_path('lib/post-types/videos/class-video-post-type-ignite.php');
		
		include_once ignite_get_theme_path('lib/post-types/degrees/class-degree-post-type-ignite.php');
		
	} // End add_post_types
	
	
	protected function add_sidebars(){
		
		include_once ignite_get_theme_path('classes/class-sidebars-cahnrs-ignite.php');
		
	} // End add_sidebars
	
	
	protected function add_menus(){
		
		include_once ignite_get_theme_path('classes/class-menus-cahnrs-ignite.php');
		
	} // End add_menus
	
	
	public function add_widgets(){
		
		include_once ignite_get_theme_path('widgets/theme-parts/class-theme-part-widget-cahnrs-ignite.php');
		
		register_widget( 'Theme_Part_Widget_CAHNRS_Ignite' );
		
	} // End add_widgets
	
	
	protected function add_taxonomies(){
		
		include_once ignite_get_theme_path('lib/taxonomies/slideshow-category/class-slideshow-category-ignite.php');
		
	} // End add_taxonomies
	
	
	protected function add_customizer_controls(){
		
		if ( class_exists('WP_Customize_Control') ){
		
			include_once ignite_get_theme_path('lib/customizer/controls/multi-select/class-customizer-multi-select-control-ignite.php');
			
		} // End if
		
	} // End add_customizer_controls
	
	
	protected function add_post_formats(){
		
		include_once ignite_get_theme_path('lib/post-formats/class-post-formats-ignite.php');
		
	} // End add_post_formats

	
} // end Functions_Ignite

$ignite_theme = new Functions_Ignite();