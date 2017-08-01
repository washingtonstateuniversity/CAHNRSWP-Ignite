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
	
	protected $menus = array();
	
	protected $banners = array(
		'default' 				=> 'Not Set',
		'none' 					=> 'No Banner',
		'dynamic-scroll' 		=> 'Wide Banner',
	);
		
	protected $heights = array(
		''					=> 'Not Set',
		'short' 			=> 'Short (20vw)',
		'medium' 			=> 'medium (25vw)',
		'tall' 				=> 'Tall (30vw)',
		'extra-tall' 		=> 'Extra Tall (40vw)',
		'height-short' 		=> 'Short (30vh - fixed height)',
		'height-medium' 	=> 'medium (45vh - fixed height)',
		'height-tall' 		=> 'Tall (60vh - fixed height)',
		'height-extra-tall' => 'Extra Tall (80vh - fixed height)',
		'full' 				=> 'Full Height (100vh)'
	);
	
	
	public function __construct(){
		
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		
	} // end __construct
	
	
	public function customize_register( $wp_customize ){
		
		$menu_objs = get_terms('nav_menu');
		
		$this->menus = array( 0 => 'No Menu' );
		
		foreach( $menu_objs as $menu ){
			
			$this->menus[ $menu->term_id ] = $menu->name;
			
		} // end foreach
		
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
		
		$this->customize_pagebanners( $wp_customize, $panel );
		
		$this->customize_frontpage( $wp_customize, $panel );
		
		$this->customize_secondary_nav( $wp_customize, $panel );
		
		$this->customize_layout_options( $wp_customize, $panel );
		
		$this->customize_footer( $wp_customize, $panel );
		
	} // end customize_register
	
	
	private function customize_secondary_nav( $wp_customize, $panel ){
		
		$wp_customize->add_setting( 
			'_cahnrswp_secondary_menu', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_secondary_menu_font_color', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_secondary_menu_bg_color', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$section_id = '_cahnrswp_secondary_menu_options';
		
		$wp_customize->add_section( 
			$section_id, 
			array(
				'title'    	=> 'Secondary Menu',
				'panel' 	=> $panel,
			)
		); // end add_section
		
		
		$wp_customize->add_control(
			'_cahnrswp_secondary_menu_control', 
			array(
				'label'    => 'Secondary Menu',
				'section'  => $section_id,
				'settings' => '_cahnrswp_secondary_menu',
				'type'     => 'select',
				'choices'  => $this->menus,
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_secondary_menu_bg_color_control', 
			array(
				'label'    => 'Menu Background Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_secondary_menu_bg_color',
				'type'     => 'select',
				'choices'  => $this->get_colors('_cahnrswp_theme_bg_color'),
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_secondary_menu_font_color_control', 
			array(
				'label'    => 'Menu Font Color',
				'section'  => $section_id,
				'settings' => '_cahnrswp_secondary_menu_font_color',
				'type'     => 'select',
				'choices'  => $this->get_colors('_cahnrswp_theme_bg_color'),
			)
		); // end control
		
	} // End customize_secondary_nav
	
	
	private function customize_pagebanners( $wp_customize, $panel ){
		
		$args = array(
		   'public'   => true,
		);
		
		$post_types = get_post_types( $args, 'objects');
		
		foreach( $post_types as $index => $post_type ){
			
			$name = str_replace( '-', '_', $post_type->name );
			
			$wp_customize->add_setting( 
				'_cahnrswp_ignite_banner_' . $name . '_type', 
				array(
					'default'   => 'default',
					'transport' => 'refresh',
				) 
			); // end add_setting
			
			$wp_customize->add_setting( 
				'_cahnrswp_ignite_banner_' . $name . '_image', 
				array(
					'default'   => '',
					'transport' => 'refresh',
				) 
			); // end add_setting
			
			$wp_customize->add_setting( 
				'_cahnrswp_ignite_banner_' . $name . '_height', 
				array(
					'default'   => '',
					'transport' => 'refresh',
				) 
			); // end add_setting
			
			$wp_customize->add_setting( 
				'_cahnrswp_ignite_banner_' . $name . '_parallax', 
				array(
					'default'   => 1,
					'transport' => 'refresh',
				) 
			); // end add_setting
			
		} // End foreach
		
		$section_id = '_cahnrswp_pagebanners_options';
		
		$wp_customize->add_section( 
			$section_id, 
			array(
				'title'    	=> 'Page Banners',
				'panel' 	=> $panel,
			)
		); // end add_section
		
		foreach( $post_types as $index => $post_type ){
			
			$name = str_replace( '-', '_', $post_type->name );
		
			$wp_customize->add_control(
				'_cahnrswp_ignite_banner_' . $name . '_type_control', 
				array(
					'label'    => $post_type->label . ' Banner',
					'section'  => $section_id,
					'settings' => '_cahnrswp_ignite_banner_' . $name . '_type',
					'type'     => 'select',
					'choices'  => $this->banners,
				)
			); // end control
			
			$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'_cahnrswp_ignite_banner_' . $name . '_image_control',
			   	array(
				   	'label'      		=> 'Default ' . $post_type->label . ' Banner Image',
				   	'section'    		=> $section_id,
				   	'settings'   		=> '_cahnrswp_ignite_banner_' . $name . '_image',
					'active_callback' 	=> function() use ( $wp_customize, $name ){
						
						$show_with = array('dynamic-scroll');
					
						$show = false;
						
						$type = $wp_customize->get_setting( '_cahnrswp_ignite_banner_' . $name . '_type' )->value();
						
						$show = ( in_array( $type, $show_with ) ) ? true : false;
							
						return $show;
						
					}
			   	)
		   	)
	   	);
			
			$wp_customize->add_control(
				'_cahnrswp_ignite_banner_' . $name . '_height_control', 
				array(
					'label'    => 'Banner Height',
					'section'  => $section_id,
					'settings' => '_cahnrswp_ignite_banner_' . $name . '_height',
					'type'     => 'select',
					'choices'  => $this->heights,
					'active_callback' 	=> function() use ( $wp_customize, $name ){
						
						$show_with = array('dynamic-scroll');
						
							$show = false;
							
							$type = $wp_customize->get_setting( '_cahnrswp_ignite_banner_' . $name . '_type' )->value();
							
							$show = ( in_array( $type, $show_with ) ) ? true : false;
								
							return $show;
						
					}
				)
			);
			
			$wp_customize->add_control(
				'_cahnrswp_ignite_banner_' . $name . '_parallax_control', 
				array(
					'label'    => 'Parallax Effect',
					'section'  => $section_id,
					'settings' => '_cahnrswp_ignite_banner_' . $name . '_parallax',
					'type'     => 'checkbox',
					'active_callback' 	=> function() use ( $wp_customize, $name ){
						
						$show_with = array('dynamic-scroll');
						
						$show = false;
						
						$type = $wp_customize->get_setting( '_cahnrswp_ignite_banner_' . $name . '_type' )->value();
						
						$show = ( in_array( $type, $show_with ) ) ? true : false;
							
						return $show;
						
					}
				)
			); // end control
			
			
		} // End Foreach
		
	} // End customize_pagebanners
	
	
	private function customize_frontpage( $wp_customize, $panel ){
		
		$banners = $this->banners;
		
		$banners['wide-static-slides'] = 'College Slideshow';
		
		$section_id = '_cahnrswp_frontpage_options';
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_fronpage_feature', 
			array(
				'default'   => 'default',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_fronpage_feature_image', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_fronpage_feature_height', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_fronpage_feature_parallax', 
			array(
				'default'   => 1,
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_fronpage_feature_source', 
			array(
				'default'   => 'remote',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_fronpage_feature_category', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_fronpage_feature_slide_count', 
			array(
				'default'   => '3',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_section( 
			$section_id, 
			array(
				'title'    	=> 'Front Page Settings',
				'panel' 	=> $panel,
			)
		); // end add_section
		
		$wp_customize->add_control(
			'_cahnrswp_ignite_fronpage_feature_control', 
			array(
				'label'    => 'Primary Feature Type',
				'section'  => $section_id,
				'settings' => '_cahnrswp_ignite_fronpage_feature',
				'type'     => 'select',
				'choices'  => $banners,
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_ignite_fronpage_feature_source_control', 
			array(
				'label'    => 'Feature Content Source',
				'section'  => $section_id,
				'settings' => '_cahnrswp_ignite_fronpage_feature_source',
				'type'     => 'select',
				'choices'  => array(
					'remote' 			=> 'Remote',
					'local' 			=> 'Local',
					'select_remote' 	=> 'Select Remote',
					'select_local' 		=> 'Select Local',
				),
				'active_callback' 	=> function() use ( $wp_customize ){
					
					$show_with = array('wide-static-slides');
					
					$show = false;
					
					$type = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature' )->value();
					
					$show = ( in_array( $type, $show_with ) ) ? true : false;
						
					return $show;
					
				}
			)
		); // end control
		
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'_cahnrswp_ignite_fronpage_feature_image',
			   	array(
				   	'label'      		=> 'Front Page Image',
				   	'section'    		=> $section_id,
				   	'settings'   		=> '_cahnrswp_ignite_fronpage_feature_image',
					'active_callback' 	=> function() use ( $wp_customize ){
						
						$show_with = array('dynamic-scroll');
					
						$show = false;
						
						$type = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature' )->value();
						
						$show = ( in_array( $type, $show_with ) ) ? true : false;
							
						return $show;
						
					}
			   	)
		   	)
	   	);
		
		$wp_customize->add_control(
			'_cahnrswp_ignite_fronpage_feature_height_control', 
			array(
				'label'    => 'Banner Height',
				'section'  => $section_id,
				'settings' => '_cahnrswp_ignite_fronpage_feature_height',
				'type'     => 'select',
				'choices'  => $this->heights,
				'active_callback' 	=> function() use ( $wp_customize ){
					
					$show_with = array('dynamic-scroll');
					
						$show = false;
						
						$type = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature' )->value();
						
						$show = ( in_array( $type, $show_with ) ) ? true : false;
							
						return $show;
					
				}
			)
		);
		
		$wp_customize->add_control(
			'_cahnrswp_ignite_fronpage_feature_parallax_control', 
			array(
				'label'    => 'Parallax Effect',
				'section'  => $section_id,
				'settings' => '_cahnrswp_ignite_fronpage_feature_parallax',
				'type'     => 'checkbox',
				'active_callback' 	=> function() use ( $wp_customize ){
					
					$show_with = array('dynamic-scroll');
					
					$show = false;
					
					$type = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature' )->value();
					
					$show = ( in_array( $type, $show_with ) ) ? true : false;
						
					return $show;
					
				}
			)
		); // end control
			
		
		$cats = array( 0 => 'None' );
		
		foreach ( get_categories() as $categories => $category ){
			
			$cats[$category->term_id] = $category->name;
			
		} // End foreach
 
		
		$wp_customize->add_control(
			'_cahnrswp_ignite_fronpage_feature_category_control', 
			array(
				'label'    => 'Category (local site)',
				'section'  => $section_id,
				'settings' => '_cahnrswp_ignite_fronpage_feature_category',
				'type'     => 'select',
				'choices'  => $cats,
				'active_callback' 	=> function() use ( $wp_customize ){
					
					$show_type = array('wide-static-slides');
					
					$show_source = array('local');
					
					$show = false;
					
					$type = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature' )->value();
					
					$source = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature_source' )->value();
					
					$show = ( in_array( $type, $show_type ) && in_array( $source, $show_source ) ) ? true : false;
						
					return $show;
					
				}
			)
		); // end control
		
		$count_options = array( 
			1 => 1, 
			2 => 2,
			3 => 3,
			4 => 4,
			5 => 5,
			6 => 6,
			7 => 7,
			8 => 8 );
		
		$wp_customize->add_control(
			'_cahnrswp_ignite_fronpage_feature_slide_count_control', 
			array(
				'label'    => 'Number of Slides',
				'section'  => $section_id,
				'settings' => '_cahnrswp_ignite_fronpage_feature_slide_count',
				'type'     => 'select',
				'choices'  => $count_options,
				'active_callback' 	=> function() use ( $wp_customize ){
					
					$show_with = array('wide-static-slides');
					
					$show = false;
					
					$type = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature' )->value();
					
					$show = ( in_array( $type, $show_with ) ) ? true : false;
						
					return $show;
				
				}
			)
		); // end control
		
		
	} // end customize_frontpage
	
	
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
		
		$wp_customize->add_setting( 
			'_cahnrs_ignite_global_cropped_spine', 
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
		
		$wp_customize->add_control(
			'_cahnrs_ignite_global_cropped_spine_control', 
			array(
				'label'    => 'Sitewide Cropped Spine',
				'section'  => $section_id,
				'settings' => '_cahnrs_ignite_global_cropped_spine',
				'type'     => 'checkbox',
			)
		); // end control
		
	} // end customize_theme
	
	
	private function customize_header( $wp_customize, $panel ){
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_show_college_global_nav', 
			array(
				'default'   => 0,
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_header_show_college_global_nav_active', 
			array(
				'default'   => 0,
				'transport' => 'refresh',
			) 
		); // end add_setting
		
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
			'_cahnrswp_header_show_college_global_nav_control', 
			array(
				'label'    => 'Show College Global Nav',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_show_college_global_nav',
				'type'     => 'checkbox',
			)
		); // end control
		
		$wp_customize->add_control(
			'_cahnrswp_header_show_college_global_nav_active_control', 
			array(
				'label'    => 'Global Nav Active Tab',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_show_college_global_nav_active',
				'type'     => 'select',
				'choices'  => array(
					'default' 	=> 'Not Set',
					'home' 		=> 'Home',
					'about' 	=> 'About',
					'academics' => 'Academics',
					'research' 	=> 'Research',
					'extension'	=> 'Extension',
					'alumni'	=> 'Alumni',
					'fs' 		=> 'Faculty & Staff',  
				),
				'active_callback' 	=> function() use ( $wp_customize ){
					
					$value = $wp_customize->get_setting( '_cahnrswp_header_show_college_global_nav' )->value();
						
					return ( ! empty( $value ) )? true : false;
				
				} // End active_callback
			)
		); // end control
		
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
		
		$wp_customize->add_control(
			'_cahnrswp_header_horizontal_nav_control', 
			array(
				'label'    => 'Horizontal Menu',
				'section'  => $section_id,
				'settings' => '_cahnrswp_header_horizontal_nav',
				'type'     => 'select',
				'choices'  => $this->menus,
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
					'college-global'  => 'College Global',
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