<section id="site-banner" class="cahnrs-ignite-feature wide-static-slide parallax-banner">
	<div class="ci-slideshow inactive">
		<div class="ci-slide-set-wrap">
			<nav class="ci-slide-controls">
				<div class="ci-prev-slide"><span></span></div>
				<div class="ci-next-slide"><span></span></div>
			</nav>
			<div class="ci-slide-set"><?php foreach( $slides as $index => $slide):?>
				<div class="ci-slide<?php if ( 0 === $index ) echo ' active';?>">
					<div class="ci-slide-image-wrapper">
						<div class="ci-slide-image banner-image" style="background-image:url(<?php echo $slide->post_images['full'];?>);background-position: center; background-size: cover;">
						</div>
					</div>
					<div class="ci-slide-caption-wrapper">
						<div class="ci-slide-caption ci-content-wrap">
							<div class="ci-caption-inner">
								<div class="ci-caption-title">
									<h2><?php echo $slide->post_title;?></h2><span>Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
									<?php echo $slide->get_link_html();?><?php echo $slide->get_link_html( true );?>
								</div>
								<div class="ci-summary">
									<?php echo $slide->post_excerpt;?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach;?></div>
		</div>
		<nav class="ci-slide-thumbs-control">
			<div class="ci-slide-thumbs-wrapper ci-content-wrap">
				<div class="ci-slide-thumbs-inner">
					<div class="ci-slide-thumbs">
						<?php foreach( $slides as $index => $slide):?>
							<div class="ci-slide-thumb<?php if ( 0 === $index ) echo ' active';?>" style="background-image:url(<?php echo $slide->post_images['full'];?>);background-position: center; background-size: cover;"></div>
						<?php endforeach;?> 
					</div>
					<!--<a href="#" class="ci-more">More Featured Stories <i class="fa fa-chevron-right" aria-hidden="true"></i></a>-->
				</div>
			</div>
		</nav>
	</div>
</section><script><?php include 'wide-static-slides.js';?></script>

<?php


