<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HSInsider
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main container-fluid" role="main">
		<?php if( is_home() || is_category() ) : ?>
			<header class="hero jumbotron blogroll">
				<?php
					// Check if obj exists in cache
					$the_query = wp_cache_get( 'index_blogroll' );

					if( $the_query == false ) {
						// Create the query
					  $args = array(
							'post_type' => array( 'post', 'video' ),
							'post_status' => 'publish',
							'category_name' => 'hero',
							'posts_per_page' => 1
						);
						$the_query = new WP_Query( $args );
				    // Cache the results
				    wp_cache_set( 'index_blogroll', $the_query, '', 300 );
					}

					if ( $the_query->have_posts() ) {
						$the_query->the_post();
						/**
						 * Get the template for the top featured post and save it's id
						 * in $curated so we can pull it from the main blogroll later
						 */
						ai_get_template_part( 'template-parts/content', 'blogroll' );
						$curated = get_the_ID();

						/**
						 * Always reset the post data after a wp_query
						 */
						wp_reset_postdata();
					}
				?>
			</header>
		<?php endif; ?>

		<?php get_sidebar( 'featured' ); ?>
		<div class="row widget-area">
			<div class="container">
				<?php echo hsinsider_video_gallery(); ?>
			</div>
		</div>
		<?php if ( have_posts() ) : ?>
			<?php $post_count = 0; ?>
			<section class="blogroll row">
				<?php while ( have_posts() ) : the_post(); //the Loop ?>
					<?php
						/**
						 * Include the Post-Format-specific template for the content.
						 * Remove the $curated post from the blogroll
						 */
						if( $curated != get_the_ID() ) {
							ai_get_template_part( 'template-parts/content', 'blogroll' );
						}
						if( 0 == $post_count % 2 ) {
							ai_get_template_part( 'template-parts/module', 'mid-roll', array( 'post_count' => $post_count ) );
						}
						$post_count ++;
					?>
				<?php endwhile; ?>
			</section>

			<?php hsinsider_the_posts_navigation(); ?>

		<?php else : ?>

			<?php ai_get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
