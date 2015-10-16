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
 * @package Blankstrap
 */

get_header(); ?>
<?php if( is_home() || is_category() ) : ?>
	<div class="jumbotron">
		<?php 
			$args = array(
				'post_type' => 'any',
				'post_status' => 'publish',
				'category_name' => 'featured',
				'posts_per_page' => 1
			);
			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) {
				$the_query->the_post();
				/**
				 * Get the template for the top featured post and save it's id
				 * in $curated so we can pull it from the main blogroll later
				 */
				ai_get_template_part( 'template-parts/content', 'featured' );
				$curated = get_the_ID();
				
				/**
				 * Always reset the post data after a wp_query
				 */
				wp_reset_postdata();
			}
		?>
	</div>
<?php endif; ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<section class="blogroll">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php

						/**
						 * Include the Post-Format-specific template for the content.
						 * Remove the $curated post from the blogroll
						 */
						if( $curated != get_the_ID() ) {
							ai_get_template_part( 'template-parts/content', 'excerpt' );
						}
					?>

				<?php endwhile; ?>
			</section>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php ai_get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->
<?php get_footer(); ?>
