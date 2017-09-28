<?php

class Articles_Post_Type_CAHNRS_Ignite {
	
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'register_post_type' ) );
		
		add_action( 'edit_form_after_title', array( $this, 'add_feature_settings' ), 12 );
		
		add_action( 'save_post_article', array( $this, 'save_post' ), 10, 3 );
		
		add_action( 'rest_query_vars', array( $this, 'add_custom_query_vars' ) );
		
		add_action( 'rest_article_query', array( $this, 'custom_rest_query_args'), 10, 2 );
		
		add_filter('cahnrs_ignite_default_query_args', array( $this, 'cahnrs_ignite_default_query_args' ), 10, 3 );
		
		add_filter('cahnrs_ignite_query_args_local', array( $this, 'cahnrs_ignite_query_args_local' ), 10, 3 );
		
		add_filter( 'cahnrs_ignite_query_args_remote', array( $this, 'cahnrs_ignite_query_args_remote' ), 10, 3 );
		
		add_filter( 'template_include', array( $this, 'check_redirect'), 1 );
		
	} // End __construct
	
	
	public function check_redirect( $template ){
		
		if ( is_singular( 'article' ) ){
			
			global $post;
			
			$redirect_url = get_post_meta( $post->ID, '_article_redirect_url', true );
			
			if ( ! empty( $redirect_url ) ){
				
				wp_redirect( $redirect_url );
				
				exit;
				
			} // End if
			
		} // End if
		
		return $template;
		
	} // End check_redirect
	
	
	public function cahnrs_ignite_query_args_local( $wp_args, $args, $context ){
		
		if ( 'article' === $args['post_type'] ){
			
			$meta_query = array();
			
			if ( ! empty( $args['article_placement'] ) ){
				
				$meta_query[] = $this->get_article_placement_query( $args, $context );
				
			} // End if
			
			if ( ! empty( $args['article_topic'] ) ){
				
				$meta_query[] = $this->get_article_topic_query( $args, $context );
				
			} // End if
			
			if ( ! empty( $args['article_subject'] ) ){
				
				$meta_query[] = $this->get_article_subject_query( $args, $context );
				
			} // End if
			
			if ( ! empty( $meta_query ) ){
				
				if ( empty( $wp_args['meta_query'] ) ){
					
					$wp_args['meta_query'] = $meta_query;
					
				} else {
					
					$wp_args['meta_query'] = array_merge( $wp_args['meta_query'], $meta_query );

				} // End if 
				
			} // End if
			
		} // End if
		
		return $wp_args;
		
	} // End cahnrs_ignite_query_args_local
	
	
	public function cahnrs_ignite_query_args_remote( $query, $args, $context ){
		
		if ( 'article' === $args['post_type'] ){
			
			$add_fields = array( 
				'article_placement',
				'article_topic',
				'article_subject',
				'subject_relation',
				'topic_relation',
				'article_relation',
				'sites',
				'site_relation'
			);
			
			foreach( $add_fields as $field ){
				
				if ( ! empty( $args[ $field ] ) ){
					
					$query[ $field ] = $args[ $field ];
					
				} // End if
				
			} // End foreach
			
		} // End if
		
		return $query;
		
	} // End cahnrs_ignite_query_args_remote
	
	
	public function get_article_topic_query( $args, $context ){
		
		$topics_meta = array();
		
		$topics = explode( ',', $args['article_topic'] );
			
		if ( is_array( $topics ) ){
			
			$topics_meta = array();
			
			foreach( $topics as $topic ){
				
				if ( ! empty( $topic ) ){
				
					$query = array(
						'key' => '_article_topic',
						'value' => $topic,
						'compare' => 'LIKE',
					);
					
					$topics_meta[] = $query;
				
				} // End If
				
			} // End foreach
			
			if ( ! empty( $topics_meta ) ){
				
				$topics_meta['relation'] = $args['topic_relation'];
				
			} // End if
			
		} // End if
		
		return $topics_meta;
		
	} // End get_article_topic_query
	
	
	public function get_article_subject_query( $args, $context ){
		
		$subjects_meta = array();
		
		$subjects = explode( ',', $args['article_subject'] );
			
		if ( is_array( $subjects ) ){
			
			$subjects_meta = array();
			
			foreach( $subjects as $subject ){
				
				if ( ! empty( $subject ) ){
				
					$query = array(
						'key' => '_article_subject',
						'value' => $subject,
						'compare' => 'LIKE',
					);
					
					$subjects_meta[] = $query;
				
				} // End If
				
			} // End foreach
			
			if ( ! empty( $subjects_meta ) ){
				
				$subjects_meta['relation'] = $args['subject_relation'];
				
			} // End if
			
		} // End if
		
		return $subjects_meta;
		
	} // End get_article_topic_query
	
	
	public function get_article_placement_query( $args, $context ){
		
		$placements_meta = array();
		
		$placements = explode( ',', $args['article_placement'] );
			
		if ( is_array( $placements ) ){
			
			$placements_meta = array();
			
			foreach( $placements as $placement ){
				
				if ( ! empty( $placement ) ){
				
					$query = array(
						'key' => '_article_placement',
						'value' => $placement,
						'compare' => 'LIKE',
					);
					
					$placements_meta[] = $query;
				
				} // End If
				
			} // End foreach
			
			if ( ! empty( $placements_meta ) ){
				
				$placements_meta['relation'] = $args['placement_relation'];
				
			} // End if
			
		} // End if
		
		return $placements_meta;
		
	} // End get_article_topic_query
	
	
	public function cahnrs_ignite_default_query_args( $args_default, $args, $context ){
		
		if ( 'article' === $args['post_type'] ){
			
			$article_defaults = array(
				'url' 					=> 'http://cahnrs.wsu.edu/news-stage/',
				'article_placement' 	=> '',
				'article_topic'			=> '',
				'article_subject' 		=> '',
				'subject_relation'		=> 'OR',
				'topic_relation' 		=> 'OR',
				'sites' 				=> '',
				'site_relation' 		=> 'OR',
				'per_page'				=> 5,
			);
			
			$args_default = array_merge( $args_default, $article_defaults );
			
		} // End if
		
		return $args_default;
		
	} // End cahnrs_ignite_default_query_args
	
	
	public function custom_rest_query_args( $args, $request ){
		
		$meta_query = array( 'relation' => 'AND');
		
		if ( ! empty( $_GET['article_placement'] ) ){
			
			$placement_values = sanitize_text_field( $_GET['article_placement'] );
			
			$meta_query[] = $this->get_rest_meta_query( '_article_placement', $placement_values );
			
		} // End if
		
		if ( ! empty( $_GET['article_topic'] ) ){
			
			$topic_values = sanitize_text_field( $_GET['article_topic'] );
			
			$meta_query[] = $this->get_rest_meta_query( '_article_topic', $topic_values );
			
		} // End if
		
		$args['meta_query'] = $meta_query;
		
		return $args;
		
	} // End custom_rest_query_args
	
	
	protected function get_rest_meta_query( $key, $values ){
		
		$values = explode( ',', $values );
		
		$meta_query = array();
		
		foreach( $values as $value ){
			
			$query = array(
				'key' => $key,
				'value' => $value,
				'compare' => 'LIKE',
			);
			
			$meta_query[] = $query;
			
		} // End foreach
		
		return $meta_query;
		
	} // End get_rest_meta_query
	
	
	public function add_custom_query_vars( $vars ){
		
		$fields = array( 'article_placement','article_topic','article_subject','subject_relation','topic_relation','article_relation','sites','site_relation' );
		
		$vars = array_merge( $vars, $fields );
		
		return $vars;
		
	} // End function add_custom_query_vars
	
	
	
	
	
	public function register_post_type(){
		
		$labels = array(
			'name'               => 'News Articles',
			'singular_name'      => 'News Articles', 
			'menu_name'          => 'News Articles',
			'name_admin_bar'     => 'News Articles',
			'add_new'            => 'Add New Item',
			'add_new_item'       => 'Add News Item', 
			'new_item'           => 'New News Item', 
			'edit_item'          => 'Edit News Item', 
			'view_item'          => 'View News Item', 
			'all_items'          => 'All News Articles', 
			'search_items'       => 'Search News Articles', 
			'parent_item_colon'  => 'Parent News:', 
			'not_found'          => 'No news found.',
			'not_found_in_trash' => 'No news found in Trash.',
		);
	
		$args = array(
			'labels'			 => $labels,
			'description'        => 'News & Announcements.', 
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'article' ),
			'capability_type'    => 'post',
			'show_in_rest'		 => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'taxonomies'		=> array( 'category', 'post_tag' ),
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'post-formats','excerpt' )
		);
		
		register_post_type( 'article', $args );
		
		
	} // End register_post_type
	
	
	public function add_feature_settings( $post ){
		
		if ( 'article' === $post->post_type ){
		
			$post_id = $post->ID;
			
			$html .= '<style>';
			
			ob_start();
			
			include locate_template( 'lib/post-types/articles/includes/style.css', false );
			
			$html .= ob_get_clean() . '</style>';
			
			$html .= '<fieldset id="news-release-options">';
			
			$html .= $this->get_sources_form( $post );
			
			$html .= $this->get_slide_edit_form( $post_id );
			
			$html .= $this->get_position_edit_form( $post_id );
			
			$html .= $this->get_data_edit_form( $post_id );
			
			//$html .= $this->get_article_summary_form( $post );
			
			$html .= '</fieldset>';
			
			echo $html;
		
		} // End if
		
	} // End add_feature_settings
	
	
	protected function get_sources_form( $post ){
		
		$html = '';
		
		ob_start();
		
			include locate_template( 'lib/post-types/articles/includes/sources-form.php', false );
		
		$html .= ob_get_clean();
		
		return $html;
		
	}
	
	
	protected function get_data_edit_form( $post_id ){
		
		$general_topics = array(
			'academics' 	=> 'Academics',
			'research' 		=> 'Research',
			'extension' 	=> 'Extension',
			'alumni' 		=> 'Alumni',
			'giving' 		=> 'Giving/Development',
			'events' 		=> 'Events',
			'faculty-staff' => 'Faculty & Staff',
		);
		
		$subjects = array(
			'faculty' 			=> 'Faculty',
			'staff' 			=> 'Staff',
			'extension' 		=> 'Extension Specialists',
			'students' 			=> 'Students',
			'alumni' 			=> 'Alumni',
			'industry' 			=> 'Industry Partners',
			'volunteers' 		=> 'Volunteers',
			'administrators' 	=> 'Administrators',
			'initiatives'		=> 'University Initiatives',
			'facilities' 		=> 'Facilities & Centers',
			'awards'			=> 'Press & Awards',
		);
		
		$topic_values = get_post_meta( $post_id, '_article_topic', true );
		
		if ( ! is_array( $topic_values ) ) $topic_values = array();
		
		$subjects_values = get_post_meta( $post_id, '_article_subject', true ); 
		
		if ( ! is_array( $subjects_values ) ) $subjects_values = array();
		
		$html = '';
		
		if ( ! is_array( $locations ) ) $locations = array(); 
		
		ob_start();
		
			include locate_template( 'lib/post-types/articles/includes/data-edit-form.php', false );
		
		$html .= ob_get_clean();
		
		return $html;
		
	} // End get_data_edit_form
	
	
	protected function get_position_edit_form( $post_id ){
		
		$html = '';
		
		$distribute = get_post_meta( $post_id, '_article_distribute', true );
		
		if ( ! is_array( $distribute ) ) $distribute = array();
		
		$placement = get_post_meta( $post_id, '_article_placement', true ); 
		
		if ( ! is_array( $placement ) )$placement = array();
		
		if ( empty( $placement ) ) $placement[] = 'news-feed';
		
		ob_start();
		
			include locate_template( 'lib/post-types/articles/includes/locations-edit-form.php', false );
		
		$html .= ob_get_clean();
		
		return $html;
		
	} // End get_position_edit_form
	
	
	protected function get_slide_edit_form( $post_id ){
		
		$html = '';
		
		$short_title = get_post_meta( $post_id, '_article_short_title', true );
		
		$slide_image_url = get_post_meta( $post_id, '_article_slide_image_url', true );
		
		$redirect_url = get_post_meta( $post_id, '_article_redirect_url', true );
		
		ob_start();
		
			include locate_template( 'lib/post-types/articles/includes/slide-edit-form.php', false );
		
		$html .= ob_get_clean();
		
		return $html;
		
	} // End get_slide_edit_form
	
	
	protected function get_article_summary_form( $post ){
		
		$summary = $post->post_excerpt;
		
		$html = '';
		
		ob_start();
		
			include locate_template( 'lib/post-types/articles/includes/summary-form.php', false );
		
		$html .= ob_get_clean();
		
		return $html;
		
	} // End get_article_summary_form
	
	
	public function save_post( $post_id, $post, $update ){
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
        
        if ( ! current_user_can( 'edit_posts' ) )
            return;
			
		//var_dump( $post_id );
		
		//var_dump( $_POST );
			
		$fields = array(
			'_article_short_title' 		=> 'text',
			'_article_slide_image_url' 	=> 'text',
			'_article_redirect_url' 	=> 'text',
			'_article_locations' 		=> 'text-array',
			'_article_topic' 			=> 'text-array',
			'_article_subject' 			=> 'text-array',
			'_article_distribute' 		=> 'text-array',
			'_article_placement' 		=> 'text-array',
		);
		
		foreach( $fields as $key => $type ){

			
			//if ( isset( $_POST[ $key ] ) ){
				
				$val = $_POST[ $key ];
				
				update_post_meta( $post_id, $key, $val );
				
			//} // End if
			
		} // End foreach
		
	} // End save_post
	
} // End Articles_Post_Type_CAHNRS_Ignite

$article_post_type = new Articles_Post_Type_CAHNRS_Ignite();