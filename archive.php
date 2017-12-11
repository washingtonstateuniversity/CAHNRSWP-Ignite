<?php

ignite_get_part('header','archive');

include_once CAHNRSIGNITEPATH . 'theme-parts/page-banners/class-page-banner-cahnrs-ignite.php';
$page_banner = new Page_Banner_CAHNRS_Ignite();
$page_banner->the_banner( 'archive' );

include_once CAHNRSIGNITEPATH . 'theme-parts/secondary-menu/class-secondary-menu-ignite.php';
$secondary_menu = new Secondary_Menu_Ignite();
$secondary_menu->the_menu( 'archive' );

include_once CAHNRSIGNITEPATH . 'theme-parts/content/class-content-ignite.php';
$content = new Content_Ignite();
$content->the_content( 'archive' );

ignite_get_part('footer','archive');