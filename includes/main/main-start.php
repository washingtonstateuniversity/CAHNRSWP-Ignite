<?php

$is_cropped = ( true === spine_get_option( 'crop' ) && is_front_page() ) ? ' is-cropped-spine':'';
		
?>		
<main id="wsuwp-main" class="spine-page-default<?php echo $is_cropped ?>">