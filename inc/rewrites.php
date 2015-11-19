<?php
/**
 * Custom rewrite modifications
 */
function hsinsider_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'hsinsider_excerpt_more' );