<?php

the_ignite_theme_header('search');

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
$content->the_content( 'search' );

the_ignite_theme_footer('search');