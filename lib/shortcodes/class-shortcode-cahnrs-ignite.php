<?php

class Shortcode_CAHNRS_Ignite {
	
	/**
	 * Borrowed from WSU_Syndicate_Shortcode_Base
	 * Create a hash of all attributes to use as a cache key. If any attribute changes,
	 * then the cache will regenerate on the next load.
	 *
	 * @param array  $atts      List of attributes used for the shortcode.
	 * @param string $shortcode Shortcode being displayed.
	 *
	 * @return bool|string False if cache is not available or expired. Content if available.
	 */
	public function get_content_cache( $atts, $shortcode ) {
		
		$atts_key = md5( serialize( $atts ) );

		$content = wp_cache_get( $atts_key, $shortcode );

		return $content;
		
	}

	/**
	 * Borrowed from WSU_Syndicate_Shortcode_Base	
	 * Store generated content from the shortcode in cache.
	 *
	 * @param array  $atts      List of attributes used for the shortcode.
	 * @param string $shortcode Shortcode being displayed.
	 * @param string $content   Generated content after processing the shortcode.
	 */
	public function set_content_cache( $atts, $shortcode, $content ) {
		
		$atts_key = md5( serialize( $atts ) );

		wp_cache_set( $atts_key, $content, $shortcode, 600 );
		
	}
	
	
} // End Shortcode_CAHNRS_Ignite