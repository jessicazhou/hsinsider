<header id="masthead" class="site-header" role="banner">
	<nav id="navigation" <?php if( hsinsider_get_school() || is_category() ) { ?>class="has-school <?php if( hsinsider_has_school_image() ) { ?>has-school-image<?php } ?>"<?php } ?>>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a class="hsinsider-logo" href="<?php echo esc_url( home_url() ); ?>">
						<img class="img-responsive hidden-xs hidden-sm" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/static/images/hsinsider-logo-full.png' ); ?>" >
						<img class="img-responsive hidden-md hidden-lg" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/static/images/hsinsider-logo-small.png' ); ?>" >
					</a>
					<span class="tagline"><?php esc_html_e( 'For Students, By Students', 'hsinsider' ); ?></span>				
					<div class="menus">
						<div class="menus-wrapper">
							<span class="hidden-xs">
								<span class="trb_socialize_bar">
									<a target="_blank" class="trb_socialize_item" href="https://www.facebook.com/hsinsider" style="padding-left: 0px;">
										<i class="LATFacebook"></i>
									</a>
									<a target="_blank" class="trb_socialize_item" href=" https://twitter.com/hsinsider">
										<i class="LATTwitter"></i>
									</a>
									<a class="trb_socialize_item" href="mailto:<?php echo urlencode( get_option( 'admin_email' ) ); ?>"><i class="LATEmail"></i></a>		
								</span>
							</span>
							<button id="menu-about" class="menu menu-mobile hidden-xs">
								<?php echo esc_html( 'About' ); ?>
							</button>
							<button id="menu-schools" class="menu menu-mobile hidden-xs">
								<?php echo esc_html( 'Schools' ); ?>
							</button>
							<button id="menu-activities" class="menu menu-mobile hidden-xs">
								<?php echo esc_html( 'Topics' ); ?>
							</button>
							<button id="menu-hamburger" class="menu visible-xs-block">
								<i class="LATMenu"></i>
							</button>
							<button id="top-search" class="menu">
								<i class="LATSearch01"></i>
							</button>
						</div>
					</div>
					<div class="show-search">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
	</nav>
	
	<div class="menuwrapper">
		<menu data-menu="menu-schools">
			<ul class="menu-overlay">
				<li class="back">
					<a href="#" class="backLink"><i class="LATDDArrowLeft"></i><?php esc_html_e( 'Back to All' ); ?></a>
				</li>
				<?php foreach( range( 'A', 'Z' ) as $range ) : ?>
					<li class="school">
						<a id="<?php echo esc_attr( $range ); ?>"><?php echo esc_html( $range ); ?></a>
					</li>
					<?php hsinsider_school_range( $range, $range ); ?>
				<?php endforeach; ?>
			</ul>
			<div class="menu-container">
				<div class="title">Schools</div>
				<ul>
					<li>
						<a href="#">A-C <i class="LATDDArrowRight"></i></a>
					</li>
					<li>
						<a href="#">D-F <i class="LATDDArrowRight"></i></a>
					</li>
					<li>
						<a href="#">G-L <i class="LATDDArrowRight"></i></a>
					</li>
					<li>
						<a href="#">M-P <i class="LATDDArrowRight"></i></a>
					</li>
					<li>
						<a href="#">R-T <i class="LATDDArrowRight"></i></a>
					</li>
					<li>
						<a href="#">V-Z <i class="LATDDArrowRight"></i></a>
					</li>
				</ul>
			</div>
		</menu>
		<menu data-menu="menu-activities">
			<div class="sections">
				<?php if( ( $menu_name = hsinsider_get_menu_name_by_location( 'sections_menu' ) ) ) : ?>
					<div class="title"><?php echo esc_html( $menu_name ); ?></div>
				<?php endif; ?>
				<?php wp_nav_menu( array( 'theme_location' => 'sections_menu' ) ); ?>
			</div>
			<div class="topics">
				<?php if( ( $menu_name = hsinsider_get_menu_name_by_location( 'topics_menu' ) ) ) : ?>
					<div class="title"><?php echo esc_html( $menu_name ); ?></div>
				<?php endif; ?>		
				<?php wp_nav_menu( array( 'theme_location' => 'topics_menu' ) ); ?>
			</div>
		</menu>
		<menu data-menu="menu-about">
			<div class="about">
				<?php if( ( $menu_name = hsinsider_get_menu_name_by_location( 'about_menu' ) ) ) : ?>
					<div class="title"><?php echo esc_html( $menu_name ); ?></div>
				<?php endif; ?>
				<?php wp_nav_menu( array( 'theme_location' => 'about_menu' ) ); ?>
			</div>
		</menu>
	</div>
</header><!-- #masthead -->