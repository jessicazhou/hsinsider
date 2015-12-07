<?php
/**
 * This file holds configuration settings and functions for author related content including changes to Co-Authors Plus
 */
/**
* This file holds configuration settings and functions for author related content including changes to Co-Authors Plus
*/
function hsinsider_default_avatar( $avatar_defaults ) {
	$default_avatar = 'http://' . wpcom_vip_home_template_uri( '/static/images/hsinsider-logo-circle.gif' );
	$avatar_defaults[$default_avatar] = "HS Insider";
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'hsinsider_default_avatar' );


function hsinsider_get_coauthors() {
	if ( function_exists( 'coauthors' ) ) { 
		$coauthors = coauthors_posts_links( null, null, null, null, false );
	} else { 
		$coauthors = the_author(); 
	}
	return $coauthors;
}