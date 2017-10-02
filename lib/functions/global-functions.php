<?php
/*
* Get the image data from a given post id
* @param int $post_id ID for given post
* @param string $size Size of image to be used (full,large,medium,small, or custom)
* @return array Array of image data
*/
function ignite_get_post_image( $post_id, $size = full ){
	
	$image = array();
		
	if ( $post_id && has_post_thumbnail( $post_id ) ){

		$img_id = get_post_thumbnail_id( $post_id );

		$img_url_array = wp_get_attachment_image_src( $img_id, $size, true );
		
		$image['id'] = $img_id;

		$image['src'] = $img_url_array[0];
		
		$image['alt'] = get_post_meta( $img_id, '_wp_attachment_image_alt', true );

	} // End if

	return $image;
	
} // End ignite_get_post_image

function ignite_get_post_image_array( $post_id ){
	
	$sizes = array('thumbnail','medium','large','full');
	
	$images = array();
		
	if ( $post_id && has_post_thumbnail( $post_id ) ){
		
		$img_id = get_post_thumbnail_id( $post_id );
		
		foreach( $sizes as $size ){
			
			$img_url_array = wp_get_attachment_image_src( $img_id, $size, true );
			
			$image = array(
				'id' 	=> $img_id,
				'src' 	=> $img_url_array[0],
				'alt' 	=> get_post_meta( $img_id, '_wp_attachment_image_alt', true ),
			);
			
			$images[$size] = $image;
			
		} // End foreach	

	} // End if

	return $images;
	
} // End ignite_get_post_image

/*
* Get the plugin directory path with added optional subdirectory
* @param string $subdirectory Subdirectory to add to base path
* @return string Full path
*/
function ignite_get_theme_path( $subdirectory = '' ){
	
	$path = CAHNRSIGNITEPATH;
	
	if ( ! empty( $subdirectory ) ){
		
		$path .= $subdirectory;
		
	}
	
	return $path;
	
} // End ignite_get_theme_path

/*
* Get the plugin directory url with added optional subdirectory
* @param string $subdirectory Subdirectory to add to base url
* @return string Full url
*/
function ignite_get_theme_url( $subdirectory = '' ){
	
	$url = CAHNRSIGNITEURL;
	
	if ( ! empty( $subdirectory ) ){
		
		$url .= $subdirectory;
		
	}
	
	return $url;
	
} // End ignite_get_theme_url

/*
* Get path to theme part
* @param string $subdirectory Subdirectory of the class
* @return string Path to file
*/
function ignite_get_part( $subdirectory ){
	
	$path = ignite_get_theme_path( $subdirectory );
	
	return $path;

} // End ignite_get_class

/*
* Load class from the plugin
* @param string $subdirectory Subdirectory of the class
* @param bool $include_once Use include (default) or include_once
*/
function ignite_load_class( $subdirectory, $include_once = false ){
	
	$path = ignite_get_theme_path( $subdirectory );
	
	if ( $include_once ){
		
		include_once $path;
		
	} else {
	
		include $path;
		
	} // End if

} // End ignite_get_class


function ignite_get_slides( $args = array() ){
	
	include_once ignite_get_theme_path( 'lib/factories/class-slide-factory-ignite.php' );
	
	$slide_factory = new Slide_Factory_Ignite();
	
	$slides = $slide_factory->get_slides( $args );
	
	return $slides;
	
} // End ignite_get_slides


function ignite_get_terms( $taxonomy, $include_empty = true, $as_select = true, $include_empty = true ){
	
	$return_terms = array();
	
	if ( $include_empty ){
		
		$return_terms[0] = 'No Category';
		
	} // end if
	
	$terms = get_terms( $taxonomy, array( 'hide_empty' => false, ) );
	
	if ( $as_select ){
		
		foreach( $terms as $term ){
			
			$return_terms[ $term->term_id ] = $term->name;
			
		} // End foreach
		
	} else {
		
		$return_terms = $terms;
		
	}// End if
	
	return $return_terms;
	
} // End ignite_get_terms
