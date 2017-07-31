<?php

ob_start();

include locate_template( 'includes/headers/header.php', false );

include locate_template( 'includes/main/main-start.php', false );

include_once CAHNRSIGNITEPATH . 'theme-parts/headers/class-header-ignite.php';
$header = new Header_Ignite();
$header->the_header( 'single' );

include_once CAHNRSIGNITEPATH . 'theme-parts/page-banners/class-page-banner-cahnrs-ignite.php';
$page_banner = new Page_Banner_CAHNRS_Ignite();
$page_banner->the_banner( 'single' ); ?>
<div id="site-content">
	<?php while( have_posts() ): the_post();
	
	do_action( 'before_page_content_ignite', $post );
    
    $show_title = get_post_meta( get_the_ID(), '_show_title_single_ignite', true );
    
    if ( empty( $show_title ) || ( $show_title == 'default' ) ){
        
        $show_title = get_theme_mod( '_show_single_title_ignite', 'default' );
        
    } // end if
    
    $show_title = apply_filters( 'show_title_ignite', $show_title, $post );
    
    ?>
    <article class="site-article">
        <header>
            <?php if ( $show_title != 'remove' ):?><h1 class="<?php if ( $show_title == 'hide' ) { echo ' hidden-element'; } ?>"><?php the_title()?></h1><?php endif ?>
			<hgroup class="source">
						<time class="article-date" datetime="<?php the_date( 'c' ); ?>">Published On <?php echo get_the_date( 'F j, Y' ); ?></time>
						<cite class="article-author" role="author"><?php
            	if ( get_post_meta( get_the_ID(), 'By', true ) ) {
								echo get_post_meta( get_the_ID(), 'By', true );
							} else {
								if ( ( get_the_author_meta( 'user_level' ) != 0 ) && ( get_the_author_meta( 'title' ) != 'Retired' ) ) {
									echo '<a href="mailto:' . get_the_author_meta( 'user_email' ) . '">' . get_the_author() . '</a>';
									echo '<br />';
									if ( the_author_meta( 'phone' ) != '' )
										echo get_the_author_meta( 'phone' ) . ', ';
								} else {
									the_author();
								}
							}
						?></cite>
          </hgroup>
        </header>
        <div class="article-content">
             <?php the_content() ?>
        </div>
        <footer>
		 <?php // Sources
							$sources = get_post_meta( get_the_ID(), '_sources', true );
					
							if( $sources ) :
					
								echo '<p class="source-contact">Source Contact'; if ( $sources['name_2'] ) echo 's'; echo '</p>';
	
								//echo '<blockquote class="sources">';
	
								// Here comes the horribly inelegant part...
								if ( $sources['name_1'] ) {
									echo '<p>' . $sources['name_1'];
									if ( $sources['info_1'] ) echo '<br />' . $sources['info_1'];
									echo '</p>';
								}
					
								if ( $sources['name_2'] ) {
									echo '<p>' . $sources['name_2'];
									if ( $sources['info_2'] ) echo '<br />' . $sources['info_2'];
									echo '</p>';
								}
					
								if ( $sources['name_3'] ) {
									echo '<p>' . $sources['name_3'];
									if ( $sources['info_3'] ) echo '<br />' . $sources['info_3'];
									echo '</p>';
								}
					
								if ( $sources['name_4'] ) {
									echo '<p>' . $sources['name_4'];
									if ( $sources['info_4'] ) echo '<br />' . $sources['info_4'];
									echo '</p>';
								}
					
								if ( $sources['name_5'] ) {
									echo '<p>' . $sources['name_5'];
									if ( $sources['info_5'] ) echo '<br />' . $sources['info_5'];
									echo '</p>';
								}

								//echo '</blockquote>';

							endif;
						?>
		</footer>
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