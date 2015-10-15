<?php
/**
 * Custom rewrite modifications
 */

/**
 * Retrieve and compile Post Byline Information
 */
function hsinsider_get_post_byline() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="boomark">' . _( $time_string ) . '</a>';

	$byline = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';

	echo '<div class="byline"><span class="posted-on">' . $posted_on . '</span>&nbsp;|&nbsp;<span class="post-author">' . $byline . '</span></div>';
}

function hsinsider_excerpt_more( $more ) {
	return '&ellipsis;';
}
add_filter( 'excerpt_more', 'hsinsider_excerpt_more' );