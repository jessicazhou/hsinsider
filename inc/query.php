<?php
/**
 * One-off query modifications and manipulations (e.g. through pre_get_posts).
 * Modifications tied to a larger features should reside with the rest of the
 * code for that feature.
 */

/*
 * Where are we in the loop?
 * Zero-based
 */
function hsinsider_the_query_post_position() {
	global $wp_query;
	
	return $wp_query->current_post;
}


/*
 * How many images do we have in the query?
 *
 */
function hsinsider_the_query_posts_with_images() {
	global $wp_query;
	
	if( empty( $wp_query->has_images ) || !is_array( $wp_query->has_images ) )
		return 0;
	
	return count( $wp_query->has_images );
}