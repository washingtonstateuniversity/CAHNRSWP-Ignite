<?php

class Sidebars_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
		
	} // end __construct
	
	
	public function register_sidebars(){
		
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
		
	} // end register_sidebars
	
	
} // end Sidebars_CAHNRS_Ignite

$sidebars_cahnrs_ignite = new Sidebars_CAHNRS_Ignite();