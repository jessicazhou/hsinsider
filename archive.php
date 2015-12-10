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
			<section class="hero jumbotron archive-header tag-category row">
				<div class="col-md-12">
					<h1 class="entry-title"><?php single_cat_title( '', true ); ?></h1>
					<p class="search-order">
						<?php $tag_id = get_query_var( 'tag_id' ); ?>
						<?php esc_html_e( 'Order by ', 'hsinsider'); ?>
						<?php if ( $order == 'ASC' ) : ?>
							<a href="<?php echo esc_url( get_tag_link( $tag_id ) . '?order=DESC' ); ?>"><?php esc_html_e( 'Newest', 'hsinsider' ); ?></a> |
							<span class="active-order"><?php esc_html_e( 'Oldest', 'hsinsider' ); ?></span>
						<?php else : ?>
							<span class="active-order"><?php esc_html_e( 'Newest', 'hsinsider' ); ?></span> |
							<a href="<?php echo esc_url( get_tag_link( $tag_id ) . '?order=ASC' ); ?>"><?php esc_html_e( 'Oldest', 'hsinsider' ); ?></a>
						<?php endif; ?>
					</p>
				</div>
			</section>

			<?php if ( have_posts() ) : ?>
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
	</div><!-- #primary -->

<?php get_footer(); ?>
