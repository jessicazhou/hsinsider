<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 */
?>

	</div><!-- #content -->

	<footer class="site-footer" role="contentinfo">
		<section class="container">
			<!-- Footer Widgets Go Here-->
			<?php get_sidebar( 'footer' ); ?>
			<div class="row">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://latimes.com/', 'hsinsider' ) ); ?>"><?php esc_html_e( 'Presented By', 'hsinsider' ); ?><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/static/images/latimes.svg' ); ?>"/></a>
				</div>
			</div>
		</section>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
