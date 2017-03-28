<header id="site-header">
	<?php 
	
	if ( get_theme_mod( '_cahnrswp_header_show_college_global', 1 )) {
    
		get_template_part( 'parts/headers/college-global-nav' );
	
	} // end if

    if ( get_theme_mod( '_cahnrswp_header_display_banner', 1 ) ) {
    
        get_template_part( 'parts/headers/college-banner' );
    
	} // end if 
	
	if ( get_theme_mod( '_cahnrswp_header_horizontal_nav', 0 ) ){
		
		get_template_part( 'parts/headers/college-horizontal-menu' );
		
	} // end if
	
	?>
    <div id="header-after-content"></div>
</header>
<div id="header-after-header"></div>