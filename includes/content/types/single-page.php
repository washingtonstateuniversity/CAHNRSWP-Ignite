<?php while( have_posts() ): the_post();

$show_title = get_post_meta( get_the_ID(), '_show_title_single_ignite', true );
$show_title = apply_filters( 'show_title_ignite', $show_title, $post );

?>
<article class="site-article">
    <header>
    	<?php if ( empty( $show_title ) || $show_title == 'show' ):?><h1><?php the_title()?></h1><?php endif ?>
    </header>
    <div class="article-content">
    	 <?php the_content() ?>
    </div>
    <footer></footer>
</article>
<?php endwhile;?>