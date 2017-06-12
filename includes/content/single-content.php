<?php

$content_type = get_theme_mod( '_cahnrswp_ignite_single_content_type', 'page' );

echo '<div id="site-content">';

switch( $content_type ){
	
	case 'page':
	default:
		include locate_template( 'includes/content/types/single-page.php', false );
		break;
	
} // end switch

echo '</div>';