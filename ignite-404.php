<?php

ignite_get_part('header','404');

include_once CAHNRSIGNITEPATH . 'theme-parts/page-banners/class-page-banner-cahnrs-ignite.php';
$page_banner = new Page_Banner_CAHNRS_Ignite();
$page_banner->the_banner( '404', array('type' => '404' ) );

include_once CAHNRSIGNITEPATH . 'theme-parts/secondary-menu/class-secondary-menu-ignite.php';
$secondary_menu = new Secondary_Menu_Ignite();
$secondary_menu->the_menu( '404' );

ob_start();

include locate_template( 'includes/content/404.php', false );

$html = ob_get_clean();

echo apply_filters( 'cahnrs_ignite_page_html', $html );

ignite_get_part('footer','404');