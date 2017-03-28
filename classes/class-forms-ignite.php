<?php
/**
 * This class is for form generation and stores some 
 * general use field options such as color sets
**/
class Forms_Ignite {
	
	private $colors = array(
		'#981e32' => 'Crimson', 
		'#c60c30' => 'Crimson-er',
		'#000000' => 'Black',
		'#ffffff' => 'White', 
		'#717171' => 'Gray', 
		'#8d959a' => 'Gray Light', 
		'#b5babe' => 'Gray Lighter', 
		'#d7dadb' => 'Gray Lightly', 
		'#eff0f1' => 'Gray Lightest', 
		'#3b4042' => 'Gray Dark', 
		'#2a3033' => 'Gray Darker', 
		'#b67233' => 'Orange', 
		'#f6861f' => 'Orange-er', 
		'#cb9b6e' => 'Orange Light', 
		'#ddbea1' => 'Orange Lighter', 
		'#eddccc' => 'Orange Lightly', 
		'#f8f1eb' => 'Orange Lightest', 
		'#925b29' => 'Orange Dark', 
		'#6d441f' => 'Orange Darker', 
		'#492e14' => 'Orange Darkest', 
		'#8f7e35' => 'Green', 
		'#ada400' => 'Green-er', 
		'#afa370' => 'Green Light', 
		'#cbc4a2' => 'Green Lighter', 
		'#e3dfcd' => 'Green Lightly', 
		'#f4f2eb' => 'Green Lightest', 
		'#72652a' => 'Green Dark', 
		'#564c20' => 'Green Darker', 
		'#393215' => 'Green Darkest', 
		'#4f868e' => 'Blue', 
		'#00a5bd' => 'Blue-er', 
		'#82a9af' => 'Blue Light', 
		'#aec7cb' => 'Blue Lighter', 
		'#d3e1e3' => 'Blue Lightly', 
		'#edf3f4' => 'Blue Lightest', 
		'#3f6b72' => 'Blue Dark', 
		'#2f5055' => 'Blue Darker', 
		'#203639' => 'Blue Darkest', 
		'#c69214' => 'Yellow', 
		'#ffb81c' => 'Yellow-er', 
		'#d7b258' => 'Yellow Light', 
		'#e5cd93' => 'Yellow Lighter', 
		'#f1e4c4' => 'Yellow Lightly', 
		'#f9f4e7' => 'Yellow Lightest', 
		'#9e7510' => 'Yellow Dark', 
		'#77580c' => 'Yellow Darker', 
		'#4f3a08' => 'Yellow Darkest',
	);
	
	/**
	 * @param string $context Where the colors will be used. Helpfull to give additional context to filters
	 * @return array WSU color set for filtered by context if provided
	**/
	public function get_colors( $context = 'general', $add_default = true, $add_none = true, $none_value = 'transparent' ) {
		
		$colors =  $this->colors;
		
		if ( $add_none ){ // and default option
			
			$colors = array_merge( array( $none_value => 'None' ), $colors );
			
		} // end if
		
		if ( $add_default ){ // and default option
			
			$colors = array_merge( array( 'default' => 'Not Set' ), $colors );
			
		} // end if
	
		return apply_filters( 'cahnrswp_colors', $colors, $context );
	
	} // end get_colors
	
	/**
	 * Method to create tabbed forms
	 * @param array $tab_set Assoc. array with Tab Title => Tab HTML
	 * @return string Tab section HTML
	**/
	public function get_tabs( $tab_set ){
		
		ob_start();
		
		include CAHNRSIGNITEPATH . 'includes/forms/tabs.php';
		
		return ob_get_clean();
		
	} // end get_tabs
	
	
	public function get_select_field( $name, $label, $value, $options, $do_wrap = true, $class = '' ){
		
		$html = '';
		
		if ( $label ) $html .= '<label>' . $label . '</label>';
		
		$html .= '<select name="' . $name . '">';
		
		foreach( $options as $option_label => $option_value ){
			
			$html .= '<option value="' . $option_value . '" ' . selected( $option_value, $value, false ) . '>' . $option_label . '</option>'; 
			
		} // end foreach
		
		$html .= '</select>';
		
		if ( $do_wrap ) {
			
			$html = $this->get_field_wrap( $html, $class );
			
		} // end if
		
		return $html;
		
	} // end get_select_field
	
	
	public function get_field_wrap( $field, $class ){
		
		$html = '<div class="field-ignite ' . $class . '">' . $field . '</div>';
		
		return $html;
		
	} // end get_field_wrap
	
} // end Forms_CAHNRSWP_Spine_Child