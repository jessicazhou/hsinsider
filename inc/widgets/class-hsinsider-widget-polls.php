<?php
/**
 * Widget to display the latest poll from Polldaddy
 */
class HSInsider_Widget_Latest_Polls extends HSInsider_Widget {

	/**
	 * Name of the widget
	 *
	 * @var string
	 */
	public $name = 'Latest Polls';
	public $description = 'Displays the latest poll from Polldaddy.';
	
	/**
	 * Create the Widget
	 */
	public function create_widget() {
		/**
		 * Register the widget
		 */
		register_widget( 'HSInsider_Widget_Latest_Polls' );
	}

	public function esc_attr_excerpt( $excerpt ) {
		return esc_attr( trim( $excerpt ) );
	}

	public function widget( $args, $instance ) {
	
		if( is_single() ) {
			global $post;
			
			if( has_shortcode( $post->post_content, 'polldaddy' ) ) {
				return;
			}
		}
	
		$args = array(
			'browse' => 'polls',
			'numberposts' => 1
		);
		$poll = new WP_Query( $args );

		if( ! empty( $poll ) ) {

			add_filter( 'the_excerpt', array( &$this, 'esc_attr_excerpt' ), 99 );
			remove_filter( 'the_excerpt', 'wpautop' );

			if( $poll->have_posts() ) {
				while( $poll->have_posts() ) {
					$poll->the_post();
					$polldaddy_poll = get_post_meta( get_the_ID(), '_poll', true );
				
					if( ! empty( $polldaddy_poll ) ) {
						echo '
						<style type="text/css">
							.poll_wrapper .pds-answer:before {
								content: "' . the_excerpt() . '" !important;
								visibility: hidden !important;
							}
						</style>
						<div class="widget">
							<div class="poll_wrapper">
								<div class="poll_excerpt"><p>' . the_excerpt() . '</p></div>
								' . do_shortcode( '[polldaddy poll=' . intval( $polldaddy_poll ) . ']' ) . '
								<a href="' . the_permalink() . '" class="poll_link purple-light">' . esc_html( 'Read more', 'hsinsider' ) . '<span class="fa fa-angle-right"></a>
							</div>
						</div>';
					}
				}
			}
			
			remove_filter( 'the_excerpt', array( &$this, 'esc_attr_excerpt' ), 99 );
			add_filter( 'the_excerpt', 'wpautop' );
		}
	}
}

$latest_polls_widget = new HSInsider_Widget_Latest_Polls(); 
