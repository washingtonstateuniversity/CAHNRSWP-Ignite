<div id="college-header-banner" class="site-banner <?php if ( get_theme_mod( '_cahnrswp_header_banner_img', '' ) )  { echo ' is-image-banner'; } else { echo ' is-text-banner'; }?>">
	<div id="site-logo">
    	<?php if ( get_theme_mod( '_cahnrswp_header_banner_img', '' ) ):?>
        	<div class="site-logo-image">
            <a href=""><img src="<?php echo get_theme_mod( '_cahnrswp_header_banner_img', '' );?>" /></a>
        </div>
        <?php else:?>
        <div class="site-logo-text">
            <span class="site-title"><a href="<?php echo get_bloginfo( 'url' );?>"><?php echo get_bloginfo( 'name' );?></a></span>
            <?php if ( get_theme_mod( '_cahnrswp_header_banner_show_subhead', 1 ) ):?><span class="site-subtitle"><?php echo get_bloginfo( 'description' );?></span><?php endif;?><?php echo ignite_get_sidebar( 'header_banner_inner', $args = array('wrap' => 'span' ) );?>
        </div>
        <?php endif;?>
    </div>
</div>