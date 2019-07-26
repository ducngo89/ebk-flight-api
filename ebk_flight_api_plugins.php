<?php
/*
Plugin Name: Flight API
Plugin URI: http://ebksoft.com/
Description: This is an API search & book flights.
Author: EBKSOFT
Version: 1.0
Author URI: http://ebksoft.com/
*/

//Start session
if( !session_id() ){
	session_start();
}

require_once("phpfastcache-final/phpfastcache.php");

// simple Caching with:
$cache = phpFastCache("redis");

/** WP_Widget_Text class */
require_once( ABSPATH  . '/wp-content/plugins/ebk-flights/ebk_widget_flight/class-wp-widget-flight-search.php' );

require_once( ABSPATH  . '/wp-content/plugins/ebk-flights/ebk_widget_flight/class-wp-widget-flight-result.php' );

require_once( ABSPATH  . '/wp-content/plugins/ebk-flights/ebk_widget_flight/class-wp-widget-flight-summary.php' );

require_once( ABSPATH  . '/wp-content/plugins/ebk-flights/ebk_widget_flight/class-wp-widget-flight-book.php' );

require_once( ABSPATH  . '/wp-content/plugins/ebk-flights/ebk_widget_flight/class-wp-widget-flight-book-result.php' );

?>

