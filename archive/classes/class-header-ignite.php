<?php

class Header_Ignite {
	
	public function get_the_college_header(){
		
		ob_start();
		
		if ( get_theme_mod( '_cahnrswp_header_show_college_global', 1 )) {
    
			get_template_part( 'parts/headers/college-global-nav' );
		
		} // end if
	
		if ( get_theme_mod( '_cahnrswp_header_display_banner', 1 ) ) {
		
			get_template_part( 'parts/headers/college-banner' );
		
		} // end if 
		
		if ( get_theme_mod( '_cahnrswp_header_horizontal_nav', 0 ) ){
			
			get_template_part( 'parts/headers/college-horizontal-menu' );
			
		} // end if
		
		return ob_get_clean();
		
	} // end get_the_college_header
	
	
	public function get_the_header(){
		
		$html = '';
		
		$header_type = get_theme_mod( '_cahnrswp_header_type', 'cahnrs-college' );
		
		if ( $header_type != 'spine' ){ // Use custom CAHNRS Header
		
			$html .= '<header id="site-header">';
		
			switch( $header_type ){
				
				case 'cahnrs-college':
					$html .= $this->get_the_college_header();
					break;
				
			} // end switch
			
			$html .= '</header>';
			
		} else {
			
			$html .= $this->get_the_spine();
			
		} // end if
		
		
		
		return $html;
		
	} // end get_the_banner
	
	
	public function get_the_spine(){
		
		ob_start();
			
		get_template_part( 'parts/headers' );
	
		get_template_part( 'parts/featured-images' );
		
		return ob_get_clean();
		
	} // end get_the_spine
	
	
} // end Header_Ignite