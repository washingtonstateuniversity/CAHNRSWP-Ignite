<div id="site-content" class="parts-content-single-default">
<?php while ( have_posts() ) {
	
	the_post();
	
	$single_post = new Single_Post_Ignite( get_the_ID() );
	$settings = $single_post->get_settings();
    
	include CAHNRSIGNITEPATH . 'includes/articles/single-default.php';
	
} // end while ?>
</div>