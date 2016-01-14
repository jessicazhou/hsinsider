<?php
/**
 * Helper functions
 * Refactor if time allows
 */

if ( ! function_exists( 'hsinsider_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function hsinsider_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ' ', 'hsinsider' ) );
			if ( $categories_list && hsinsider_categorized_blog() ) {
				printf( '<div class="cat-links">' . __( '<h3>Posted in</h3> %1$s', 'hsinsider' ) . '</div>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ' ', 'hsinsider' ) );
			if ( $tags_list ) {
				printf( '<div class="tags-links">' . __( '<h3>Tagged</h3> %1$s', 'hsinsider' ) . '</div>', $tags_list );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( __( 'Leave a comment', 'hsinsider' ), __( '1 Comment', 'hsinsider' ), __( '% Comments', 'hsinsider' ) );
			echo '</span>';
		}

		edit_post_link( __( 'Edit', 'hsinsider' ), '<span class="edit-link">', '</span>' );
	}
endif;

function hsinsider_get_lead_art( $post = null ) {
	if( empty( $post ) ) {
		global $post;
	}

	if( has_post_thumbnail() ) {
		$featured_id = get_post_thumbnail_id( $post->ID );
	
		// Query for the Featured Image Caption
		$args = array(
			'p' => $featured_id,
			'post_type' => 'attachment',
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$featured_caption = get_the_excerpt();
			endwhile;
		endif;
		wp_reset_postdata();
		
		$featured_url = wp_get_attachment_url( $featured_id );

		$featured_html = '<figure><img src="' . $featured_url . '" class="attachment-post-thumbnail size-post-thumbnail wp-post-image img-responsive"/><figcaption class="wp-caption-text">' . $featured_caption . '</figcaption></figure>';
		echo $featured_html;
	}
}

/**
 * Retrieve and compile Post Byline Information
 */
function hsinsider_get_post_byline() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );
	}
	else {
		$time_string = sprintf( $time_string, esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );
	}

	$posted_on = '<span class="posted_on">' . _( $time_string ) . '</span>';

	$byline = hsinsider_get_coauthors() . $posted_on;
	$author = get_coauthors()[0];

	$avatar = '';
	if( !is_author() ) {
		$avatar = get_avatar( $author->ID, 96, '', '', array( 'class' => 'img-circle' ) );
	}

	echo '<figure class="byline">' . $avatar . '<figcaption>' . $byline . '</figcaption></figure>';
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function hsinsider_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'hsinsider_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'hsinsider_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so hsinsider_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so hsinsider_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in hsinsider_categorized_blog.
 */
function hsinsider_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'hsinsider_categories' );
}
add_action( 'edit_category', 'hsinsider_category_transient_flusher' );
add_action( 'save_post',     'hsinsider_category_transient_flusher' );

/**
 * Get the current school
 * Searches for the school based on current post, author page or school archive page
 */
function hsinsider_get_school( $post = null ) {

	$term = false;
	/**
	 * If we're on a school page, just return the current school object
	 */
	if( is_tax( 'school' ) ) {
		$term = get_queried_object();
	} 
	/**
	 * If we're on a an author page, get the term_id from the current author object
	 * author object and use it to find the School
	 */
	elseif ( is_author() ) {
		$author = get_queried_object();
	
		if( !empty( $author ) && is_object( $author ) ) {
			$term_id = (int) get_user_attribute( $author->ID, 'school', true );
		
			if( !empty( $term_id ) ) {
				$term = ( is_object( wpcom_vip_get_term_by( 'id', $term_id, 'school' ) ) ) ? wpcom_vip_get_term_by( 'id', $term_id, 'school' ) : false;
			}
			/*
			 * If the user doesn't have a school assigned, get the school from the post
			 */
			else {
				if( empty( $post ) ) {
					$post = get_post();
				}
				$terms = get_the_terms( $post->ID, 'school' );

				if( !empty( $terms ) && is_array( $terms ) ) {
					$term_id = $terms[0]->term_id;
					$term = ( is_object( wpcom_vip_get_term_by( 'id', $term_id, 'school' ) ) ) ? wpcom_vip_get_term_by( 'id', $term_id, 'school' ) : false;
				}
			}
		}
	}
	/**
	 * Default
	 * Find the School for the current post
	 */
	else {
		if( empty( $post ) ) {
			$post = get_post();
		}
		$terms = get_the_terms( $post->ID, 'school' );

		if( !empty( $terms ) && is_array( $terms ) ) {
			$term_id = $terms[0]->term_id;
			$term = ( is_object( wpcom_vip_get_term_by( 'id', $term_id, 'school' ) ) ) ? wpcom_vip_get_term_by( 'id', $term_id, 'school' ) : false;
		}
	}
	return $term;
}


/**
 * Gets the meta for the school from Fieldmanager
 */
function hsinsider_get_school_meta( $meta_key = null, $post = null ) {
	
	$school = hsinsider_get_school( $post );
	
	if( empty( $school ) )
		return false;

	$meta = Fieldmanager_Util_Term_Meta()->get_term_meta( $school->term_id, $school->taxonomy, 'school_info', true );

	if( empty( $meta_key ) )
		return $meta;
	
	if( isset( $meta[ $meta_key ] ) )
		return $meta[ $meta_key ];
		
	return false;
	
}


/**
 * Checks if the school has an image (set in fieldmanager)
 */
function hsinsider_has_school_image( $post = null ) {
	if( empty( $post ) ) {
		$post = get_post();
	}

	$attachment_id = hsinsider_get_school_meta( 'logo', $post );

	if( !empty( $attachment_id ) )
		return true;
	
	return false;
	
}


