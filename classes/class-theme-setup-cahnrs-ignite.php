<?php

class Theme_Setup_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'set_default_template' ), 9999 );
		
		add_filter( 'cahnrs_ignite_page_html', array( $this, 'check_cropped_spine' ) );
		
	} // End __construct
	
	
	public function set_default_template(){
		
		$builder_setting = get_theme_mod( '_cahnrswp_enable_spine_builder', 'disable');
		
		if ( 'disable' === $builder_setting ){
		
			add_filter( 'spine_enable_builder_module', array( $this, 'disable_builder_module'), 9999 );
		
		} // End if
		
	} // End set_default_template
	
	
	public function disable_builder_module( $setting ){
		
		return false;
		
	} // End $setting
	
	
	public function check_cropped_spine( $html ){
		
		//$is_cropped = get_theme_mod( '_cahnrs_ignite_global_cropped_spine', false );
		
		$is_cropped = true;
		
		if ( $is_cropped ){
			
			$html = preg_replace_callback( 
				'/id="spine"(.*?)class="/', 
				function( $match ){ 
					return $match[0] . 'cropped '; 
				}, 
				$html
			); 
			
		} // End if
		
		return $html;
		
	} // End check_cropped_spine
	
	
	
} // End Theme_Setup_CAHNRS_Ignite

$theme_setup = new Theme_Setup_CAHNRS_Ignite();