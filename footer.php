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
			<div class="row">
				<!-- Footer Widgets Go Here-->
				<?php get_sidebar( 'footer' ); ?>
			</div>
			<div class="row">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'blankstrap' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'blankstrap' ), 'WordPress' ); ?></a>
				</div>
			</div>
		</section>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
