<?php

class CAHNRS_Posts_Shortcode_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_shortcode' ) );
		
	} // End __construct
	
	
	public function register_shortcode(){
		
		add_shortcode( 'cahnrs_posts', array( $this, 'render_shortcode' ) );
		
	} // End register_shortcode
	
	
	public function render_shortcode( $atts, $content, $tag ){
		
		$html = '';
		
		$shortcode_atts = $atts;
		
		//$inner_html = '';
		
		$default_atts = array(
			'post_type'					=> 'post',
			'per_page' 					=> 5,
			'show_images' 				=> 1,
			'show_title' 				=> 1,
			'show_date'					=> 1,
			'do_link' 					=> 1,
			'display' 					=> 'promo-list',
			'tags'						=> '',
			'page'						=> 1,
			'categories' 				=> '',
			'excerpt_length'			=> 25,
			'order_by'					=> 'date',
			'offset'					=> 0,
			'category_relation' 		=> 'IN',
			'tag_relation' 				=> 'IN',
			'order' 					=> 'ASC',
			'exclude'					=> '',
			'meta_relation' 			=> 'OR',
			'keyword'					=> '',
			'show_pagination'			=> 1,
			'show_pagination_after'		=> 1,
			'is_ajax'					=> 0,
			'allow_paged'				=> 1,
		);
		
		$atts = shortcode_atts( $default_atts, $atts, $tag );
		
		$query_args = $this->get_query_args( $atts );
		
		$html .= '<div class="cahnrs-posts-shortcode">';
		
		switch( $atts['display'] ){
			
			default:
			$html .= $this->get_default_display( $query_args, $atts );
			
				break;
				
		} // End switch
		
		$html .= '</div>';
		
		return $html;
		
	} // End render_shortcode
	
	
	protected function get_default_display( $query_args, $atts ){
		
		$the_query = new WP_Query( $query_args );
		
		ignite_load_class( 'classes/class-paginiation-cahnrs-ignite.php' );
		
		$page = ( ! empty( $query_args['paged'] ) ) ? $query_args['paged'] : 1;
		
		$pagination = new Pagination_CAHNRS_Ignite( $page, $query_args['posts_per_page'], $the_query->found_posts );
		
		$html = '';
		
		if ( $atts['show_pagination'] && $atts['allow_paged'] ) {
		
			$html .= $pagination->get_pagination( 'default', array('is_shortcode' => true ) );
			
		} // End if
	 
		if ( $the_query->have_posts() ){
			
			while ( $the_query->have_posts() ){
				
				$the_query->the_post();
				
				$classes = array('ignite-display-promo-list-item');
				
				$image = ignite_get_post_image( get_the_ID(), 'medium' );
				
				if ( $image ) $classes[] = 'has-image';
				
				if ( ! empty( $args['class'])) $classes[] = $args['class'];
				
				ob_start();
		
				include locate_template( 'lib/displays/promo-list-loop.php', false );

				$html .= ob_get_clean();
				
			}// End while
			
			if ( $atts['show_pagination'] &&  $atts['show_pagination_after'] && $atts['allow_paged'] ) {
		
				$html .= $pagination->get_pagination( 'default', array('is_shortcode' => true, 'is_after' => true ) );

			} // End if
			
			wp_reset_postdata();
			
		}// End if
		
		return $html;
		
	} // End get_default_display
	
	
	protected function get_query_args( $atts ){
		
		ignite_load_class('classes/class-query-posts-cahnrs-ignite.php');
		
		$ignite_query = new Query_Posts_CAHNRS_Ignite( $atts );
		
		$query_args = $ignite_query->get_query_args();
		
		return $query_args;
	
	} // End get_query_args_set
	
	
} // end CAHNRS_Posts_Shortcode_Ignite

$cahnrs_Posts_shortcode_ignite = new CAHNRS_Posts_Shortcode_Ignite();