<?php

class Customizer_Multi_Select_Control_Ignite extends WP_Customize_Control {
	
	public $type = 'multi-select-ignite';
	
	public function render_content(){
		
		if ( empty( $this->choices ) ) return;
		
		$cvalue = sanitize_text_field( $this->value() );
		
		$values = explode(',', $cvalue );
		
		$html .= '<div class="ignite-customizer-dropdown">';
		
			$html .= '<ul>';

			foreach ( $this->choices as $value => $label ) {
				
				$checked = ( in_array( $value, $values ) )? ' checked="checked"' : '';
				
				$name = 'ignite-slide-categories-' . $value;

				$html .= '<li>';

				$html .= '<input class="ignite-slide-categories-value" id="' . $name . '" type="checkbox" value="' . $value . '" name="' . $name . '" ' . $checked . '/><label for="' . $name . '">' . $label . '</label>';
				
				$html .= '</il>';

			} // End Foreac

			$html .= '</ul>';
		
		$html .= '<input type="text" id="' . $this->id . '" class="ignite-slide-categories" ' . $this->link . ' value="' . $cvalue . '">';
		
		$html .= '</div>';
		
		ob_start();
		
		include 'script.js';
		
		$html .= '<script>' . ob_get_clean() . '</script>';
		
		echo $html . test;
		
	} // End render_content
	
	
} // End Customizer_Multi_Select_Control_Ignite