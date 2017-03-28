<div id="college-header-banner" class="site-banner <?php if ( get_theme_mod( '_cahnrswp_header_banner_img', '' ) )  { echo ' is-image-banner'; } else { echo ' is-text-banner'; }?>">
	<div id="site-logo">
    	<?php if ( get_theme_mod( '_cahnrswp_header_banner_img', '' ) ):?>
        	<div class="site-logo-image">
            <a href=""><img src="<?php echo get_theme_mod( '_cahnrswp_header_banner_img', '' );?>" /></a>
        </div>
        <?php else:?>
        <div class="site-logo-text">
            <span class="site-title"><a href=""><?php echo get_bloginfo( 'name' );?></a></span>
            <span class="site-subtitle"><a href=""><?php echo get_bloginfo( 'description' );?></a></span>
        </div>
        <?php endif;?>
    </div>
</div>