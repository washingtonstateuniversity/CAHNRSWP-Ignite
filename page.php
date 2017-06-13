<?php

ob_start();

include locate_template( 'includes/headers/header.php', false );

include locate_template( 'includes/main/main-start.php', false );

include locate_template( 'includes/headers/site-header.php', false );

include locate_template( 'includes/banners/page-banner.php', false );

include locate_template( 'includes/content/single-page.php', false );

include locate_template( 'includes/main/main-end.php', false );

include locate_template( 'includes/footers/footer.php', false );

$html = ob_get_clean();

echo apply_filters( 'cahnrs_ignite_page_html', $html );