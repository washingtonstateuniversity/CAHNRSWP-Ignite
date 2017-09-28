<?php 

$query_string = '?';

$page = get_page_by_path( 'site-404' , OBJECT );

if ( ! empty( $page ) ) { 

	$url = get_permalink( $page->ID );
	
	$query_string .= 'has-page=true&';
	
} else {
	
	$url = get_bloginfo( 'url' );
	
} // End if

$current_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
$url .= $query_string . 'not-found=' . urlencode ( $current_url );

wp_redirect( $url );
	
exit();