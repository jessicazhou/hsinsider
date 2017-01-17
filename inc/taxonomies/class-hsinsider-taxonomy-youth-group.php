<?php
/*
 * Handles taxonomies, etc.
 *
 */

/*
 * Post URLS to include the slug of the youth group
 *
 */
// wpcom_vip_load_permastruct( '/%category%/%postname%/' );

class HSInsider_Taxonomy_Youth_Group extends HSInsider_Taxonomy {

	public $name = 'youth_group';

	public function create_taxonomy() {

		add_filter( 'pre_post_link', array( $this, 'permalink' ), 9, 2 );
		add_action( 'add_meta_boxes', array( $this, 'change_category_meta_box_name' ), 0 );
		add_action( 'template_redirect', array( $this, 'reorder_posts' ) );

		$labels = array(
			'name'                       => _x( 'Youth Groups', 'taxonomy general name' ),
			'singular_name'              => _x( 'Youth Group', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Youth Groups' ),
			'popular_items'              => __( 'Popular Youth Groups' ),
			'all_items'                  => __( 'All Youth Groups' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Youth Group' ),
			'update_item'                => __( 'Update Youth Group' ),
			'add_new_item'               => __( 'Add New Youth Group' ),
			'new_item_name'              => __( 'New Youth Group Name' ),
			'separate_items_with_commas' => __( 'Separate youth groups with commas' ),
			'add_or_remove_items'        => __( 'Add or remove youth groups' ),
			'choose_from_most_used'      => __( 'Choose from the most used youth groups' ),
			'not_found'                  => __( 'No youth groups found.' ),
			'menu_name'                  => __( 'Youth Groups' ),
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
	 * Replace our %youth_group% tag with the slug of the youth_group term,
	 * or just print hs-insider if there's no youth_group
	 *
	 */
	function permalink( $permalink, $post ) {

		if( empty( $permalink ) || empty( $post ) || strpos( $permalink, '%category%' ) < 0 )
			return $permalink;

		$youth_group = hsinsider_get_org( $post );

		if( ! empty( $youth_group ) ) {
			return str_replace( '%category%', $youth_group->slug, $permalink );
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

$hsinsider_youth_groups = new HSInsider_Taxonomy_Youth_Group;
