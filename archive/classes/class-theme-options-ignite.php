<?php
/**
 * This class is meant to encapsulate the getting and setting of
 * theme options in the customizer and relevant settings pages
 * Adds Customizer
 * Adds CSS to wp_head
 * Adds classes to body_class
**/
class Theme_Options_Ignite {
	
	// @var instance of Forms_CAHNRSWP_Spine_Child
	protected $forms;
	
	
	public function __construct( $forms ){
		
		$this->forms = $forms;
		
	} // end __construct
	
	/**
	 * This method is called on initialization of the theme. Use it for 
	 * related actions and filters
	**/
	public function init(){
		
		// Sets enable spine builder or not
		add_filter( 'spine_enable_builder_module', array( $this , 'spine_enable_builder_module' ) );
		
		// Add customizer panels and etc....
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		
		// Add style settings from customizer
		add_action( 'wp_head', array( $this, 'wp_head'), 98 );
		
		add_filter( 'body_class', array( $this, 'filter_body_class' ) ); 
		
	} // end init
	
	
	/**
	 * Add CSS property to css array
	 * 
	 * @param array $css_array Array to add property to
	 * @param string $selector CSS selector
	 * @param string $property_name CSS property name ie: 'color'
	 * @param string $property_value CSS property value ie: '#fff'
	 * @param bool $check_property Check if empty, false or has 'default' as value - If so do not add. 
	 * @return array CSS array with property added
	**/
	protected function add_css_property( $css_array, $selector, $property_name, $property_value, $check_property = true ){
		
		// Check and make sure there is a value to add
		if ( $check_property && ! $this->is_set( $property_value ) ){
			
			return $css_array;
			
		} // end if
		
		// Check if selector exists - if not add as empty array
		if ( ! array_key_exists( $selector, $css_array ) ){
			
			$css_array[ $selector ] = array();
			
		} // end if
		
		$css_array[ $selector ][] = $property_name . ':' . $property_value;
		
		return $css_array;
		
	} // end add_css_property
	
