<?php

$banner_image = get_theme_mod( '_cahnrswp_front_page_banner_image', '' );

if ( empty( $banner_image ) &&  get_the_ID() ){
	
	if ( has_post_thumbnail( get_the_ID() ) ){
		
		$img_id = get_post_thumbnail_id( get_the_ID() );
				
		$img_url_array = wp_get_attachment_image_src( $img_id, 'full', true );
				
		$banner_image = $img_url_array[0];
		
	} // end if
	
} // end if

if ( ! empty( $banner_image ) ): ?>
<div id="site-banner" class="static-image-wide-banner parallax-banner">
	<div class="banner-image-wrap" style="background-image:url(<?php echo $banner_image ?>);">
    	<div class="banner-image" style="background-image:url(<?php echo $banner_image ?>);">
        </div>
    </div>
</div><?php endif ?>