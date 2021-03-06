<?php
/**
 * Widget to display the latest/most popular posts
 */
class HSInsider_Widget_Featured_Items extends HSInsider_Widget {

	/**
	 * Name of the widget
	 *
	 * @var string
	 */
	public $name = 'Featured';
	public $description = 'Displays the five most recent featured items';

	/**
	 * Create the Widget
	 */
	public function create_widget() {
		/**
		 * Register the widget
		 */
		register_widget( 'HSInsider_Widget_Featured_Items' );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		echo '<h2>' . esc_html( $instance['title'] ) . '</h2>';
		$this->get_featured();
		echo $args['after_widget'];
	}

	private function get_featured() {

		$today = getdate();
		$args = array(
			'posts_per_page' => 4,
			'post_type' => 'any',
			'post_status' => 'publish',
			'category_name' => 'featured',
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			),
			'orderby' => 'date',
		);

		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			ai_loop_template_part( $the_query, 'template-parts/content', 'featured' );
		}
		wp_reset_query();
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'hsinsider' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}
}

$featured_items_widget = new HSInsider_Widget_Featured_Items();
