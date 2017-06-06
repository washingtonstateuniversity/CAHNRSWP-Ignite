<?php 

require_once 'classes/class-template-page-ignite.php';

$template = new Template_Page_Ignite();

$template->the_template(); 

/*get_header();

 ?>

<main id="wsuwp-main" class="spine-page-default<?php if ( true === spine_get_option( 'crop' ) && is_front_page() ) echo ' is-cropped-spine';?>">

<?php 

	// if not set or set to default use WSU spine header
	if ( get_theme_mod( '_cahnrswp_header_type', 'cahnrs-college' ) != 'spine' ){ // Use custom CAHNRS Header
		
		get_template_part( 'parts/headers', 'college' );
		
		require_once CAHNRSIGNITEPATH . 'classes/class-page-banner-ignite.php';
		
		$page_banner = new Page_Banner_Ignite();
		
		$page_banner->the_banner( 'parallax-banner', 'full' );
		
		//get_template_part( 'parts/banner');
		
	} else { // Use custom CAHNRS Header
		
		get_template_part( 'parts/headers' );
		
		get_template_part( 'parts/featured-images' );
		
	} // end if
	
	get_template_part( 'parts/content/single', 'default' );
	
	get_template_part( 'parts/footers' );
?>

</main>

<?php get_footer();?>