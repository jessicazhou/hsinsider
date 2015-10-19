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
	?>
		<ul id="recent-widget-tabs" class="nav nav-tabs" role="tablist">
			<li class="toggle active" role="presentation">
				<a href="#popular" role="tab" aria-controls="popular" data-toggle="tab">Popular</a>
			</li>
				
			<li class="toggle" role="presentation">
				<a href="#recent" role="tab" aria-controls="recent" data-toggle="tab">Recent</a>
			</li>
		</ul>
		<div id="recent-widget" class="tab-content">
			<div id="popular" class="tab-pane active">
				<h3>Popular Posts</h3>
				<?php $this->popular() ?>
			</div>
			<div id="recent" class="tab-pane">
				<h3>Recent Posts</h3>
				<?php $this->recent() ?>
			</div>
		</div>
	<?php
		echo $args['after_widget'];
	}
	
	private function popular() {
	
		$today = getdate();
		$args = array(
			'posts_per_page' => 5,
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
	
	private function recent() {

		$args = array( 
			'posts_per_page' => 5,  
			'orderby' => 'date', 
			'order' => 'desc'
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
