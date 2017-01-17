<?php
/**
 * Custom rewrite modifications
 */
function hsinsider_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'hsinsider_excerpt_more' );

function hsinsider_the_posts_navigation() {
	if( ! is_single() ) {
		echo'<nav class="navigation post-navigation" role="navigation"><div class="nav-previous alignleft">'. get_next_posts_link( '<i class="LATArrowLeft01"></i>Older Articles' ) . '</div><div class="nav-next alignright">' . get_previous_posts_link( 'Newer Articles<i class="LATArrowRight01"></i>'  ) . '</div></nav>';
	} 
	else {
		echo'<nav class="navigation post-navigation" role="navigation"><div class="nav-previous alignleft">'. get_previous_post_link( '%link', '<i class="LATArrowLeft01"></i>%title'  ) . '</div><div class="nav-next alignright">' . get_next_post_link( '%link', '%title<i class="LATArrowRight01"></i>' ) . '</div></nav>';
	}
}