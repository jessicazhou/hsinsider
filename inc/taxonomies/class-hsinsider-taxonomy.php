<?php

/**
 * Abstract class for post type classes
 */
abstract class HSInsider_Taxonomy {

	/**
	 * Name of the taxonomy
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Create the taxonomy.
		add_action( 'init', array( $this, 'create_taxonomy' ) );
	}

	/**
	 * Create the taxonomy.
	 */
	abstract public function create_taxonomy();

}
