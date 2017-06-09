<?php

if ( get_theme_mod( '_cahnrswp_header_show_college_global', 1 ) ) {
	
	include locate_template( 'includes/headers/college/college-global-nav.php', false );

} // end if
	
if ( get_theme_mod( '_cahnrswp_header_display_banner', 1 ) ) {
	
	include locate_template( 'includes/headers/college/college-banner.php', false );

} // end if 

if ( get_theme_mod( '_cahnrswp_header_horizontal_nav', 0 ) ){
	
	include locate_template( 'includes/headers/college/college-horizontal-menu.php', false );
	
} // end if