	/**
	 * @return array style for theme header
	**/
	private function add_header_css( $css_array ){
		
		$cahnrswp_header_bg_color = get_theme_mod( '_cahnrswp_header_bg_color', '' );
		$cahnrswp_header_bg_image_size = get_theme_mod( '_cahnrswp_header_bg_image_size', '' );
		$cahnrswp_header_bg_image_position = get_theme_mod( '_cahnrswp_header_bg_image_position', '' );
		$cahnrswp_header_bg_image = get_theme_mod( '_cahnrswp_header_bg_image', '' );
		$college_global_nav_bg_color = get_theme_mod( '_cahnrswp_header_college_global_nav_bg_color', '' );
		$college_global_nav_text_color = get_theme_mod( '_cahnrswp_header_college_global_nav_text_color', '' );
		$cahnrswp_header_banner_text_color = get_theme_mod( '_cahnrswp_header_banner_text_color', '' ); 
		$cahnrswp_header_horizontal_nav_text_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_text_color', '' );
		$cahnrswp_header_horizontal_nav_bg_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_bg_color', '' );
		$cahnrswp_header_horizontal_nav_link_active_text_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_link_active_text_color', '' );
		$cahnrswp_header_horizontal_nav_link_active_bg_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_link_active_bg_color', '' );
		$cahnrswp_header_horizontal_nav_link_hover_text_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_link_hover_text_color', '' );
		$cahnrswp_header_horizontal_nav_link_hover_bg_color = get_theme_mod( '_cahnrswp_header_horizontal_nav_link_hover_bg_color', '' );
		
		$css_array = $this->add_css_property( $css_array, '#site-header', 'background-image', 'url(' . $cahnrswp_header_bg_image . ')' );
		
		$css_array = $this->add_css_property( $css_array, '#site-header', 'background-color', $cahnrswp_header_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#site-header:before', 'background-color', $cahnrswp_header_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#site-header:after', 'background-color', $cahnrswp_header_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#site-header', 'background-size', $cahnrswp_header_bg_image_size );
		
		$css_array = $this->add_css_property( $css_array, '#site-header', 'background-position', $cahnrswp_header_bg_image_position );
		
		$css_array = $this->add_css_property( $css_array, '#college-global-header', 'background-color', $college_global_nav_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-global-header:before', 'background-color', $college_global_nav_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-global-header:after', 'background-color', $college_global_nav_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-global-nav > ul > li > a.active:after', 'border-top-color', $college_global_nav_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-global-header', 'color', $college_global_nav_text_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-global-actions a:before', 'background-color', $college_global_nav_text_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-banner .site-logo-text span a', 'color', $cahnrswp_header_banner_text_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu ul.menu > li > a', 'color', $cahnrswp_header_horizontal_nav_text_color );	
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu.has-dividers ul.menu > li > a:after', 'background-color', $cahnrswp_header_horizontal_nav_text_color );	
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu', 'background-color', $cahnrswp_header_horizontal_nav_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu', 'background-color', $cahnrswp_header_horizontal_nav_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu:before', 'background-color', $cahnrswp_header_horizontal_nav_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu:after', 'background-color', $cahnrswp_header_horizontal_nav_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu ul.menu > li.current-menu-item > a', 'color', $cahnrswp_header_horizontal_nav_link_active_text_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu ul.menu > li.current-menu-parent > a', 'color', $cahnrswp_header_horizontal_nav_link_active_text_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu ul.menu > li.current-menu-item > a', 'background-color', $cahnrswp_header_horizontal_nav_link_active_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu ul.menu > li.current-menu-parent > a', 'background-color', $cahnrswp_header_horizontal_nav_link_active_bg_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu ul.menu > li:hover > a', 'color', $cahnrswp_header_horizontal_nav_link_hover_text_color );
		
		$css_array = $this->add_css_property( $css_array, '#college-header-horiz-menu ul.menu > li:hover > a', 'background-color', $cahnrswp_header_horizontal_nav_link_hover_bg_color );
		
		return $css_array;
		
	} // end get_header_css
	
	
	private function add_theme_css( $css_array ){
		
		$cahnrswp_theme_bg_color = get_theme_mod( '_cahnrswp_theme_bg_color', '#fff' );
		
		$css_array = $this->add_css_property( $css_array, 'html', 'background-color', $cahnrswp_theme_bg_color );
		
		$css_array = $this->add_css_property( $css_array, 'body', 'background-color', $cahnrswp_theme_bg_color );
		
		$css_array = $this->add_css_property( $css_array, 'body:not(.has-background-image)', 'background-color', $cahnrswp_theme_bg_color ); // needed to override spine
		
		$css_array = $this->add_css_property( $css_array, '#site-content', 'background-color', $cahnrswp_theme_bg_color ); // needed to override spine
		
		$css_array = $this->add_css_property( $css_array, '#site-content:before', 'background-color', $cahnrswp_theme_bg_color ); // needed to override spine
		
		$css_array = $this->add_css_property( $css_array, '#site-content:after', 'background-color', $cahnrswp_theme_bg_color ); // needed to override spine
		
		
		return $css_array;
		
	} // end add_theme_css
	
	/**
	 * Convert css array to string
	 * @param array $css Key ( css selector ) => array of properties ( color:#ffff )
	 * @return string css
	**/
	protected function css_to_string( $css ){
		
		$style = '';
		
		foreach( $css as $selector => $values ){
			
			// check for values before doing anything
			if ( ! empty( $values ) ){
				
				$style_values = implode( '; ', $values );
				
				$style .= $selector . ' {' . $style_values . '} ';
				
			} // end if
			
		} // end foreach
		
		return $style;
		
	} // end css_to_string
	
	
	/**
	 * Adds panels and etc... to customizer
	**/
	public function customize_register( $wp_customize ){
		
		$panel = 'cahnrs_spine_child';
		
		// Too many settings for just a section, adding a panel
		$wp_customize->add_panel( 
			$panel, 
			array(
		 		'priority'       => 10,
		 		'capability'     => 'edit_theme_options',
		  		'theme_supports' => '',
		  		'title'          => 'CAHNRS Theme Options',
		  		'description'    => 'CAHNRS Theme Settings',
			) 
		); // end add_panel
		
		// Splitting out sections for cleaner code
		
		$this->customize_theme( $wp_customize, $panel );
		
		$this->customize_layout_options( $wp_customize, $panel );
		
		$this->customize_header( $wp_customize, $panel );
		
		$this->customize_footer( $wp_customize, $panel );
		
	} // end customize_register 
	
	
	private function customize_header( $wp_customize, $panel ){
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_bg_color', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_bg_image', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_bg_image_size', 
			array(
				'default'   => 'default',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_bg_image_position', 
			array(
				'default'   => 'default',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_show_college_global', 
			array(
				'default'   => 1,
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_college_global_nav_bg_color', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_college_global_nav_text_color', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_display_banner', 
			array(
				'default'   => 1,
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_banner_text_color', 
			array(
				'default'   => 'default',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_banner_img', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_horizontal_nav', 
			array(
				'default'   => 0,
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_horizontal_nav_text_color', 
			array(
				'default'   => 'default',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_horizontal_nav_bg_color', 
			array(
				'default'   => 'default',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_horizontal_nav_link_active_text_color', 
			array(
				'default'   => 'default',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_horizontal_nav_link_active_bg_color', 
			array(
				'default'   => 'default',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_horizontal_nav_link_hover_text_color', 
			array(
				'default'   => 'default',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_horizontal_nav_link_hover_bg_color', 
			array(
				'default'   => 'default',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_horizontal_nav_show_divider', 
			array(
				'default'   => 0,
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		// Add section
		
		$section_id = '_cahnrswp_header_options';
		
		$wp_customize->add_section( 
			$section_id, 
			array(
				'title'    	=> 'Header',
				'panel' 	=> $panel,
			)
		); // end add_section
		
		// Add Controls
		
		$wp_customize->add_control(
			'_cahnrswp_header_bg_color_control', 
			array(
				'label'    => 'Header Background Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_bg_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_header_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'_cahnrswp_header_bg_image_control',
			   	array(
				   	'label'      => 'Header Background Image',
				   	'section'    => $section_id,
				   	'settings'   => '_cahnrswp_header_bg_image', 
			   	)
		   	)
	   	);
		
		$wp_customize->add_control(
			'_cahnrswp_header_bg_image_size_control', 
			array(
				'label'    => 'Header Background Image Size',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_bg_image_size',
				'type'     => 'select',
				'choices'  => array(
					'default' 	=> 'Not Set',
					'cover' 	=> 'Cover',
					'contain' 	=> 'Contain',
					'auto' 		=> 'Auto',
					'auto 100%'	=> 'Auto 100%',
					'100% auto'	=> '100% Auto',
					'100% 100%' => '100% 100%',
					'auto 90%'	=> 'Auto 90%',
					'90% auto'	=> '90% Auto',
					'90% 90%' 	=> '90% 90%',  
				),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_bg_image_position_control', 
			array(
				'label'    => 'Header Background Image Position',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_bg_image_position',
				'type'     => 'select',
				'choices'  => array(
					'default' 			=> 'Not Set',
					'center' 			=> 'Center',
					'left top' 			=> 'Left Top',
					'left center' 		=> 'Left Center',
					'left bottom' 		=> 'Left Bottom',
					'right top' 		=> 'Right Top',
					'right center' 		=> 'Right Center',
					'right bottom' 		=> 'Right Bottom',
					'center top' 		=> 'Center Top',
					'center bottom' 	=> 'Center Bottom',
				),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_show_college_global_control', 
			array(
				'label'    => 'Display College Global Nav',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_show_college_global',
				'type'     => 'checkbox',
			)
		); // end control
		
		$colors = $this->forms->get_colors('header');
		
		$wp_customize->add_control(
			'_cahnrswp_header_college_global_nav_bg_color_control', 
			array(
				'label'    => 'College Nav Background Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_college_global_nav_bg_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_header_college_global_nav_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_college_global_nav_text_color_control', 
			array(
				'label'    => 'College Nav Text Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_college_global_nav_text_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_header_college_global_nav_text_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_display_banner_control', 
			array(
				'label'    => 'Display Banner',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_display_banner',
				'type'     => 'checkbox',
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_banner_text_color_control', 
			array(
				'label'    => 'Banner Text Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_banner_text_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_header_banner_text_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'_cahnrswp_header_banner_img_control',
			   	array(
				   	'label'      => 'Banner Image',
				   	'section'    => $section_id,
				   	'settings'   => '_cahnrswp_header_banner_img', 
			   	)
		   	)
	   	);
		
		$menu_objs = get_terms('nav_menu');
		
		$menus = array( 0 => 'No Menu' );
		
		foreach( $menu_objs as $menu ){
			
			$menus[ $menu->term_id ] = $menu->name;
			
		} // end foreach
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_control', 
			array(
				'label'    => 'Horizontal Menu',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav',
				'type'     => 'select',
				'choices'  => $menus,
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_text_color_control', 
			array(
				'label'    => 'Horizontal Nav Text Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_text_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_header_horizontal_nav_text_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_bg_color_control', 
			array(
				'label'    => 'Horizontal Nav Bg Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_bg_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_header_horizontal_nav_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_link_active_bg_color', 
			array(
				'label'    => 'Horiz. Nav Active Link Bg Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_link_active_bg_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_header_horizontal_nav_link_active_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_link_active_text_color', 
			array(
				'label'    => 'Horiz. Nav Active Link Text Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_link_active_text_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_header_horizontal_nav_link_active_text_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_link_hover_bg_color', 
			array(
				'label'    => 'Horiz. Nav Hover Link Bg Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_link_hover_bg_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_header_horizontal_nav_link_hover_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_link_hover_text_color', 
			array(
				'label'    => 'Horiz. Nav Hover Link Bg Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_link_hover_text_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_header_horizontal_nav_link_hover_text_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_show_divider_control', 
			array(
				'label'    => 'Horiz. Nav Show Dividers',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_show_divider',
				'type'     => 'checkbox',
			)
		); // end control
		
	} // end customize_header
	
	
	private function customize_footer( $wp_customize, $panel ){
		
		$wp_customize->add_setting( 
			'_cahnrswp_footer_type', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		
		// Add section
		
		$section_id = '_cahnrswp_footer';
		
		$wp_customize->add_section( 
			$section_id, 
			array(
				'title'    	=> 'Footer Settings',
				'panel' 	=> $panel,
			)
		); // end add_section
		
		
		// Add Controls
		
		$wp_customize->add_control(
			'_cahnrswp_footer_type_control', 
			array(
				'label'    => 'Footer Type',
				'section'  => $section_id,
				'settings' => '_cahnrswp_footer_type',
				'type'     => 'select',
				'choices'  => array(
					'default'  => 'Not Set',
					'college'  => 'College',
				),
			)
		); // end control
		
	} // end customize_theme
	
	
	private function customize_layout_options( $wp_customize, $panel ){
		
		$wp_customize->add_setting( 
			'_cahnrswp_enable_spine_builder', 
			array(
				'default'   => 'disable',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		
		// Add section
		
		$section_id = '_cahnrswp_layout_options';
		
		$wp_customize->add_section( 
			$section_id, 
			array(
				'title'    	=> 'Layout Settings',
				'panel' 	=> $panel,
			)
		); // end add_section
		
		
		// Add Controls
		
		$wp_customize->add_control(
			'_cahnrswp_enable_spine_builder_control', 
			array(
				'label'    => 'Spine Layout Builder',
				'section'  => $section_id,
				'settings' => '_cahnrswp_enable_spine_builder',
				'type'     => 'select',
				'choices'  => array(
					'enable'  => 'Enable',
					'disable' => 'Disable',
				),
			)
		); // end control
		
	} // end customize_theme
	
	
	private function customize_theme( $wp_customize, $panel ) {
		
		$wp_customize->add_setting( 
			'_cahnrswp_theme_bg_color', 
			array(
				'default'   => '#ffffff',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_theme_use_spine', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		// Add section
		
		$section_id = '_cahnrswp_theme_options';
		
		$wp_customize->add_section( 
			$section_id, 
			array(
				'title'    	=> 'General Theme Settings',
				'panel' 	=> $panel,
			)
		); // end add_section
		
		// Add Controls
		
		$wp_customize->add_control(
			'_cahnrswp_theme_bg_color_control', 
			array(
				'label'    => 'Site Background Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_theme_bg_color',
				'type'     => 'select',
				'choices'  => $this->forms->get_colors('_cahnrswp_theme_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_theme_use_spine_control', 
			array(
				'label'    => 'Use Spine (sitewide)',
				'section'  => $section_id,
				'settings' => '_cahnrswp_theme_use_spine',
				'type'     => 'select',
				'choices'  => array(
					'default' 	=> 'Not Set',
					'enable' 	=> 'Enable',
					'disable' 	=> 'Disable', 
				),
			)
		); // end control
		
	} // end customize_theme
	
	
	public function filter_body_class( $classes ){
		
		$cahnrswp_theme_use_spine = get_theme_mod( '_cahnrswp_theme_use_spine', '' );
		
		if ( $cahnrswp_theme_use_spine == 'disable' ){
			
			$classes[] = 'disable-spine';
			
		} // end if
		
		return $classes;
		
	} // end filter_body_class
	
	
	/**
	 * Check if a value is set or is set to default
	 * @param string $value Value to check
	 * @return bool
	**/
	private function is_set( $value ){
		
		if ( $value !== '' && $value != 'default' ) {
			
			return true;
			
		} // end if
		
		return false;
		
	} // end is_set
	
	
	/**
	 * Turn spine builde on or off depending on _cahnrswp_enable_spine_builder
	 * setting in customizer
	**/
	public function spine_enable_builder_module( $enable ){
		
		if ( get_theme_mod( '_cahnrswp_enable_spine_builder', 'disable' ) == 'disable' ){
			
			$enable = false;
			
		} // end if
		
		return $enable;
		
	} // end spine_enable_builder_module
	
	/**
	 * Adds customizer settings to document head instead of using
	 * inline style
	**/
	public function wp_head(){
		
		$css_array = array();
		
		$css_array = $this->add_header_css( $css_array );
		
		$css_array = $this->add_theme_css( $css_array );
		
		echo '<style>' . $this->css_to_string( $css_array ) . '</style>';
		
	} // end wp_footer
	
} // end Theme_Options_CAHNRSWP_Spine_Child