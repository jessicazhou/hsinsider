<?php
/**
 * The template used for displaying page content in page.php
 */
?>

<header id="masthead" class="site-header" role="banner">
	<div class="topics-wrapper">
		<nav class="navbar navbar-default topics-nav">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo esc_url( get_home_url( '/' ) ); ?>"><?php esc_html_e( get_bloginfo( 'name', 'show' ) ); ?></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="main-navbar-collapse">
					<span class="topics-title"><?php _e( 'Topics', 'hsinsider' ); ?></span>
					<?php wp_nav_menu( array( 
						'theme_location' => 'topics',
						'container' => 'ul',
						'menu_id' => 'topics-menu',
						'menu_class' => 'nav navbar-nav'
					) ); ?>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
	</div>
	<div class="container branding">
		<div class="row vertical-align">
			<div class="col-xs-3 col-md-2">
				<a href="<?php echo esc_url( get_home_url( '/' ) ); ?>">
					<img class="hsinsider-logo img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/static/images/hsinsider-logo-2.png' ); ?>" >
				</a>
			</div>

			<div class="col-xxs-5 col-xs-4 col-sm-3 projectby">
				<div>
					<p>Brought to you by the</p>
					<img class="img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/static/images/latimes.svg' ); ?>" >
				</div>
			</div>
		</div>
	</div>
</header><!-- #masthead -->
