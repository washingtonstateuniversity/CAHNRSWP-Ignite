<?php if ( ! empty( $banner_image ) ): ?>
<div id="site-banner" class="static-image-wide-banner parallax-banner<?php if ( ! empty( $classes ) ) echo ' ' . implode(' ', $classes ); ?>">
	<div class="banner-image-wrap" style="background-image:url(<?php echo $banner_image ?>);">
    	<div class="banner-image" style="background-image:url(<?php echo $banner_image ?>);">
        </div>
    </div>
</div><?php endif ?>