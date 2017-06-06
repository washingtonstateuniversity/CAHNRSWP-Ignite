<?php

class Sidebars_Ignite {
	
	/**
	 * Called on initialization of the theme
	**/
	public function init(){
		
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
		
	} // end init
	
	
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
	
}