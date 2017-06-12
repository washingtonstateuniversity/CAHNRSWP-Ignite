<?php

$banner_type = get_theme_mod( '_cahnrswp_page_banner_type', 'dynamic-scroll' );

switch( $banner_type ){
	
	case 'dynamic-scroll':
	default:
		include locate_template( 'includes/banners/types/dynamic-scroll.php', false );
		break;
	
} // end switch