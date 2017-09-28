<?php

class Menus_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_filter( 'wp_nav_menu_args', array( $this, 'modify_nav_menu_args' ), 1 );
		
	} // End __construct
	
	
	function modify_nav_menu_args( $args ){
		
		if( 'site' == $args['theme_location'] ) {
			
			$menu_depth = get_theme_mod( '_cahnrs_ignite_global_menu_depth', '' );
			
			if ( ! empty( $menu_depth ) ){
			 
				$args['depth'] = $menu_depth;
			
			} // End if
			
		} // End if
	
		return $args;
		
	} // End modify_nav_menu_args
	
	
} // End Menus_CAHNRS_Ignite

$menus_cahnrs_ignite = new Menus_CAHNRS_Ignite();