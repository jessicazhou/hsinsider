<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package HSInsider
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main container-fluid" role="main">

			<?php if ( have_posts() ) : ?>
			<header class="page-header row">
				<div class="container">
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'hsinsider' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</div>
			</header><!-- .page-header -->

			<?php $post_count = 0; ?>
			<section class="blogroll row">
				<?php while ( have_posts() ) : the_post(); //the Loop ?>
					<?php
						ai_get_template_part( 'template-parts/content', 'blogroll' );
						$post_count ++;
						
						if( 0 == $post_count % 2 ) {
							ai_get_template_part( 'template-parts/module', 'mid-roll', array( 'post_count' => $post_count ) );
						}
					?>
				<?php endwhile; ?>
			</section>

			<?php hsinsider_the_posts_navigation(); ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
