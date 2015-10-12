<?php
/**
 * This file holds configuration settings required for non-VIP environments
 */

/**
 * Unregisters Jetpack widgets to accurately display the widgets available to editors in the production environment
 *
 * @access public
 * @return void
 */
function hsinsider_unregister_jetpack_widgets() {
	// Jetpack widgets
	unregister_widget( 'WPCOM_Widget_Facebook_LikeBox' );
	unregister_widget( 'Jetpack_Gravatar_Profile_Widget' );
	unregister_widget( 'Jetpack_Image_Widget' );
	unregister_widget( 'Jetpack_RSS_Links_Widget' );
	unregister_widget( 'Jetpack_Readmill_Widget' );
	unregister_widget( 'Jetpack_Widget_Twitter' );
}
add_action( 'widgets_init', 'hsinsider_unregister_jetpack_widgets', 20 );
