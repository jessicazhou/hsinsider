<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blankstrap
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container-fluid" role="main">
			<section class="hero jumbotron school-archive-header row">
				<div class="col-md-5">
					<?php
						the_archive_title( '<h1 class="entry-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</div><!-- .page-header -->
			</section>

			<?php if ( have_posts() ) : ?>
			<?php $post_count = 0; ?>
			<section class="blogroll row">
				<?php while ( have_posts() ) : the_post(); //the Loop ?>
					<?php
						/**
						 * Include the Post-Format-specific template for the content.
						 * Remove the $curated post from the blogroll
						 * TODO: Move jumbotron div into featured template
						 */
						ai_get_template_part( 'template-parts/content', 'blogroll' );
						$post_count ++;
						
						if( 0 == $post_count % 2 ) {
							ai_get_template_part( 'template-parts/module', 'mid-roll', array( 'post_count' => $post_count ) );
						}
					?>
				<?php endwhile; ?>
			</section>

			<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
