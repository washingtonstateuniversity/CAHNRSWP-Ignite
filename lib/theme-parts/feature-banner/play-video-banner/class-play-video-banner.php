<?php namespace CAHNRSWP\themes\ignite;

class Play_Video_banner {
	
	
	public function __construct(){
		
		add_filter( 'cahnrs_ignite_frontpage_feature_types', array( $this, 'register_banner' ) );
		
		add_filter( 'cahnrs_ignite_theme_part_feature_banner', array( $this, 'get_the_banner' ), 10, 4 );
		
		add_action( 'cahnrs_ignite_customize_frontpage_feature_options', array( $this, 'add_settings'), 10, 2 );
		
	} // __construct
	
	
	public function register_banner( $banners ){
		
		$banners['play-video'] = 'Play Video';
		
		return $banners;
		
	} // End register_banner
	
	
	public function get_the_banner( $banner, $context, $args, $post_id ){
		
		if ( 'play-video' === $args['type'] ){
		
			$link_image = get_theme_mod( '_cahnrswp_ignite_play_video_banner_img', '' );
			
			$background_images = $this->get_background_images();
			
			// Let's mix it up a bit
			shuffle( $background_images );
			
			$background_image = $background_images[0];
			
			$video_id = get_theme_mod( '_cahnrswp_ignite_play_video_id', '' );
		
			ob_start();
		
			include ignite_get_theme_path('lib/displays/feature-banners/play-video-banner/player.php');
		
			include ignite_get_theme_path('lib/displays/feature-banners/play-video-banner/player-js.php');
		
			$banner .= ob_get_clean();
			
		} // End if
		
		return $banner;
		
	} // End get_the_banner
	
	
	protected function get_background_images(){
		
		// Image keys to check in customizer
		$image_keys = array(
			'_cahnrswp_ignite_play_video_bg_img',
			'_cahnrswp_ignite_play_video_bg_img_2',
			'_cahnrswp_ignite_play_video_bg_img_3',
			'_cahnrswp_ignite_play_video_bg_img_4',
			'_cahnrswp_ignite_play_video_bg_img_5',
			'_cahnrswp_ignite_play_video_bg_img_6',
			'_cahnrswp_ignite_play_video_bg_img_7',
			'_cahnrswp_ignite_play_video_bg_img_8',
			'_cahnrswp_ignite_play_video_bg_img_9',
			'_cahnrswp_ignite_play_video_bg_img_10',
		);
		
		// Add found images to this array
		$images = array();
		
		// Loop through keys and add to images array if they exist
		foreach( $image_keys as $index => $key ){
			
			// Get image from customizer
			$image_src = get_theme_mod( $key, '' );
			
			// If $image_src has a value add to images array
			if ( ! empty( $image_src ) ){
				
				// Add to images array
				$images[] = $image_src;
				
			} // End if
			
		} // End foreach
		
		return $images;
		
	} // End get_background_images
	
	
	public function add_settings( $wp_customize, $section_id ){
		
		// Image keys to add in customizer
		$image_keys = array(
			'_cahnrswp_ignite_play_video_bg_img',
			'_cahnrswp_ignite_play_video_bg_img_2',
			'_cahnrswp_ignite_play_video_bg_img_3',
			'_cahnrswp_ignite_play_video_bg_img_4',
			'_cahnrswp_ignite_play_video_bg_img_5',
			'_cahnrswp_ignite_play_video_bg_img_6',
			'_cahnrswp_ignite_play_video_bg_img_7',
			'_cahnrswp_ignite_play_video_bg_img_8',
			'_cahnrswp_ignite_play_video_bg_img_9',
			'_cahnrswp_ignite_play_video_bg_img_10',
		);
		
		foreach( $image_keys as $index => $key ){
			
			$wp_customize->add_setting( 
				$key, 
				array(
					'default'   => '',
					'transport' => 'refresh',
				) 
			); // end add_setting
			
		} // End foreach
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_play_video_banner_img', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_play_video_id', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_control(  
			'_cahnrswp_ignite_play_video_id_control', 
			array(
				'label'      		=> 'Video ID',
				'section'    		=> $section_id,
				'type' 				=> 'text',
				'settings'   		=> '_cahnrswp_ignite_play_video_id',
				'active_callback' 	=> function() use ( $wp_customize ){

					$type = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature' )->value();

					$show = ( 'play-video' === $type )? true : false;

					return $show;

				}
			)  
		);
		
		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				'_cahnrswp_ignite_play_video_banner_img_control',
			   	array(
				   	'label'      		=> 'Play Video Image',
				   	'section'    		=> $section_id,
				   	'settings'   		=> '_cahnrswp_ignite_play_video_banner_img',
					'active_callback' 	=> function() use ( $wp_customize ){
						
						$type = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature' )->value();
						
						$show = ( 'play-video' === $type )? true : false;
							
						return $show;
						
					}
			   	)
		   	)
	   	);
		
	
		foreach( $image_keys as $index => $key ){
			
			$wp_customize->add_control(
				new \WP_Customize_Image_Control(
					$wp_customize,
					$key . '_control',
					array(
						'label'      		=> 'Feature Background Image ' . ( $index + 1 ), 
						'section'    		=> $section_id,
						'settings'   		=> $key,
						'active_callback' 	=> function() use ( $wp_customize ){

							$type = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature' )->value();

							$show = ( 'play-video' === $type )? true : false;

							return $show;

						}
					)
				)
			);
			
		} // End foreach
		
	} // End add_settings
	
	
} // End Play_Video_banner

$video_banner = new Play_Video_banner();