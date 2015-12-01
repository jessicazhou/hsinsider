<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HSInsider
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container-fluid" role="main">
			<section class="hero jumbotron archive-header row">

				<div class="container">
					<div class="author-info">
						<figure class="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'img-circle' ) ); ?>
						</figure><!-- #author-avatar -->
						<div class="author-description">
							<!-- School -->
							<?php hsinsider_school_link(); ?>
							<!-- Author Name -->
							<h1 class="entry-title author"><?php echo get_the_author(); ?></h1>
							<!-- Share -->
							<?php ai_get_template_part( 'template-parts/module', 'share', array( 'title' => get_the_author(), 'url' => esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) ) ); ?>
							<!-- Author Description -->
							
							<p>
							<?php if ( get_the_author_meta( 'description' ) ) : ?>
								<?php the_author_meta( 'description' ); ?>
							<?php endif; ?>
							</p>
						</div><!-- .author-description -->
					</div><!-- .author-info -->
				</div>

			</section>

			<?php if ( have_posts() ) : ?>
			<?php $post_count = 0; ?>
			<section class="blogroll row">
				<?php while ( have_posts() ) : the_post(); //the Loop ?>
					<?php
						/**
						 * Include the Post-Format-specific template for the content.
						 * Remove the $curated post from the blogroll
						 */
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
	</div><!-- #primary -->

<?php get_footer(); ?>
