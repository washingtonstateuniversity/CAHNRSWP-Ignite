<?php 
if ( is_active_sidebar( 'footer_before' ) ) {
	
	include CAHNRSIGNITEPATH . 'includes/footers/footer-before-widget-area.php';
	
} // end if

$footer_type = get_theme_mod( '_cahnrswp_footer_type', 'college' );

ob_start();

switch( $footer_type ){
	case 'default':
	case '':
		break;
	default:
		include CAHNRSIGNITEPATH . 'includes/footers/college.php';
		break;
} // end switch

echo ob_get_clean();

if ( is_active_sidebar( 'footer_after' ) ) {
	
	include CAHNRSIGNITEPATH . 'includes/footers/footer-after-widget-area.php';
	
} // end if