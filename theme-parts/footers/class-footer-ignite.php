<?php

class Footer_Ignite extends Theme_Part_Ignite {
	
	protected $default_args = array(
		'type' => '',
	);
	
	protected $settings = array(
		'type' => '_cahnrswp_footer_type'
	);
	
	public function the_footer( $context = 'single', $args = array() ){
		
		include locate_template( 'includes/widget-areas/footer-after-widget-area.php', false );
		
		$html = '';
		
		$args = $this->get_customizer_args( $args );
		
		switch( $args['type'] ){
			
			case 'college-global':
				$html = $this->get_college_global_footer( $context, $args );
				break;
			
		} // End switch
		
		echo $html;
		
	} // End get_footer
	
	
	protected function get_college_global_footer( $context, $args ){
		
		ob_start();
		
		include locate_template( 'includes/footers/college-footer/footer.php', false );
		
		return ob_get_clean();
		
	} // End get_college_global_footer
	
} // End Footer_Ignite