<?php

class Post_Formats_Ignite {
	
	
	public function __construct(){
		
		add_filter( 'the_content', array( $this, 'get_filtered_content'), 999 );
		
	} // End __construct
	
	
	public function get_filtered_content( $content ){
		
		if ( is_singular() ){
			
			global $post;
			
			remove_filter( 'the_content', array( $this, 'get_filtered_content'), 999 );
			
			if ( has_category( 'Scholarship Donor Profiles' ) ){
				
				$content = $this->get_scholarship_donor_profile( $content, $post );
				
			} // End if
			
		} // End if
		
		return $content;
		
	} // End get_filtered_content
	
	
	protected function get_scholarship_donor_profile( $content, $post ){
		
		$image = ignite_get_post_image( get_the_ID(), 'medium' );
		
		ob_start();
		
		include dirname(__FILE__) . '/scholarship-donor-profile/profile.php';
		
		$content = ob_get_clean();
		
		return $content;
		
	} // End get_donor_profile_content
	
	
} // End Post_Formats_Ignite

$post_formats_ignite = new Post_Formats_Ignite();