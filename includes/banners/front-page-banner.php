<?php

$banner_type = get_theme_mod( '_cahnrswp_ignite_fronpage_feature', 'dynamic-scroll' );

switch( $banner_type ){
	
	case 'wide-static-slides':
		include locate_template( 'includes/banners/types/wide-static-slides/wide-static-slides.php', false );
		break;
		
	case 'dynamic-scroll':
	default:
		include locate_template( 'includes/banners/types/dynamic-scroll.php', false );
		break;
	
} // end switch