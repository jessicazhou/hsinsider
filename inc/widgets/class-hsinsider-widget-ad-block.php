<?php
/**
 * Widget to display the latest/most popular posts
 */
class HSInsider_Widget_Ad_Block extends HSInsider_Widget {

	/**
	 * Name of the widget
	 *
	 * @var string
	 */
	public $name = 'Ad Block';
	public $description = 'Renders a GPT ad block';
	
	/**
	 * Create the Widget
	 */
	public function create_widget() {
		/**
		 * Register the widget
		 */
		register_widget( 'HSInsider_Widget_Ad_Block' );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		echo '<div class="ad hidden-xs" id="' . $instance['ad_tag'] . '"></div>';
		echo '<div class="ad visible-xs-block" id="' . $instance['ad_tag_m'] . '"></div>';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$tag= !empty( $instance['ad_tag'] ) ? $instance['ad_tag'] : __( 'Ad Tag', 'hsinsider' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_tag' ); ?>"><?php _e( 'Desktop Ad Tag:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad_tag' ); ?>" name="<?php echo $this->get_field_name( 'ad_tag' ); ?>" type="text" value="<?php echo esc_attr( $tag ); ?>">
		</p>

		<?php
		$tag= !empty( $instance['ad_tag_m'] ) ? $instance['ad_tag_m'] : __( 'Ad Tag', 'hsinsider' );
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_tag_m' ); ?>"><?php _e( 'Mobile Ad Tag:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad_tag_m' ); ?>" name="<?php echo $this->get_field_name( 'ad_tag_m' ); ?>" type="text" value="<?php echo esc_attr( $tag ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['ad_tag'] = ( !empty( $new_instance['ad_tag'] ) ) ? strip_tags( $new_instance['ad_tag'] ) : '';
		$instance['ad_tag_m'] = ( !empty( $new_instance['ad_tag_m'] ) ) ? strip_tags( $new_instance['ad_tag_m'] ) : '';

		return $instance;
	}
}

$ad_blocks_widget = new HSInsider_Widget_Ad_Block(); 