<?php

class CAHNRS_Events_Shortcode_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_shortcode' ) );
		
	} // End __construct
	
	
	public function register_shortcode(){
		
		add_shortcode( 'cahnrs_events', array( $this, 'render_shortcode' ) );
		
	} // End register_shortcode
	
	
	public function render_shortcode( $atts, $content, $tag ){
		
		$html = '';
		
		$default_atts = array(
			'display' => 'basic',
			'per_page' => 3,
			'show_venue' => 1,
		);
		
		$atts = shortcode_atts( $default_atts, $atts, $tag );
		
		if ( ! empty( $atts['per_page'] ) ) $atts['posts_per_page'] =  $atts['per_page'];
		
		$events = $this->get_events( $atts, $tag );
		
		switch( $atts['display'] ){
			
			case 'basic':
			default:
				$html .= $this->get_display_basic( $events, $atts );
				break;
			
		} // End switch
		
		return $html;
		
	} // End render_shortcode
	
	
	protected function get_events( $atts, $tag ){
		
		$args = array(
			'start_date'     => date( 'Y-m-d H:i:s' ),
			'eventDisplay'   => 'custom',
			'posts_per_page' => 3,
		);
		
		$args = array_merge( $args, $atts );
		
		$events = tribe_get_events( $args );
		
		foreach( $events as $key => $event ){
			
			$events[ $key ]->start_date = strtotime( tribe_get_start_date( $event->ID ) ); 
			
		} // End foreach
		
		return $events; 
		
	} // End get_events
	
	
	protected function get_display_basic( $events, $atts ){
		
		$html = ''; 
		
		ob_start();
		
		include locate_template( 'lib/shortcodes/cahnrs-events/displays/basic.php', false );
		
		$html .= ob_get_clean();
		
		return $html;
		
	} // End get_display_basic
	
	
} // end CAHNRS_Events_Shortcode_Ignite

$cahnrs_events_shortcode_ignite = new CAHNRS_Events_Shortcode_Ignite();