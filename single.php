<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blankstrap
 */

get_header(); ?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php //the_post_navigation(); ?>

		<?php endwhile; // End of the loop. ?>
		<?php get_sidebar( 'post' ); ?>
		</main><!-- #main -->
		<section class="comments">
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>
		</section>
	</div><!-- #primary -->

<?php get_footer(); ?>
