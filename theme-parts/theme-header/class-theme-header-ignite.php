<?php

class Theme_Header_Ignite extends Theme_Part_Ignite {
	
	public function the_theme_header( $context = 'single', $args = array() ){
		
		switch( $context ){
			
			default:
				$html .= $this->get_default_header( $context, $args );
				break;
			
		} // End switch
		
		echo apply_filters( 'cahnrs_ignite_page_html', $html );
		
	} // End get_footer
	
	
	public function get_theme_header( $context = 'single', $args = array() ){
		
		switch( $context ){
			
			default:
				$html .= $this->get_default_header( $context, $args );
				break;
			
		} // End switch
		
		return apply_filters( 'cahnrs_ignite_page_html', $html );
		
	} // End get_footer
	
	
	protected function get_default_header( $context, $args ){
		
		ob_start();
		
		include locate_template( 'includes/headers/header.php', false );

		include locate_template( 'includes/main/main-start.php', false );
		
		return ob_get_clean();
		
	} // End get_default_header
	
} // End Theme_Header
