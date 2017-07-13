<?php 

$header_type = get_theme_mod( '_cahnrswp_header_type', 'cahnrs-college' );

$classes = array();

if ( get_theme_mod( '_cahnrswp_header_show_college_global_nav', '' ) ){
	
	$classes[] = 'has-college-global-nav';
	
} // End if

if ( $header_type != 'spine' ){ // Use custom CAHNRS Header
		
	echo '<header id="site-header" class="' . implode( ' ', $classes ) . '">';

	switch( $header_type ){
		
		case 'cahnrs-college':
			include locate_template( 'includes/headers/college/college-header.php', false );
			break;
		
	} // end switch
	
	echo '</header>';
	
} else {
	
	$this->get_the_spine();
	
} // end if
