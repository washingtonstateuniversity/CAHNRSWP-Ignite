<?php
/** TO DO's
- Flesh out get_clean_value()
**/

class Post_Editor_Ignite {
	
	protected $forms;
	
	protected $fields = array(
		'_post_layout_single_ignite' 	=> 'text',
		'_show_title_single_ignite' 	=> 'text',
		'_show_footer_ignite' 	=> 'text',
		'_show_content_single_ignite' => 'text',
	);
	
	protected $apply_to = array( 
		'page',
		'post'
	);
	
	
	public function __construct( $forms ){
		
		$this->forms = $forms;
		
	} // end __construct
	
	
	public function init(){
		
		add_action( 'edit_form_after_title', array( $this, 'edit_form_after_title' ), 1 );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10, 1 );
		
		add_action( 'save_post', array( $this, 'save'), 10, 3 );
		
	} // end init
	
	
	public function admin_enqueue_scripts( $hook ){
		
		global $post;

		if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
			
			if ( in_array( $post->post_type, $this->apply_to ) ) { 
			    
				wp_enqueue_style(  'post_edit_form_ignite', CAHNRSIGNITEURL .'css/post-edit-form.css', array(), CAHNRSWP_Ignite::$version  );
				
			} // end if
			
		} // end if
		
	} // end $hook
	
	
	public function edit_form_after_title( $post ){
		
		$show_ops = array(
			'Default' => '',
			'Show' 		=> 'show',
			'Hide'		=> 'hide',
		);
		
		if ( in_array( $post->post_type, $this->apply_to ) ){
			
			$settings = $this->get_settings( $post->ID );
			
			$tab_set = array();
			
			// Start Basic Tab
			
			ob_start();
			
			include CAHNRSIGNITEPATH . 'includes/forms/post-editor-basic.php';
			
			$tab_set['Page Settings'] = ob_get_clean();
			
			// Start Advanced Tab
			
			$tab_set['Advanced'] = 'advanced';
			
			echo $this->forms->get_tabs( $tab_set );
			
			var_dump( $settings );
			
		} // end if
		
	} // end edit_form_after_title
	
	
	public function get_settings( $post_id ){
		
		$settings = array();
		
		$theme_settings = $this->get_theme_settings( $post_id );
		
		foreach( $this->fields as $key => $type ){
			
			$meta = get_post_meta( $post_id, $key, true );
			
			if ( $meta !== '' ){
				
				$settings[ $key ] = $meta;
				
			} else if ( array_key_exists( $key, $theme_settings ) ){
				
				$settings[ $key ] = $theme_settings[ $key ];
				
			} else {
				
				$settings[ $key ] = '';
				
			} // end if
			
		} // end foreach
		
		return $settings;
		
	} // end get_settings
	
	
	protected function get_theme_settings( $post_id ){
		
		return array();
		
	} // end get_settings_default
	
	
	public function save( $post_id, $post, $update ){
		
		
		if ( in_array( $post->post_type, $this->apply_to ) ){
			
			$save_settings = $this->get_clean_settings();
			
			foreach( $save_settings as $key => $value ){
				
				update_post_meta( $post_id, $key, $value );
				
			} // end foreach
			
		} // end if
		
	} // end save
	
	
	protected function get_clean_settings(){
		
		$clean_settings = array();
			
		foreach( $this->fields as $key => $type ){
			
			if ( isset( $_POST[ $key ] ) ){
				
				$clean_settings[ $key ] = $this->get_clean_value( $_POST[ $key ], $type );
				
			} // end if
			
		} // end foreach
		
		return $clean_settings;
		
	} // end get_clean_settings
	
	
	protected function get_clean_value( $value, $type ){
		
		return $value;
		
	} // end clean_value
	
} // end Post_Editor_Ignite