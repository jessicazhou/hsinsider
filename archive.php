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
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
				$terms = get_terms( 'school', array( 'hide_empty' => 0 ) ); 
				$markers = array();

				foreach( $terms as $term ) {
					$school_info = Fieldmanager_Util_Term_Meta()->get_term_meta( $term->term_id, 'school', 'school_info', false );

					if( ! empty( $school_info ) ) {
						$school_marker = array( 
							'school' => $term->name,
							'address' => $school_info[0]['address'] 
						);
						array_push( $markers, $school_marker );
					}
				}
				$markers = json_encode( $markers );
			?>
			<div id="gmap" data-markers='<?php echo $markers; ?>'></div>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					//get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>
