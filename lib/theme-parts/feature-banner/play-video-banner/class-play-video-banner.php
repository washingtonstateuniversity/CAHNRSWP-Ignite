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
			
			$background_image = get_theme_mod( '_cahnrswp_ignite_play_video_bg_img', '' );
			
			$video_id = get_theme_mod( '_cahnrswp_ignite_play_video_id', '' );
		
			ob_start();
		
			include ignite_get_theme_path('lib/displays/feature-banners/play-video-banner/player.php');
		
			include ignite_get_theme_path('lib/displays/feature-banners/play-video-banner/player-js.php');
		
			$banner .= ob_get_clean();
			
		} // End if
		
		return $banner;
		
	} // End get_the_banner
	
	
	public function add_settings( $wp_customize, $section_id ){
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_play_video_banner_img', 
			array(
				'default'   => '',
				'transport' => 'refresh',
			) 
		); // end add_setting
		
		$wp_customize->add_setting( 
			'_cahnrswp_ignite_play_video_bg_img', 
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
				'_cahnrswp_ignite_play_video_bg_img_control',
			   	array(
				   	'label'      		=> 'Feature Background Image',
				   	'section'    		=> $section_id,
				   	'settings'   		=> '_cahnrswp_ignite_play_video_bg_img',
					'active_callback' 	=> function() use ( $wp_customize ){
						
						$type = $wp_customize->get_setting( '_cahnrswp_ignite_fronpage_feature' )->value();
						
						$show = ( 'play-video' === $type )? true : false;
							
						return $show;
						
					}
			   	)
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
		
	} // End add_settings
	
	
} // End Play_Video_banner

$video_banner = new Play_Video_banner();