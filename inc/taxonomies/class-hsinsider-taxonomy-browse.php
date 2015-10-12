<?php

/**
 * Abstract class for post type classes
 */
class HSInsider_Taxonomy_Browse extends HSInsider_Taxonomy {

	/**
	 * Name of the taxonomy
	 *
	 * @var string
	 */
	public $name = 'browse';

	/**
	 * Create the taxonomy.
	 */
	public function create_taxonomy() {
		register_taxonomy( $this->name,
			'post',
			array(
				'labels' => array( 'name' => 'Browse', 'singular_name' => 'Browse' ),
				'hierarchical' => false,
				'display_ui' => false,
				'public' => true,
			)
		);
	}
}

$browse_taxonomy = new HSInsider_Taxonomy_Browse();