/**
 * Gets the school image (set in fieldmanager)
 */
function hsinsider_get_school_image( $image_size = 'thumbnail', $post = null ) {
	if( empty( $post ) ) {
		$post = get_post();
	}

	$attachment_id = hsinsider_get_school_meta( 'logo', $post );
	
	if( empty( $attachment_id ) )
		return false;
	
	return wp_get_attachment_image_src( $attachment_id, $image_size );
}


/**
 * Displays the school image (set in fieldmanager)
 */
function hsinsider_school_image( $size = 'thumbnail' ) {
	
	$image = hsinsider_get_school_image( $size );
	
	if( empty( $image ) )
		return false;
	
	echo '<img src="' . esc_url( reset( $image ) ) . '" class="school-image" width="' . intval( next( $image ) ) . '" height="' . intval( next( $image ) ) . '" />';
	
}


/**
 * Gets a link to the school page
 */
function hsinsider_get_school_link( $post = null ) {
	if( empty( $post ) ) {
		$post = get_post();
	}

	$term = hsinsider_get_school( $post );
	
	if( empty( $term ) )
		return;
	
	$term_link = wpcom_vip_get_term_link( $term, $term->taxonomy );
	
	if( empty( $term_link ) || is_wp_error( $term_link ) )
		return;
	
	return $term_link;

}


/**
 * Prints a link to the school page
 */
function hsinsider_school_link( $class = 'school', $post = null ) {
	if( empty( $post ) ) {
		$post = get_post();
	}
	
	$term = hsinsider_get_school( $post );
	
	if( empty( $term ) )
		return;
	
	$term_link = hsinsider_get_school_link( $post );
	
	if( empty( $term_link ) )
		return;
	
	echo '<a href="' . esc_url( $term_link ) . '" class="' . esc_attr( $class ) . '">' . esc_html( $term->name ) . '<i class="LATLinkOutArrow"></i></a>';

}

function hsinsider_author_school_link( $class = 'school' ) {
	
	$term_id = hsinsider_get_the_author_meta( 'school' );
	
	if( empty( $term_id ) )
		return false;
	
	$term = wpcom_vip_get_term_by( 'id', $term_id, 'school' );
		
	if( empty( $term ) )
		return false;
	
	$term_link = wpcom_vip_get_term_link( $term, $term->taxonomy );
	
	if( empty( $term_link ) || is_wp_error( $term_link ) )
		return false;
	
	echo '<a href="' . esc_url( $term_link ) . '" class="' . esc_attr( $class ) . '">' . esc_html( $term->name ) . '</a>';
	
}

function hsinsider_get_author_school_meta( $meta_key = null ) {
	
	$school_id = hsinsider_get_the_author_meta( 'school' );
	
	if( empty( $school_id ) )
		return false;

	$meta = Fieldmanager_Util_Term_Meta()->get_term_meta( $school_id, 'school', 'school_info', true );

	if( empty( $meta_key ) )
		return $meta;
	
	if( isset( $meta[ $meta_key ] ) )
		return $meta[ $meta_key ];
		
	return false;
}

/**
 * Get the author meta smartly based on whether we're in the loop or on a post author page
 */
function hsinsider_get_the_author_meta( $meta_key = false ) {
	
	global $coauthor;
	
	if( empty( $meta_key ) )
		return false;
	
	if( is_author() ) {
		$author = get_queried_object();
		if( empty( $author ) )
			return false;
		
		$author_id = $author->ID;
	} elseif( !empty( $coauthor ) && is_object( $coauthor ) ) {
		$author_id = $coauthor->ID;
	} else {
		$author_id = get_the_author_meta( 'ID' );
	}
	
	if( 'posts_url' == $meta_key )
		return get_author_posts_url( $author_id );
	
	if( 'school' == $meta_key )
		return (int) get_user_attribute( $author_id, '_lat_school', true );
	
	return get_the_author_meta( $meta_key, $author_id );
}

/**
 * Print schools within a name range (for nav)
 */
function hsinsider_school_range( $start = 'A', $end = 'Z' ) {

	$schools = get_terms( 'school', array( 'hide_empty' => false ) );
	
	foreach( $schools as $school ) {
		
		if( substr( $school->name, 0, 1 ) < $start || substr( $school->name, 0, 1 ) > $end )
			continue;
		
		$link = wpcom_vip_get_term_link( $school, $school->taxonomy );
		
		echo '<li><a href="' . esc_url( $link ) . '">' . esc_html( $school->name ) . '</a></li>';
	}
}

/**
 * Checks if the post author is staff or student
 */
function hsinsider_is_staff_post( $post = null ) {
	
	if( empty( $post ) )
		global $post;
	
	$user = get_user_by( 'id', $post->post_author );
	
	if( in_array( 'editor', $user->roles ) || in_array( 'administrator', $user->roles ) )
		return true;
	
	return false;
}

/**
 * Get the name of the menu assigned to a particular location
 * Can be used to give editors an easy way to change the name of a menu displaying in the theme
 */
function hsinsider_get_menu_name_by_location( $location = false ) {
	$locations = get_nav_menu_locations();
	
	if( empty( $locations[ $location ] ) )
		return false;
	
	$menu = wp_get_nav_menu_object( $locations[ $location ] );
	
	if( empty( $menu ) || empty( $menu->name ) )
		return;
	
	return $menu->name;
}

/**
 * Return the title without passing it through widont
 */
function hsinsider_get_the_title_no_widont( $post = null ) {
	
	remove_filter( 'the_title', 'widont' );
	return get_the_title( $post );
	add_filter( 'the_title', 'widont' );
}
