<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer container" role="contentinfo">
		<div class="row">
			<!-- Footer Widgets Go Here-->
			<div class="col-md-12">
				<div class="email_wrapper">
					<div class="email_text">
						<?php //echo wp_kses( $instance[ 'text' ], array( 'span' => array(), 'strong' => array(), 'em' => array() ) ); ?>
					</div>
					<form action="//latimes.us10.list-manage.com/subscribe/post?u=f089ecc9238c5ee13b8e5f471&amp;id=d721736bdd" method="post" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<div style="position: absolute; left: -5000px;"><input type="text" name="b_f089ecc9238c5ee13b8e5f471_d721736bdd" tabindex="-1" value=""></div>
						<input type="email" value="" placeholder="Enter your email address" name="EMAIL" class="required email">
						<input type="submit" value="Submit" name="subscribe">
					</form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'blankstrap' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'blankstrap' ), 'WordPress' ); ?></a>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
