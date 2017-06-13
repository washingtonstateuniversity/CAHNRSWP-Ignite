<div id="site-content">
	<?php while( have_posts() ): the_post();
    
    $show_title = get_post_meta( get_the_ID(), '_show_title_single_ignite', true );
    
    if ( empty( $show_title ) || ( $show_title == 'default' ) ){
        
        $show_title = get_theme_mod( '_show_page_title_ignite', 'default' );
        
    } // end if
    
    $show_title = apply_filters( 'show_title_ignite', $show_title, $post );
    
    ?>
    <article class="site-article">
        <header>
            <?php if ( $show_title != 'remove' ):?><h1 class="<?php if ( $show_title == 'hide' ) { echo ' hidden-element'; } ?>"><?php the_title()?></h1><?php endif ?>
        </header>
        <div class="article-content">
             <?php the_content() ?>
        </div>
        <footer></footer>
    </article>
    <?php endwhile;?>
</div>