/*var_dump( $api_response );


$index = 0;

$args = array(
	'post_type' => 'news-release',
	'status' => 'publish',
	'posts_per_page' => 4,
	'meta_query' => array(
		'relation' => 'OR',
		array(
			'key'     => '_news_release_placement',
			'value'   => 'feature-slideshow',
			'compare' => 'LIKE',
		),
	),
);


// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {

	while ( $the_query->have_posts() ) {
		$the_query->the_post(); 
		
		$image = '';
		
		if ( has_post_thumbnail() ){
				
			$img_id = get_post_thumbnail_id( get_the_ID() );
				
			$img_url_array = wp_get_attachment_image_src( $img_id, 'full', true );
			
			$image = $img_url_array[0];
			
		} // End if
			
		$title = ( get_post_meta( get_the_ID(), '_news_release_short_title', true ) ) ? get_post_meta( get_the_ID(), '_news_release_short_title', true ) : get_the_title();
		
		$excerpt = get_the_excerpt();
		
		$excerpt = wp_trim_words( $excerpt, 35 );
		
		$nav_slide[] = array( 'image' => $image );
		
		
		ob_start()?>
		<div class="ci-slide<?php if ( 0 === $index ) echo ' active'; $index++?>">
			<div class="ci-slide-image-wrapper">
				<div class="ci-slide-image banner-image" style="background-image:url(<?php echo $image;?>);background-position: center; background-size: cover;">
				</div>
			</div>
			<div class="ci-slide-caption-wrapper">
				<div class="ci-slide-caption ci-content-wrap">
					<div class="ci-caption-inner">
						<div class="ci-caption-title">
							<h2><?php echo $title;?></h2><a href="<?php echo get_post_permalink();?>" class="ci-read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
						</div>
						<div class="ci-summary">
							<?php echo $excerpt;?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $slides[] = ob_get_clean();
	}
	/* Restore original Post Data */
	/*wp_reset_postdata();
} // End if
?> 
<?php $slide_index = rand( 0, 3 );?><style><?php include 'wide-static-slides.css';?>
</style><section id="site-banner" class="cahnrs-ignite-feature wide-static-slide parallax-banner">
	<div class="ci-slideshow inactive">
		<div class="ci-slide-set-wrap">
			<nav class="ci-slide-controls">
				<div class="ci-prev-slide"><span></span></div>
				<div class="ci-next-slide"><span></span></div>
			</nav>
			<div class="ci-slide-set">
				<?php if ( ! empty( $slides ) ):?>
					<?php echo implode( '', $slides );?>
				<?php else:?>
				<div class="ci-slide<?php if ( 0 === $slide_index ) echo ' active';?>">
					<div class="ci-slide-image-wrapper">
						<div class="ci-slide-image banner-image" style="background-image:url(http://stage.cahnrs.wsu.edu/wp-content/uploads/2017/07/Shots-of-Brandon-working_10.jpg);background-position: center; background-size: cover;">
						</div>
					</div>
					<div class="ci-slide-caption-wrapper">
						<div class="ci-slide-caption ci-content-wrap">
							<div class="ci-caption-inner">
								<div class="ci-caption-title">
									<h2>A sweet road trip</h2><a href="http://stage.cahnrs.wsu.edu/news-release/2017/07/10/a-sweet-road-trip/" class="ci-read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
								</div>
								<div class="ci-summary">
									This winter, the WSU honey bees, along with a dozen faculty, researchers, and students went to California’s Central Valley to do some research and pollinate almonds.
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ci-slide<?php if ( 1 === $slide_index ) echo ' active';?>">
					<div class="ci-slide-image-wrapper">
						<div class="ci-slide-image banner-image" style="background-image:url(http://stage.cahnrs.wsu.edu/wp-content/uploads/2017/07/2017summer-left-wine-1.jpg);background-position: center; background-size: cover;">
						</div>
					</div>
					<div class="ci-slide-caption-wrapper">
						<div class="ci-slide-caption ci-content-wrap">
							<div class="ci-caption-inner">
								<div class="ci-caption-title">
									<h2>Hanging a Left at Wine</h2><a href="https://magazine.wsu.edu/2017/04/27/hanging-a-left-at-wine/" class="ci-read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
								</div>
								<div class="ci-summary">
									The allure of winemaking has attracted a menagerie of professionals to the business. Washington State University’s Viticulture and Enology Program has lured aerospace engineers, Army medics, apparel designers, scientists, and many others to the field.
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ci-slide<?php if ( 2 === $slide_index ) echo ' active';?>">
					<div class="ci-slide-image-wrapper">
						<div class="ci-slide-image banner-image" style="background-image:url(http://stage.cahnrs.wsu.edu/wp-content/uploads/2017/07/2017summer-space-farm.1264-e1501107946419.jpg);background-position: center; background-size: cover;">
						</div>
					</div>
					<div class="ci-slide-caption-wrapper">
						<div class="ci-slide-caption ci-content-wrap">
							<div class="ci-caption-inner">
								<div class="ci-caption-title">
									<h2>Space Farming</h2><a href="https://magazine.wsu.edu/2017/04/28/space-farming/" class="ci-read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
								</div>
								<div class="ci-summary">
									NASA sees plants not only as potential food sources aboard future spacecraft but as natural oxygen producers. The space agency is preparing for its first in-depth study of how growth and development of plants is affected by gravity, or more specifically the lack of it.
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ci-slide<?php if ( 3 === $slide_index ) echo ' active';?>">
					<div class="ci-slide-image-wrapper"> 
						<div class="ci-slide-image banner-image" style="background-image:url(http://stage.cahnrs.wsu.edu/wp-content/uploads/2017/07/2017summer-inseason-1.jpg);background-position: center; background-size: cover;">
						</div>
					</div>
					<div class="ci-slide-caption-wrapper">
						<div class="ci-slide-caption ci-content-wrap">
							<div class="ci-caption-inner">
								<div class="ci-caption-title">
									<h2>Fresh Peas</h2><a href="https://magazine.wsu.edu/2017/04/28/fresh-peas/" class="ci-read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
								</div>
								<div class="ci-summary">
									Longtime farmer Wright and former Master Gardener Klingele grow about 20 different row crops on their Gypsy Rows farm in Silvana, a tiny town situated between Everett and Mount Vernon within spitting distance of Camano Island.
								</div>
							</div>
						</div>
					</div>
				</div><?php endif;?>
			</div>
		</div>
		<nav class="ci-slide-thumbs-control">
			<div class="ci-slide-thumbs-wrapper ci-content-wrap">
				<div class="ci-slide-thumbs-inner">
					<div class="ci-slide-thumbs">
						<?php if ( ! empty( $nav_slide ) ):?>
							<?php foreach( $nav_slide as $index => $slide):?>
								<div class="ci-slide-thumb<?php if ( 0 === $index ) echo ' active';?>" style="background-image:url(<?php echo $slide['image'];?>);background-position: center; background-size: cover;"></div>
							<?php endforeach;?> 
						<?php else:?>
						<div class="ci-slide-thumb<?php if ( 0 === $slide_index ) echo ' active';?>" style="background-image:url(http://stage.cahnrs.wsu.edu/wp-content/uploads/2017/07/Shots-of-Brandon-working_10.jpg);background-position: center; background-size: cover;"></div>
						<div class="ci-slide-thumb<?php if ( 1 === $slide_index ) echo ' active';?>" style="background-image:url(http://stage.cahnrs.wsu.edu/wp-content/uploads/2017/07/2017summer-left-wine-1.jpg);background-position: center; background-size: cover;"></div>
						<div class="ci-slide-thumb<?php if ( 2 === $slide_index ) echo ' active';?>" style="background-image:url(http://stage.cahnrs.wsu.edu/wp-content/uploads/2017/07/2017summer-space-farm.1264-e1501107946419.jpg);background-position: center; background-size: cover;"></div>
						<div class="ci-slide-thumb<?php if ( 3 === $slide_index ) echo ' active';?>" style="background-image:url(http://stage.cahnrs.wsu.edu/wp-content/uploads/2017/07/2017summer-inseason-1.jpg);background-position: center; background-size: cover;"></div>
						<?php endif;?>
					</div>
					<!--<a href="#" class="ci-more">More Featured Stories <i class="fa fa-chevron-right" aria-hidden="true"></i></a>-->
				</div>
			</div>
		</nav>
	</div>
</section><script><?php include 'wide-static-slides.js';?></script>*/