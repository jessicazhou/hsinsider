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
			<div class="site-info">
				<div class="col-sm-4">
					<a href="<?php echo esc_url( __( 'https://latimes.com/', 'hsinsider' ) ); ?>"><?php esc_html_e( 'Presented By', 'hsinsider' ); ?><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/static/images/latimes.svg' ); ?>"/></a>
				</div>
				<div class="col-sm-4 tronc">
					<a href="<?php echo esc_url( __( 'http://www.tronc.com/central-terms-of-service/', 'hsinsider' ) ); ?>" target="_blank" class="terms"><?php esc_html_e( 'Terms of Service', 'hsinsider' ); ?></a><?php esc_html_e( ' | ', 'hsinsider' ); ?><a href="<?php echo esc_url( __( 'http://www.tronc.com/privacy-policy/', 'hsinsider' ) ); ?>" target="_blank" class="policy"><?php esc_html_e( 'Privacy Policy', 'hsinsider' ); ?></a>
				</div>
				<div class="col-sm-4">
					<?php echo vip_powered_wpcom( 3 ); ?>
				</div>
			</div>
		</section>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
