<?php
/**
 * This file holds configuration settings and functions for author related content including changes to Co-Authors Plus
 */
/**
* This file holds configuration settings and functions for author related content including changes to Co-Authors Plus
*/

function hsinsider_get_coauthors () {
	if ( function_exists( 'coauthors' ) ) { 
		$coauthors = coauthors_posts_links( null, null, null, null, false );
	} else { 
		$coauthors = the_author(); 
	}
	return $coauthors;
}