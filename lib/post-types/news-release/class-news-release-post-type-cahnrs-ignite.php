<?php

class News_Release_Post_Type_CAHNRS_Ignite {
	
	
	public function __construct() {

		add_filter( 'template_include', array( $this,'templates' ), 1 );
		
		add_action( 'pre_get_posts', array( $this, 'set_per_page' ) );

	}
	
	public function set_per_page( $query ) {
		
		if ( is_post_type_archive( 'news-release' ) && is_date() && $query->is_main_query() && !is_admin() ) {
			
			$query->set( 'posts_per_page', -1 );
			
		}
		
	}
	
	public function templates( $template ) {

		if ( 'news-release' == get_post_type() ) {

			if ( is_search() ) {
				
				$template = locate_template( 'lib/post-types/news-release/templates/search.php', false );
				
			} else {
				
				$template = locate_template( 'lib/post-types/news-release/templates/single-news-release.php', false );
				
			} // End if

		}

		if ( is_post_type_archive( 'news-release' ) ) $template = locate_template( 'lib/post-types/news-release/templates/archive-news-release.php', false );

		if ( is_post_type_archive( 'news-release' ) && is_date() ) $template = locate_template( 'lib/post-types/news-release/templates/date-archive-news-release.php', false );

		return $template;

	}
	
}

$news_release_post_type = new News_Release_Post_Type_CAHNRS_Ignite();