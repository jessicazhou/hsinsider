<?php
/**
 * Base Widget class for HSInsider
 */
abstract class HSInsider_Widget extends WP_Widget {
	
	/**
	 * Name of the widget
	 *
	 * @var string
	 */
	public $name = null;
	public $description = null;

	/**
	 * Constructor
	 */
	public function __construct() {
		// Create the Widget
		parent::__construct( false, __( $this->name, 'hsinsider' ), array( 'description' => __( $this->description, 'hsinsider' ) ) );
		
		add_action( 'widgets_init', array( $this, 'create_widget' ) );
	}

	/**
	 * Create the Widget
	 */
	abstract public function create_widget();
}
