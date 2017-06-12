<?php

class Customizer_CAHNRS_Ignite {
	
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
		'#23282B' => 'Gray Darker', 
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
	
	
	public function __construct(){
		
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		
	} // end __construct
	
	
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
		
		$this->customize_header( $wp_customize, $panel );
		
		$this->customize_layout_options( $wp_customize, $panel );
		
		$this->customize_footer( $wp_customize, $panel );
		
	} // end customize_register 
	
	
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
				'choices'  => $this->get_colors('_cahnrswp_theme_bg_color'),
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
				'choices'  => $this->get_colors('_cahnrswp_header_bg_color'),
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
		
		$colors = $this->get_colors('header');
		
		$wp_customize->add_control(
			'_cahnrswp_header_college_global_nav_bg_color_control', 
			array(
				'label'    => 'College Nav Background Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_college_global_nav_bg_color',
				'type'     => 'select',
				'choices'  => $this->get_colors('_cahnrswp_header_college_global_nav_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_college_global_nav_text_color_control', 
			array(
				'label'    => 'College Nav Text Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_college_global_nav_text_color',
				'type'     => 'select',
				'choices'  => $this->get_colors('_cahnrswp_header_college_global_nav_text_color'),
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
				'choices'  => $this->get_colors('_cahnrswp_header_banner_text_color'),
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
				'choices'  => $this->get_colors('_cahnrswp_header_horizontal_nav_text_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_bg_color_control', 
			array(
				'label'    => 'Horizontal Nav Bg Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_bg_color',
				'type'     => 'select',
				'choices'  => $this->get_colors('_cahnrswp_header_horizontal_nav_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_link_active_bg_color', 
			array(
				'label'    => 'Horiz. Nav Active Link Bg Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_link_active_bg_color',
				'type'     => 'select',
				'choices'  => $this->get_colors('_cahnrswp_header_horizontal_nav_link_active_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_link_active_text_color', 
			array(
				'label'    => 'Horiz. Nav Active Link Text Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_link_active_text_color',
				'type'     => 'select',
				'choices'  => $this->get_colors('_cahnrswp_header_horizontal_nav_link_active_text_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_link_hover_bg_color', 
			array(
				'label'    => 'Horiz. Nav Hover Link Bg Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_link_hover_bg_color',
				'type'     => 'select',
				'choices'  => $this->get_colors('_cahnrswp_header_horizontal_nav_link_hover_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_link_hover_text_color', 
			array(
				'label'    => 'Horiz. Nav Hover Link Bg Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav_link_hover_text_color',
				'type'     => 'select',
				'choices'  => $this->get_colors('_cahnrswp_header_horizontal_nav_link_hover_text_color'),
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
	
	
	/**
	 * @param string $context Where the colors will be used. Helpfull to give additional context to filters
	 * @return array WSU color set for filtered by context if provided
	**/
	protected function get_colors( $context = 'general', $add_default = true, $add_none = true, $none_value = 'transparent' ) {
		
		$colors =  $this->colors;
		
		if ( $add_none ){ // and default option
			
			$colors = array_merge( array( $none_value => 'None' ), $colors );
			
		} // end if
		
		if ( $add_default ){ // and default option
			
			$colors = array_merge( array( 'default' => 'Not Set' ), $colors );
			
		} // end if
	
		return apply_filters( 'cahnrswp_colors', $colors, $context );
	
	} // end get_colors
	
	
} // end Customizer_CAHNRS_Ignite

$customizer_cahnrs_ignite = new Customizer_CAHNRS_Ignite();