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

		
		$html = $this->form_fields->text_field( $this->get_input_name('part_id') , $settings['part_id'] , 'Part ID:' );
		
		
		return array('Basic' => $html  );
		
	} // end form
	
	
	protected function clean( $settings ){
		
		$clean = array();
		
		$clean['part_id'] = ( ! empty( $settings['part_id'] ) )? sanitize_text_field( $settings['part_id'] ) : '';
		
		return $clean;
	}
	
	
} // end Theme_Part_Pagebuilder_Item_CAHNRS_Ignite