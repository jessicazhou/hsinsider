<?php
/**
 * Custom post type for Videos.
 */
class HSInsider_Post_Type_Video extends HSInsider_Post_Type {

	/**
	 * Name of the custom post type.
	 *
	 * @var string
	 */
	public $name = 'video';

	/**
	 * Creates the post type.
	 */
	public function create_post_type() {
		register_post_type( $this->name, array(
			'labels' => array(
				'name'               => __( 'Videos', 'hsinsider' ),
				'singular_name'      => __( 'Video', 'hsinsider' ),
				'add_new'            => __( 'Add New Video', 'hsinsider' ),
				'add_new_item'       => __( 'Add New Video', 'hsinsider' ),
				'edit_item'          => __( 'Edit Video', 'hsinsider' ),
				'new_item'           => __( 'New Video', 'hsinsider' ),
				'view_item'          => __( 'View Video', 'hsinsider' ),
				'search_items'       => __( 'Search Videos', 'hsinsider' ),
				'not_found'          => __( 'No Videos found', 'hsinsider' ),
				'not_found_in_trash' => __( 'No Videos found in Trash', 'hsinsider' ),
				'parent_item_colon'  => __( 'Parent Video:', 'hsinsider' ),
				'menu_name'          => __( 'Videos', 'hsinsider' ),
			),
			'public' => true,
			'menu_position' => 5,
			'has_archive' => true,
			'rewrite' => array(
				'slug' => 'videos',
				'with_front' => false,
			),
			'show_in_nav_menus' => false,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'excerpt' ),
			'taxonomies' => array( 'category', 'post_tag', 'school' ),
			'post_status' => array( 'publish', 'pending', 'future', 'draft' ),
		) );
	}

}

$post_type_video = new HSInsider_Post_Type_Video();
