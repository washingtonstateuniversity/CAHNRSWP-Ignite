<?php

class Front_Page_Template_Ignite extends Template_Ignite {
	
	protected $template_slug = 'front-page';
	
	
	protected function render_template(){
		
		$this->the_wp_header();
		
		$this->the_content_main( 'start', array( 'front-page' ) );
		
		$this->the_header();
		
		$this->the_content( 'single-page' );
		
		$this->the_content_main( 'end' );
		
		$this->the_wp_footer();
		
	} // end get_the_template
	
	
} // end Front_Page_Template_Ignite

$front_page_template = new Front_Page_Template_Ignite();

$front_page_template->the_template();