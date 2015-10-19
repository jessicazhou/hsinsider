<?php
/**
 * This file holds configuration settings for widget areas.
 */

if ( function_exists('register_sidebar') ) {
	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'After-article',
		'id' => 'after-article-widgetized-area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'Footer Widgets',
		'id' => 'footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}

//returns the number of widgets in a sidebar for later use
function hsinsider_count_sidebar_widgets( $sidebar_id, $echo = false ) {
	$the_sidebars = wp_get_sidebars_widgets();
	if( !isset( $the_sidebars[$sidebar_id] ) )
		return __( 'Invalid sidebar ID' );
	else
		return count( $the_sidebars[$sidebar_id] );
}

//adjusts widget classes for horizonal sidebars based on the number of widgets the sidebar contains
function hsinsider_horizontal_sidebar_classes( $params ) {
	$sidebar_id = $params[0]['id'];
	if ( $sidebar_id == 'footer-widgets' ) {
		$widget_count = hsinsider_count_sidebar_widgets( $sidebar_id );
		$params[0]['before_widget'] = str_replace( 'class="', 'class="col-md-' . floor( 12 / $widget_count ) . ' ', $params[0]['before_widget'] );
	}
	return $params;
}
add_filter( 'dynamic_sidebar_params','hsinsider_horizontal_sidebar_classes' );

?>
