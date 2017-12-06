<?php

class Theme_Part_Pagebuilder_Item_CAHNRS_Ignite  extends CPB_Item {
	
	protected $name = 'Theme Part';
	
	protected $slug = 'cahnrs_theme_part';
	
	protected $form_size = 'small';
	
	
	public function item( $settings , $content ){
		
		$html = '';
		
		return $html;
		
	}// end item
	
	
	public function form( $settings , $content ){
		
		$args = array(
			'posts_per_page'   => -1,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'theme_part',
			'post_status'      => 'publish',
		);
		
		$post_options = array();
		
		$posts_array = get_posts( $args );
		
		foreach( $posts_array as $tp_post ){
			
			$post_options[ $tp_post->ID ] = $tp_post->post_title;
			
		} // End foreach
		
		$html = $this->form_fields->select_field( $this->get_input_name('part_id'), $settings['part_id'], $post_options, 'Theme Part' );

		
		//$html = $this->form_fields->text_field( $this->get_input_name('part_id') , $settings['part_id'] , 'Part ID:' );
		
		
		return array('Basic' => $html  );
		
	} // end form
	
	
	protected function clean( $settings ){
		
		$clean = array();
		
		$clean['part_id'] = ( ! empty( $settings['part_id'] ) )? sanitize_text_field( $settings['part_id'] ) : '';
		
		return $clean;
	}
	
	
} // end Theme_Part_Pagebuilder_Item_CAHNRS_Ignite