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
		
		$html .= '<div id="site-content">';
		
		$html .= $this->get_content( $context, $args );
		
		$html .= '</div>';
		
		echo apply_filters( 'cahnrs_ignite_page_html', $html );
		
	} // End the_content
	
	
	protected function get_html_promo_list( $context, $args ){
		
		global $wp_query;
		
		ignite_load_class( 'classes/class-paginiation-cahnrs-ignite.php' );
		
		$pagination = new Pagination_CAHNRS_Ignite( max( 1, get_query_var('paged') ), get_query_var('posts_per_page'), $wp_query->found_posts );
		
		$html .= $pagination->get_pagination();
		
		if ( have_posts() ){
			
			while ( have_posts() ){
				
				the_post();
				
				$classes = array('ignite-display-promo-list-item');
				
				$image = ignite_get_post_image( get_the_ID(), 'medium' );
				
				$image = apply_filters('ignite-post-image', $image, get_the_ID(), get_post_type() );
				
				if ( $image ) $classes[] = 'has-image';
				
				if ( ! empty( $args['class'])) $classes[] = $args['class'];
				
				ob_start();
		
				include locate_template( 'theme-parts/content/displays/promo-list.php', false );

				$html .= ob_get_clean();
				
			}// End while
			
		}// End if
		
		$html .= $pagination->get_pagination( 'default', array('is_after' => true ) );	
		
		return $html;
		
	} // End get_college_global_footer
	
	
	protected function get_content( $context, $args ){
		
		$html = apply_filters( 'ignite_content_template', '', $context, $args );
		
		if ( empty( $html ) ){
			
			if ( is_archive() ){
				
				$html .= '<h1>' . $this->get_content_title( $context, $args ) . '</h1>';
				
				$html .= $this->get_search( 'archive' );
				
				$html .= $this->get_content_archive( $context, $args );
				
			} else {
				
				$html .= $this->get_html_promo_list( $context, $args );
				
			} // End if

			$html .= get_after_content_sidebar_ignite();
			
		} // End if
		
		return apply_filters( 'ignite_content_template_after', $html, $context, $args );
		
	} // End get_content
	
	
	protected function get_search( $class = '' ){
		
		ob_start();
		
		include ignite_get_theme_path( 'lib/parts/in-page-search/search.php' );
		
		$html = ob_get_clean();
		
		return $html;
		
	} // End get_search
	
	
	protected function get_content_archive( $context, $args ){
		
		$html = $this->get_html_promo_list( $context, $args );
		
		return $html;
		
	} // End get_content_archive
	
	
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