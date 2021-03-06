<?php
/**
 * Adds the 'Active Students' widget to the dashboard
 */

class HSInsider_Active_Users{
	
	function __construct() {
		add_action( 'wp_dashboard_setup', array( $this, 'setup' ) );
	}
	
	function setup() {
		wp_add_dashboard_widget(
			'active_users_widget',	// Widget slug.
			'Active Students',		// Title.
			array( $this, 'widget' )// Display function.
		);
	}
	
	function widget() {
		
		// Check if obj exists in cache
		$users = wp_cache_get( 'active_users' );
		 
		if( $users == false ) {
		    // Generate the query
		    $users = get_users( array( 'role' => 'student' ) );
		 
		    // Cache the results
		    wp_cache_set( 'active_users', $users, '', 300 );
		}

		//$users = get_users( array( 'role' => 'student' ) );
		$users_for_counts = array();
		foreach( $users as $user ) {
			$users_for_counts[] = $user->ID;
		}

		// Check if obj exists in cache
		$counts = wp_cache_get( 'user_count' );
		 
		if( $counts == false ) {
		    // Generate the obj
		    $counts = count_many_users_posts( $users_for_counts );
		 
		    // Cache the results
		    wp_cache_set( 'user_count', $counts, '', 300 );
		}

		arsort( $counts );
		$counts = array_slice( $counts, 0, 5, true );
		
		echo 'There are currently <strong>' . intval( count( $users ) ) . '</strong> students with HS Insider accounts.';
		echo '<p><strong>Most-active students:</strong></p><ul>';
		
		foreach( $counts as $user_id => $count ) {
			echo '<li><a href="' . esc_url( get_author_posts_url( $user_id ) ) . '" target=_blank>' . esc_html( get_the_author_meta( 'display_name', $user_id ) ) . '</a>: (<strong>' . intval( $count ) . '</strong>)</li>';
		}
		
		echo '</ul>';
		
	}
	
}

$active_users = new HSInsider_Active_Users;
