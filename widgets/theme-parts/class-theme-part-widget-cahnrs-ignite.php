<?php

class Theme_Part_Widget_CAHNRS_Ignite extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		
		add_filter( 'widget_content_ignite', 'wptexturize'        );
		add_filter( 'widget_content_ignite', 'convert_smilies'    );
		add_filter( 'widget_content_ignite', 'convert_chars'      );
		add_filter( 'widget_content_ignite', 'wpautop'            );
		add_filter( 'widget_content_ignite', 'shortcode_unautop'  );
		add_filter( 'widget_content_ignite', 'prepend_attachment' );
		
		$widget_ops = array( 
			'classname' => 'Theme_Part_Widget_CAHNRS_Ignite',
			'description' => 'Widget for adding custom theme parts',
		);
		parent::__construct( 'theme_part_widget', 'Insert Theme Part', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		
		if ( ! empty( $instance['part_id'] ) ) {
			
			$post = get_post( $instance['part_id'] );
			
			//var_dump( $post );
			
			if ( $post ){
				
				$content = apply_filters( 'widget_content_ignite', $post->post_content );
				
				echo do_shortcode( $content );
				
			} // end if
			
		} // End if
		
		// outputs the content of the widget
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		
		$part_id = ( ! empty( $instance['part_id'] ) ) ? $instance['part_id'] :'';
		
		include locate_template( 'widgets/theme-parts/includes/widget-form.php', false );
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		
		$instance['part_id'] = ( ! empty( $new_instance['part_id'] ) ) ? sanitize_text_field( $new_instance['part_id'] ) : '';

		return $instance;
		
		// processes widget options to be saved
	}
}