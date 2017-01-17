<?php
/**
 * LA Times functions and definitions
 */

// Init WP.com VIP environment
require_once( WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php' );

// Maintenance Mode - Temporary
define( 'VIP_MAINTENANCE_MODE', true );
wpcom_vip_load_plugin( 'maintenance-mode' );

define( 'HSINSIDER_PATH', dirname( __FILE__ ) );
define( 'HSINSIDER_URL', get_template_directory_uri() );

// Config Loader
require_once( HSINSIDER_PATH . '/inc/site-config.php' );

// Switch certain resources based on whether this is in the WordPress.com VIP environment
if ( defined( 'WPCOM_IS_VIP_ENV' ) && true === WPCOM_IS_VIP_ENV ) {
	/**
	 * Disable global terms on WordPress.com.
	 */
	if ( function_exists( 'wpcom_vip_disable_global_terms' ) ) {
	    wpcom_vip_disable_global_terms();
	}
} else {
	require_once( HSINSIDER_PATH . '/inc/no-vip/no-vip-settings.php' );
}

// Activate and customize plugins
require_once( HSINSIDER_PATH . '/inc/plugins.php' );

// Admin customizations
if ( is_admin() ) {
	require_once( HSINSIDER_PATH . '/inc/admin.php' );
}

// wp-cli command
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once HSINSIDER_PATH . '/inc/cli.php';
}

// Ad integrations
require_once( HSINSIDER_PATH . '/inc/ads.php' );

// Ajax
require_once( HSINSIDER_PATH . '/inc/ajax.php' );

// Include classes used to integrate with external APIs
require_once( HSINSIDER_PATH . '/inc/api.php' );

// Manage static assets (js and css)
require_once( HSINSIDER_PATH . '/inc/assets.php' );

// Authors
require_once( HSINSIDER_PATH . '/inc/authors.php' );

// Include comments
require_once( HSINSIDER_PATH . '/inc/comments.php' );

// Customizer additions
require_once( HSINSIDER_PATH . '/inc/customizer.php' );

// Media includes
require_once( HSINSIDER_PATH . '/inc/media.php' );

// Navigation & Menus
require_once( HSINSIDER_PATH . '/inc/nav.php' );

// Query modifications and manipulations
require_once( HSINSIDER_PATH . '/inc/query.php' );

// Rewrites
require_once( HSINSIDER_PATH . '/inc/rewrites.php' );

// Search
require_once( HSINSIDER_PATH . '/inc/search.php' );

// Shortcodes
require_once( HSINSIDER_PATH . '/inc/shortcodes.php' );

// Include sidebars and widgets
require_once( HSINSIDER_PATH . '/inc/sidebars.php' );

// Helpers
require_once( HSINSIDER_PATH . '/inc/template-tags.php' );

// Theme setup
require_once( HSINSIDER_PATH . '/inc/theme.php' );

// Users
require_once( HSINSIDER_PATH . '/inc/users.php' );

// Zoninator zones/customizations
require_once( HSINSIDER_PATH . '/inc/zones.php' );

// Loader for partials
require_once( HSINSIDER_PATH . '/inc/partials.php' );

// Content types and taxonomies should be included below. In order to scaffold
// them, leave the Begin and End comments in place.
/* Begin Data Structures */

// FieldManager Fields
require_once( HSINSIDER_PATH . '/inc/fields.php' );

// Post Type Base Class
require_once( HSINSIDER_PATH . '/inc/post-types/class-hsinsider-post-type.php' );

//Custom Post Types
require_once( HSINSIDER_PATH . '/inc/post-types/class-hsinsider-post-type-video.php' );

// Taxonomy Base Class
require_once( HSINSIDER_PATH . '/inc/taxonomies/class-hsinsider-taxonomy.php' );

//Custom Taxonomies
require_once( HSINSIDER_PATH . '/inc/taxonomies/class-hsinsider-taxonomy-browse.php' );
require_once( HSINSIDER_PATH . '/inc/taxonomies/class-hsinsider-taxonomy-school.php' );

// Widget Base Class
require_once( HSINSIDER_PATH . '/inc/widgets/class-hsinsider-widget.php' );

//Custom Widgets
require_once( HSINSIDER_PATH . '/inc/widgets/class-hsinsider-widget-featured-items.php' );
require_once( HSINSIDER_PATH . '/inc/widgets/class-hsinsider-widget-polls.php' );
require_once( HSINSIDER_PATH . '/inc/widgets/class-hsinsider-widget-newsletter.php' );
require_once( HSINSIDER_PATH . '/inc/widgets/class-hsinsider-widget-ad-block.php' );
/* End Data Structures */

// Video Gallery
require_once( HSINSIDER_PATH . '/inc/eu-video-gallery.php' );