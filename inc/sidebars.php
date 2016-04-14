<?php
/**
 * This file holds configuration settings for widget areas.
 */

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name' => 'Featured Items',
		'id' => 'featured-posts',
		'before_widget' => '<div id="%1$s" class="widget %2$s container">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'Mid-Roll',
		'id' => 'mid-roll-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'Mid-Roll 2',
		'id' => 'mid-roll-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'Mid-Roll 3',
		'id' => 'mid-roll-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'Mid-Roll 4',
		'id' => 'mid-roll-4',
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
	register_sidebar( array(
		'name' => 'Single Post',
		'id' => 'single-post',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}

//returns the number of widgets in a sidebar for later use
function hsinsider_count_sidebar_widgets( $sidebar_id ) {
	$the_sidebars = wp_get_sidebars_widgets();
	if( !isset( $the_sidebars[$sidebar_id] ) )
		return __( 'Invalid sidebar ID' );
	else
		return count( $the_sidebars[$sidebar_id] );
}

//adjusts widget classes for horizonal sidebars based on the number of widgets the sidebar contains
function hsinsider_horizontal_sidebar_classes( $params ) {
	if( array_key_exists( 'id', $params[0] ) ) {
		$sidebar_id = $params[0]['id'];
		if ( 'footer-widgets' == $sidebar_id ) {
			$widget_count = hsinsider_count_sidebar_widgets( $sidebar_id );
			$params[0]['before_widget'] = str_replace( 'class="', 'class="' . esc_attr( 'col-md-' . floor( 12 / $widget_count ) . ' ' ), $params[0]['before_widget'] );
		}
		return $params;
	}
	return null;
}
add_filter( 'dynamic_sidebar_params','hsinsider_horizontal_sidebar_classes' );
