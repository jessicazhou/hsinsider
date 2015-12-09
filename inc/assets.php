<?php
/**
 * Manage static assets
 */

/**
 * Enqueues scripts and styles for the frontend
 *
 * @return void
 */
function hsinsider_enqueue_assets() {
	
	// Enqueue Spiffy Google Fonts
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,200,600,200italic,300italic,400italic', array(), '1.0' );

	// Enqueue Main Stylesheet
	wp_enqueue_style( 'hsinsider-screen', get_template_directory_uri() . '/static/css/screen.css', array( 'google-fonts' ), '1.1' );

	// Deregister the jquery version bundled with wordpress
	wp_deregister_script( 'jquery' );

	// Register aJQuery and place in the footer
	wp_register_script( 'jquery', get_template_directory_uri() . '/static/js/jquery.min.js', array(), '2.1.4', true );

	// Global Script placed in the footer
	wp_register_script( 'hsinsider-global-js', get_template_directory_uri() . '/static/js/global.js', 'jquery', '1.2', true );

	wp_register_script( 'google-maps', 'http://maps.googleapis.com/maps/api/js?key=' . hsinsider_site_config( 'api.googlemaps' ) . '&v=3.14&callback=initMap', array( 'hsinsider-global-js' ), '1.0', true );
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-effects-slide' );
	wp_enqueue_script( 'hsinsider-global-js' );

	if( is_tax( 'school' ) || is_page_template( 'page-about.php' ) ) {
		// Google Maps Script
		wp_enqueue_script( 'google-maps' );
	}
}
add_action( 'wp_enqueue_scripts', 'hsinsider_enqueue_assets' );

/**
 * Enqueues scripts and styles for admin screens
 *
 * @return void
 */
function hsinsider_enqueue_admin() {
	// Admin-only JS and CSS includes
}
add_action( 'admin_enqueue_scripts', 'hsinsider_enqueue_admin' );

/**
 * Removes scripts that could potentially cause style conflicts
 *
 * @return void
 */
function hsinsider_dequeue_scripts() {
	wp_dequeue_style( 'jetpack-slideshow' );
	wp_dequeue_style( 'jetpack-carousel' );
}
add_action( 'wp_print_scripts', 'hsinsider_dequeue_scripts' );
