<?php
/*
 * Handles taxonomies, etc.
 *
 */

/*
 * Post URLS to include the slug of the school
 *
 */
// wpcom_vip_load_permastruct( '/%category%/%postname%/' );

class HSInsider_Taxonomy_School extends HSInsider_Taxonomy {

	public $name = 'school';

	public function create_taxonomy() {

		add_filter( 'pre_post_link', array( $this, 'permalink' ), 9, 2 );
		add_action( 'add_meta_boxes', array( $this, 'change_category_meta_box_name' ), 0 );
		add_action( 'template_redirect', array( $this, 'reorder_posts' ) );

		$labels = array(
			'name'                       => _x( 'Schools', 'taxonomy general name' ),
			'singular_name'              => _x( 'School', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Schools' ),
			'popular_items'              => __( 'Popular Schools' ),
			'all_items'                  => __( 'All Schools' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit School' ),
			'update_item'                => __( 'Update School' ),
			'add_new_item'               => __( 'Add New School' ),
			'new_item_name'              => __( 'New School Name' ),
			'separate_items_with_commas' => __( 'Separate schools with commas' ),
			'add_or_remove_items'        => __( 'Add or remove schools' ),
			'choose_from_most_used'      => __( 'Choose from the most used schools' ),
			'not_found'                  => __( 'No schools found.' ),
			'menu_name'                  => __( 'Schools' ),
		);

    register_taxonomy( $this->name,
			array( 'post', 'video' ),
			array(
				'labels' => $labels,
				'hierarchical' => true,
				'rewrite' => array( 'slug' => $this->name ),
			)
		);
	}

	/*
	 * Reorder the posts in the query by putting posts with photos first.
	 *
	 */
	function reorder_posts() {
		global $wp_query;

		if( !is_tax() && !is_category() && !is_tag() )
			return;

		$have_images = array();
		$no_image = array();

		foreach( $wp_query->posts as $post ) {
			if( count( $have_images ) < 4 && has_post_thumbnail( $post->ID ) ) {
				$have_images[] = $post;
			} else {
				$no_image[] = $post;
			}
		}

		$wp_query->has_images = $have_images;
		$wp_query->posts = array_merge( $have_images, $no_image );
	}

	/*
	 * Replace our %school% tag with the slug of the school term,
	 * or just print hs-insider if there's no school
	 *
	 */
	function permalink( $permalink, $post ) {

		if( empty( $permalink ) || empty( $post ) || strpos( $permalink, '%category%' ) < 0 )
			return $permalink;

		$school = hsinsider_get_school( $post );

		if( ! empty( $school ) ) {
			return str_replace( '%category%', $school->slug, $permalink );
		}
		else {
			return str_replace( '%category%', 'hs-insider', $permalink );
		}
	}

	public function change_category_meta_box_name() {

		global $wp_meta_boxes;

		unset( $wp_meta_boxes[ 'post' ][ 'side' ][ 'core' ][ 'categorydiv' ] );
		add_meta_box( 'categorydiv', __( 'Sections' ), 'post_categories_meta_box', 'post', 'side', 'low' );
	}
}

$hsinsider_schools = new HSInsider_Taxonomy_School;
