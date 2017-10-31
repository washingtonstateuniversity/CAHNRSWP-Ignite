<?php

class Secondary_Menu_Ignite extends Theme_Part_Ignite {
	
	protected $default_args = array(
		'type' => 'default',
		'menu' => '',
	);
	
	protected $settings = array(
		'menu' => '_cahnrswp_secondary_menu'
	);
	
	public function the_menu( $context = 'single', $args = array() ){
		
		$args = $this->get_customizer_args( $args );
		
		if ( ! empty( $args['menu'] ) ){
		
			$html = '';
			
			switch( $args['type'] ){
				
				default:
					$html = $this->get_default_menu( $context, $args );
					break;
				
			} // End switch
			
			echo apply_filters( 'cahnrs_ignite_page_html', $html );
		
		} // End if
		
	} // End get_footer
	
	
	protected function get_default_menu( $context, $args ){
		
		ob_start();
		
		include locate_template( 'theme-parts/secondary-menu/includes/default-secondary-menu.php', false );
		
		return ob_get_clean();
		
	} // End get_college_global_footer
	
} // End Secondary_Menu_Ignite