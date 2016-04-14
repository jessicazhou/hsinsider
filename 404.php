<?php
/**
 * The template for displaying 404 pages (not found).
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="page-content">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hsinsider' ); ?></h1>
					<p><?php esc_html_e( "It looks like this page doesn't exist. Why don't you go back to the ", 'hsinsider' ); ?><a href="<?php esc_url( home_url() ); ?>"><?php esc_html_e( 'Go Back to the Home Page', 'hsinsider' ); ?></a></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
