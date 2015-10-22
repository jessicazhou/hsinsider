<?php
/**
 * Widget to display the latest/most popular posts
 */
class HSInsider_Widget_Latest_Popular extends HSInsider_Widget {

	/**
	 * Name of the widget
	 *
	 * @var string
	 */
	public $name = 'Latest and Most Popular';
	public $description = 'Displays the latest posts and most popular posts';
	
	/**
	 * Create the Widget
	 */
	public function create_widget() {
		/**
		 * Register the widget
		 */
		register_widget( 'HSInsider_Widget_Latest_Popular' );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		
		$this->popular();
		
		echo $args['after_widget'];
	}
	
	private function popular() {
	
		$today = getdate();
		$args = array(
			'posts_per_page' => 4,
			'meta_query' => array('key' => 'post_views_count'),
			'orderby' => 'meta-value',
			'date_query' => array( 
					'after' => array(
						'year' => $today['year'],
						'day' => $today['mday'] - 3,
						'month' => $today['month']
					)
			)
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				get_template_part( 'template-parts/content', 'recent' );
			} 
		}
		wp_reset_query();
	}
}

$latest_popular_widget = new HSInsider_Widget_Latest_Popular(); 
