<?php

// Load Core's test suite
$_tests_dir = getenv('WP_TESTS_DIR');
if ( !$_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}
require_once $_tests_dir . '/includes/functions.php';

/**
 * Setup our environment (theme, plugins).
 */
function _manually_load_environment() {
	// Set our theme
	switch_theme( 'vip/hsinsider' );

	if ( ! defined( 'JETPACK_DEV_DEBUG' ) ) {
		define( 'JETPACK_DEV_DEBUG', true );
	}

	// Set active plugins
	update_option( 'active_plugins', array(
		'jetpack/jetpack.php'
	) );

	if ( ! defined( 'WP_CONTENT_DIR' ) ) {
		$cwd = explode( 'wp-content', dirname( __FILE__ ) );
		define( 'WP_CONTENT_DIR', $cwd[0] . '/wp-content' );
	}
}
tests_add_filter( 'muplugins_loaded', '_manually_load_environment' );

// Include core's bootstrap
require $_tests_dir . '/includes/bootstrap.php';
