<?php
/**
 * The template part for displaying a message that posts cannot be found.
 */
?>

<section class="no-results not-found">
	
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'hsinsider' ); ?></h1>

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'hsinsider' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'hsinsider' ); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help?', 'hsinsider' ); ?></p>

		<?php endif; ?>

		<div class="icon">
			<span class="fa-stack fa-3x">
				<i class="fa fa-search fa-4 fa-stack-2x"></i>
				<i class="fa fa-question fa-2 fa-stack-1x"></i>
			</span>
		</div>
	
</section><!-- .no-results -->
