<article class="site-article">
	<?php if ( empty( $settings['_show_title_single_ignite'] ) || $settings['_show_title_single_ignite'] == 'show'  ):?>
    <header>
    	<h1><?php the_title()?></h1>
    </header>
	<?php endif ?>
    <?php if ( empty( $settings['_show_content_single_ignite'] ) || $settings['_show_content_single_ignite'] == 'show'  ):?>
    <div class="article-content">
    	 <?php the_content() ?>
    </div>
    <?php endif ?>
    <footer></footer>
</article>