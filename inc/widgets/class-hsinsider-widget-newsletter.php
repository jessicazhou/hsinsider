<?php
/**
 * Widget to allow users to sign up for the site newsletter
 */
class HSInsider_Widget_Newsletter extends HSInsider_Widget {

	/**
	 * Name of the widget
	 *
	 * @var string
	 */
	public $name = 'Newsletter';
	public $description = 'Allows users to sign up for the newsletter';
	
	/**
	 * Create the Widget
	 */
	public function create_widget() {
		/**
		 * Register the widget
		 */
		register_widget( 'HSInsider_Widget_Newsletter' );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		?>
			<form action="//latimes.us10.list-manage.com/subscribe/post?u=f089ecc9238c5ee13b8e5f471&amp;id=d721736bdd" method="post" name="mc-embedded-subscribe-form" class="validate row" target="_blank" novalidate>
				<div class="col-xs-8 col-sm-9">
					<input type="hidden" name="b_f089ecc9238c5ee13b8e5f471_d721736bdd" tabindex="-1" value="">
					<input type="email" value="" placeholder="Enter your email address" name="EMAIL" class="required email">
				</div>
				<div class="col-xs-4 col-sm-3">
					<input type="submit" class="" value="Submit" name="subscribe">
				</div>
			</form>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
}

$newsletter_widget = new HSInsider_Widget_Newsletter(); 