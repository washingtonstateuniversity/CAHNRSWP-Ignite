<?php

if ( function_exists( 'spine_get_option' ) && ( true === spine_get_option( 'crop' ) && is_front_page() ) || get_theme_mod( '_cahnrs_ignite_global_cropped_spine', false ) ) {
	
	$is_cropped = ' is-cropped-spine';
	
} else {

	$is_cropped = '';

}// End if
		
?>		
<main id="wsuwp-main" class="spine-page-default<?php echo $is_cropped ?>">