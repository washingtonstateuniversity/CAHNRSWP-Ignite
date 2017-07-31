<?php

ob_start();

include locate_template( 'includes/headers/header.php', false );

include locate_template( 'includes/main/main-start.php', false );

include_once CAHNRSIGNITEPATH . 'theme-parts/headers/class-header-ignite.php';
$header = new Header_Ignite();
$header->the_header( 'single-post' );

include locate_template( 'includes/banners/post-banner.php', false );

include locate_template( 'includes/content/single-post.php', false );

include_once CAHNRSIGNITEPATH . 'theme-parts/footers/class-footer-ignite.php';
$footer = new Footer_Ignite();
$footer->the_footer( 'single-post');

include locate_template( 'includes/main/main-end.php', false );

get_footer();

$html = ob_get_clean();

echo apply_filters( 'cahnrs_ignite_page_html', $html );