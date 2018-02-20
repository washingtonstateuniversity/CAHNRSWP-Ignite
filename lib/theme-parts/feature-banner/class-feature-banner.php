<?php namespace CAHNRSWP\themes\ignite;

class Feature_Banner {
	
	
	public function __construct(){
		
		$this->add_banners();
		
	} // __construct
	
	
	protected function add_banners(){
		
		include_once ignite_get_theme_path('lib/theme-parts/feature-banner/play-video-banner/class-play-video-banner.php');
		
	} // End add_banners
	
	
} // End Feature Banner

$feature_banner = new Feature_Banner();