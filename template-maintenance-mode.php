<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<div id="content" class="site-content">

			<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/screenshot.png' ); ?>" style="display: block; margin: 0 auto; width: 100%; max-width: 446px; height: auto;">
			<header class="archive-header" style="border-bottom: 0px;">
				<h1 class="entry-title" style="text-align: center; width: 100%"><?php esc_html_e( 'Under Construction', 'hsinsider' ); ?></h1>
			</header>

			<section>
				<p style="width: 100%; max-width: 646px; margin: 0 auto; padding: 0px 15px; text-align: center; font-size: 18px; line-height: 1.6em;">
					<?php esc_html_e( "We're doing some spring cleaning and adding new features!  Don't worry though, you can still log on and workon your stories while we're doing our thing!", 'hsinsider' ); ?>
				</p>
			</section>

		</div>
	</div>
</body>
<?php wp_footer(); ?>
</html>