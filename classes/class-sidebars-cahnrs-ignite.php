<?php

class Sidebars_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
		
	} // end __construct
	
	
	public function register_sidebars(){
		
		register_sidebar( array(
			'name' => 'Header Before',
			'id' => 'header_before',
			'description' => 'Widgets in this area will be shown before the Header.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		) );
		
		register_sidebar( array(
			'name' => 'Header After',
			'id' => 'header_after',
			'description' => 'Widgets in this area will be shown after the Header.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		) );
		
		register_sidebar( array(
			'name' => 'Top Header Bar Primary',
			'id' => 'global-top-header-bar-primary',
			'description' => 'Widgets in this area will be shown first in the top header bar.',
			'before_widget' => '',
			'after_widget'  => '',
		) );
		
		register_sidebar( array(
			'name' => 'Top Header Bar Secondary',
			'id' => 'global-top-header-bar-secondary',
			'description' => 'Widgets in this area will be shown to the right in the top header bar.',
			'before_widget' => '',
			'after_widget'  => '',
		) );
		
		register_sidebar( array(
			'name' => 'Banner After',
			'id' => 'banner_after',
			'description' => 'Widgets in this area will be shown after the Banner.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		) );
		
		register_sidebar( array(
			'name' => 'Banner Inner',
			'id' => 'banner_inner',
			'description' => 'Widgets in this area will be shown before the Banner.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		) );
		
		register_sidebar( array(
			'name' => 'Banner Before',
			'id' => 'banner_before',
			'description' => 'Widgets in this area will be shown before the Banner.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		) );
		
		register_sidebar( array(
			'name' => 'Footer Before',
			'id' => 'footer_before',
			'description' => 'Widgets in this area will be shown before the footer.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		) );
		
		register_sidebar( array(
			'name' => 'Footer After',
			'id' => 'footer_after',
			'description' => 'Widgets in this area will be shown after the footer.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		) );
		
		
		$this->add_customizer_sidebars();
		
	} // end register_sidebars
	
	
	protected function add_customizer_sidebars(){
		
		$sidebars = get_theme_mod( '_cahnrswp_ignite_sidebars', array() );
		
		if ( ! is_array( $sidebars ) ) $sidebars = array();
		
		foreach( $sidebars as $sidebar ){
			
			$id = str_replace( array('\'','"'), '', strtolower( $sidebar ) );
			
			$id = str_replace( array('_',' '), '-', $id );
			
			register_sidebar( array(
				'name' => $sidebar,
				'id' => $id,
				'description' => 'Custom Sidebar Create in Customizer.',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			) );
			
		} // End foreach
		
	} // End add_customizer_sidebars
	
	
} // end Sidebars_CAHNRS_Ignite

$sidebars_cahnrs_ignite = new Sidebars_CAHNRS_Ignite();