<?php

class CAHNRS_Publications_Shortcode_Ignite {
	
	
	public $default_atts = array(
		'per_page' => 6,
		'display' => 'basic',
	);
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_shortcode' ) );
		
	} // End __construct
	
	
	public function register_shortcode(){
		
		add_shortcode( 'cahnrs_publications', array( $this, 'render_shortcode' ) );
		
	} // End register_shortcode
	
	
	public function render_shortcode( $atts, $content, $tag ){
		
		$html = '';
		
		$atts = shortcode_atts( $this->default_atts, $atts, $tag );
		
		$publications = $this->get_publicatons( $atts );
		
		$html .= '<div class="cahnrs-publications-shortcode display-' . $atts['display'] . '">';
		
		switch( $atts['display'] ) {
			
			default:
				$html .= $this->get_display_basic( $publications, $atts );
				break;
			
		} // End switch
		
		$html .= '</div>';
		
		return $html;
		
	} // End render_shortcode
	
	
	protected function get_publicatons( $atts ){
		
		$args = array(
			'post_type' => 'publications',
			'status' => 'publish',
			'posts_per_page' => ( ! empty( $atts['per_page'] ) ) ? $atts['per_page'] : 6,
			'display' => 'basic',
		);
		
		$publications = array();
		
		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) {

			while ( $the_query->have_posts() ) {
				
				$the_query->the_post();
				
				$publications[] = array(
					'title' 	=> get_the_title(),
					'link' 		=> get_post_meta( get_the_ID(), '_redirect_url', true ),
					'authors' 	=> get_post_meta( get_the_ID(), '_authors', true ),
					'journal' 	=> $this->get_journal( get_the_ID() ),
					'units' 	=> $this->get_units( get_the_ID() ), 
				);

			} // End while

			wp_reset_postdata();
			
		} // End if
		
		return $publications;
		
	} // End get_publicatons
	
	
	protected function get_journal( $pub_id ){
		
		$term = array();
		
		$terms = wp_get_post_terms( $pub_id, 'journals' );
		
		if ( ! empty( $terms ) ){
			
			$term['name'] = $terms[0]->name;
			
			$term['slug'] = $terms[0]->slug;
			
		} // End if
		
		return $term;
		
	} // End get_journal
	
	protected function get_units( $pub_id ){
		
		$depts = array();
		
		$terms = wp_get_post_terms( $pub_id, 'departments' );
		
		if ( ! empty( $terms ) ){
			
			foreach( $terms as $term ){
				
				$depts[] = array(
					'name' => $term->name,
					'slug' => $term->slug,
				);
			
			} // End if
			
		} // End if
		
		
		return $depts;
		
	} // End get_unit
	
	
	protected function get_display_basic( $publications, $atts ){
		
		$html = '';
		
		foreach( $publications as $publication ){
			
			$authors = ( ! empty( $publication['authors'] ) ) ? $publication['authors'] : array();
			
			$author_html = array();
			
			foreach( $authors as $author ){
				
				$auth = $author['name'];
				
				if ( ! empty( $author['email'] ) ){
					
					$auth = '<a href="mailto:' . $author['email'] . '">' . $auth . '</a>';
					
				} // end if
				
				if ( ! empty( $author['dept'] ) ){
					
					$auth .= ' (' . $author['dept'] . ')';
					
				} // end if
				
				$author_html[] = $auth;
				
			} // End foreach
			
			$author_html = implode( ', ', $author_html );
			
			ob_start();
			
			include locate_template( 'lib/shortcodes/cahnrs-publications/displays/basic.php', false );
			
			$html .= ob_get_clean();
			
		} // End foreach
		
		return $html;
		
	} // End get_display_basic
	
	
} // end Search_Shortcode_Ignite

$cahnrs_Publications_shortcode_ignite = new CAHNRS_Publications_Shortcode_Ignite();