<?php

ob_start();

include locate_template( 'includes/headers/header.php', false );

include locate_template( 'includes/main/main-start.php', false );

include_once CAHNRSIGNITEPATH . 'theme-parts/headers/class-header-ignite.php';
$header = new Header_Ignite();
$header->the_header( 'archive' );

include_once CAHNRSIGNITEPATH . 'theme-parts/page-banners/class-page-banner-cahnrs-ignite.php';
$page_banner = new Page_Banner_CAHNRS_Ignite();
$page_banner->the_banner( 'archive' );

include_once CAHNRSIGNITEPATH . 'theme-parts/secondary-menu/class-secondary-menu-ignite.php';
$secondary_menu = new Secondary_Menu_Ignite();
$secondary_menu->the_menu( 'archive' );

include_once CAHNRSIGNITEPATH . 'theme-parts/content/class-content-ignite.php';
$content = new Content_Ignite();
$content->the_content( 'archive' );

//include locate_template( 'includes/content/single.php', false );

include_once CAHNRSIGNITEPATH . 'theme-parts/footers/class-footer-ignite.php';
$footer = new Footer_Ignite();
$footer->the_footer( 'archive' );

include locate_template( 'includes/main/main-end.php', false );

get_footer();

$html = ob_get_clean();

echo apply_filters( 'cahnrs_ignite_page_html', $html );