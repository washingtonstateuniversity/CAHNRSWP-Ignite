<?php

ob_start();

include locate_template( 'includes/headers/header.php', false );

include locate_template( 'includes/main/main-start.php', false );

include_once CAHNRSIGNITEPATH . 'theme-parts/headers/class-header-ignite.php';
$header = new Header_Ignite();
$header->the_header( 'single' );

include_once CAHNRSIGNITEPATH . 'theme-parts/page-banners/class-page-banner-cahnrs-ignite.php';
$page_banner = new Page_Banner_CAHNRS_Ignite();
$page_banner->the_banner( 'news-releases' ); ?>
<style>
.news-release-article {
	padding: 25px;
	position: relative;
}
.news-release-article:nth-child(even) {
	background-color: #EFF0F1;
}
.news-release-article .image-wrapper {
	width: 400px;
}
.news-release-article .image {
	background-position: center;
	background-size: cover;
	padding-top: 75%;
}
.news-release-article:after{
	content: '';
	display: block;
	clear: both;
}
.news-release-article.has-image:nth-child(even) .image-wrapper {
	float: left;
}
.news-release-article.has-image:nth-child(even) .caption {
	margin-left: 420px;
}
.news-release-article.has-image:nth-child(odd) .image-wrapper {
	float: right;
}
.news-release-article.has-image:nth-child(odd) .caption {
	margin-right: 420px;
}
.news-release-article h2 {
	color: #981e32;
	font-size: 22px;
	line-height: 30px;
}
.news-release-article .article-date {
	display: block;
	text-transform: uppercase;
	font-size: 14px;
}
.news-release-article .article-author {
	display: block;
	font-size: 14px;
	margin-bottom: 16px;
}
.news-release-article .article-link {
	position: absolute;
	display: block;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	font-size: 0;
}
.news-release-article .article-link:hover {
	background-color: rgba(0,0,0,0.1);
}
.news-release-browse {
	padding: 25px;
	background-color: #EFF0F1;
	box-sizing: border-box;
	margin-bottom: 20px;
}
.news-release-browse .search-form {
	margin-right: 250px;
	position: relative;
}
.news-release-browse .search-form form {
	margin: 0;
	padding: 0;
}
.news-release-browse .search-form input[type=text] {
	height: 40px;
	line-height: 40px;
	text-indent: 8px;
	box-sizing: border-box;
	width: 100%;
}
.news-release-browse .search-form input[type=submit] {
	height: 40px;
	box-sizing: border-box;
	position: absolute;
	top: 0;
	right: 0;
	background-color: #981e32;
	color: #fff;
	padding: 0 25px;
	text-transform: uppercase;
}
.news-release-browse .year-form {
	float: right;
	width: 225px;
}
.news-release-browse .year-form select {
	height: 40px;
	box-sizing: border-box;
	max-width: 100%;
}
@media screen and (max-width: 900px) {
	.news-release-article.has-image:nth-child(even) .image-wrapper {
		float: left;
	}
	.news-release-article.has-image:nth-child(even) .caption {
		margin-left: 220px;
	}
	.news-release-article.has-image:nth-child(odd) .image-wrapper {
		float: right;
	}
	.news-release-article.has-image:nth-child(odd) .caption {
		margin-right: 220px;
	}
	.news-release-article .image-wrapper {
		width: 200px;
	}
}
@media screen and (max-width: 800px) {
	.news-release-browse .year-form {
    	float: none;
   		width: auto;
		margin-bottom: 20px;
	}
	.news-release-browse .search-form {
		margin-right: 0;
		position: relative;
	}
}
@media screen and (max-width: 650px) {
	.news-release-article.has-image:nth-child(even) .image-wrapper {
		float: none;
	}
	.news-release-article.has-image:nth-child(even) .caption {
		margin-left: 0;
	}
	.news-release-article.has-image:nth-child(odd) .image-wrapper {
		float: none;
	}
	.news-release-article.has-image:nth-child(odd) .caption {
		margin-right: 0;
	}
	.news-release-article .image-wrapper {
		width: auto;
		margin-bottom: 20px;
	}
}
</style>
<div id="site-content">
	
	<header>
         <h1><?php if ( is_month() ) echo get_the_time( 'F' ) . ' '; echo get_the_time( 'Y' ) . ' '; ?> CAHNRS News</h1>
    </header>
	<div class="news-release-browse">
		<div class="year-form">
			<select class="year-nav" onchange="document.location.href=this.options[this.selectedIndex].value;">
				<option value="">Browse Archives by Year</option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2017/"> 2017 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2016/"> 2016 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2015/"> 2015 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2014/"> 2014 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2013/"> 2013 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2012/"> 2012 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2011/"> 2011 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2010/"> 2010 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2009/"> 2009 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2008/"> 2008 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2007/"> 2007 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2006/"> 2006 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2005/"> 2005 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2004/"> 2004 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2003/"> 2003 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2002/"> 2002 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2001/"> 2001 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/2000/"> 2000 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/1999/"> 1999 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/1998/"> 1998 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/1997/"> 1997 </option>
				<option value="http://stage.cahnrs.wsu.edu/news-releases/1996/"> 1996 </option>
			</select>
		</div>
		<div class="search-form">
			<form id="searchform" action="http://stage.cahnrs.wsu.edu/" method="get">
				<input type="text" name="s" id="s" maxlength="150" value="" placeholder="Search News Release Archive">
				<input type="hidden" name="post_type" value="news-release">
				<input type="submit" value="Go">
			</form>
		</div>
		
		<script>jQuery('.year-nav').on('change', function(){ var url = jQuery( this ).val(); window.location = url; });</script>
	</div>
	
	<?php while( have_posts() ): the_post(); ?>
	<?php
	
	$post_img = false;
	
	$excerpt = get_the_excerpt();
	
	$excerpt = wp_trim_words( strip_tags( $excerpt ), $num_words = 35 );
	
	
	?>
    <article class="site-article news-release-article<?php if ( $post_img ) echo ' has-image';?>">
		<?php if ( $post_img ):?><div class="image-wrapper">
			<div class="image" style="background-image:url(<?php echo $post_img;?>)">
			</div>
		</div><?php endif;?>
        <div class="caption">
            <?php if ( $show_title != 'remove' ):?><h2 class="<?php if ( $show_title == 'hide' ) { echo ' hidden-element'; } ?>"><?php the_title()?></h2><?php endif ?>
			<div class="article-details">
						<time class="article-date" datetime="<?php the_date( 'c' ); ?>">Published On <?php echo get_the_date( 'F j, Y' ); ?></time>
						<cite class="article-author" role="author"><?php
            	if ( get_post_meta( get_the_ID(), 'By', true ) ) {
								echo 'By <span class="author-name">' . get_post_meta( get_the_ID(), 'By', true ) . '</span>';
							} else {
								if ( ( get_the_author_meta( 'user_level' ) != 0 ) && ( get_the_author_meta( 'title' ) != 'Retired' ) ) {
									echo 'By <span class="author-name">' . get_the_author() . '</span>';
									echo '<br />';
									if ( the_author_meta( 'phone' ) != '' )
										echo get_the_author_meta( 'phone' ) . ', ';
								} else {
									the_author();
								}
							}
						?></cite>
          	</div>
			<div class="article-summary">
				<?php echo $excerpt; ?>
			</div>
        </div>
		<a class="article-link" href="<?php echo get_the_permalink();?>"><?php the_title()?></a>
    </article>
    <?php endwhile;?>
</div>
<?php 
include_once CAHNRSIGNITEPATH . 'theme-parts/footers/class-footer-ignite.php';
$footer = new Footer_Ignite();
$footer->the_footer( 'single' );

include locate_template( 'includes/main/main-end.php', false );

get_footer();

$html = ob_get_clean();

echo apply_filters( 'cahnrs_ignite_page_html', $html );