<?php

class Theme_Setup_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'set_default_template' ), 9999 );
		
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
	
	
	
} // End Theme_Setup_CAHNRS_Ignite

$theme_setup = new Theme_Setup_CAHNRS_Ignite();