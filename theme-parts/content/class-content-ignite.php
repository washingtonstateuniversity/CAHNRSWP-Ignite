<?php

class Content_Ignite extends Theme_Part_Ignite {
	
	protected $default_args = array(
		'display' => 'promo-list',
	);
	
	protected $settings = array();
	
	
	public function the_content( $context = 'single', $args = array() ){
		
		$html = '';
		
		if ( is_active_sidebar( 'content_before' ) ) {
			
			ob_start();
			
			dynamic_sidebar( 'content_before' );
			
			$html .= '<div id="content-before-widget-area">' . ob_get_clean() .'</div>';
			
		} // End if
		
		$args = $this->get_customizer_args( $args );
		
		switch( $args['type'] ){
			
			case 'promo-list':
			default:
				$html .= $this->get_html_promo_list( $context, $args );
				break;
			
		} // End switch
		
		if ( is_active_sidebar( 'content_after' ) ) {
			
			ob_start();
			
			dynamic_sidebar( 'content_after' );
			
			$html .= '<div id="content-after-widget-area">' . ob_get_clean() .'</div>';
			
		} // End if
		
		echo $html;
		
	} // End the_content
	
	
	protected function get_html_promo_list( $context, $args ){
		
		global $wp_query;
		
		$html = '<div id="site-content">';
		
		$html .= '<h1>' . $this->get_content_title( $context, $args ) . '</h1>';
		
		ignite_load_class( 'classes/class-paginiation-cahnrs-ignite.php' );
		
		$pagination = new Pagination_CAHNRS_Ignite( max( 1, get_query_var('paged') ), get_query_var('posts_per_page'), $wp_query->found_posts );
		
		$html .= $pagination->get_pagination();
		
		if ( have_posts() ){
			
			while ( have_posts() ){
				
				the_post();
				
				$classes = array('ignite-display-promo-list-item');
				
				$image = ignite_get_post_image( get_the_ID(), 'medium' );
				
				if ( $image ) $classes[] = 'has-image';
				
				if ( ! empty( $args['class'])) $classes[] = $args['class'];
				
				ob_start();
		
				include locate_template( 'theme-parts/content/displays/promo-list.php', false );

				$html .= ob_get_clean();
				
			}// End while
			
		}// End if
		
		$html .= $pagination->get_pagination( 'default', array('is_after' => true ) );	
		
		$html .= '</div>';
		
		return $html;
		
	} // End get_college_global_footer
	
	
	protected function get_content_title( $context, $args ){
		
		$title = '';
		
		
		if ( is_archive() ){
			
			$title = get_the_archive_title();
			
			//$title = post_type_archive_title( '', false );
			
		} // End if
		
		return $title;
	
	} // End get_content_title
	
	
	protected function get_recent_posts(){
		
		
		
		
	}
	
} // End Content_Ignite