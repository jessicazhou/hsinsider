<?php
/**
 * The template used for displaying page content in page.php
 */
?>

<header id="masthead" class="site-header" role="banner">
	<nav id="navigation" <?php if( hsinsider_get_school() || is_category() ) { ?>class="has-school <?php if( hsinsider_has_school_image() ) { ?>has-school-image<?php } ?>"<?php } ?>>
		<div class="container">
			<img class="hsinsider-logo img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/static/images/hsinsider-logo-2.png' ); ?>" >

			<?php if( hsinsider_has_school_image() ) : ?>
				<a href="<?php echo esc_url( hsinsider_get_school_link() ); ?>"><?php hsinsider_school_image(); ?></a>
			<?php endif; ?>
			
			<?php 
				if( hsinsider_get_school() ) :
					hsinsider_school_link();
				elseif( is_category() ) :
					$category = get_queried_object(); ?>
					<a href="<?php echo esc_url( wpcom_vip_get_term_link( $category, $category->taxonomy ) ); ?>" class="school topic"><?php echo esc_html( $category->name ); ?></a>
			<?php endif; ?>
			
			<div class="menus">
				<div class="menus-wrapper">
					<ul id="menu-schools" class="menu menu-mobile">
						<li>
							<a href="#">Schools & Organizations<i class="fa fa-angle-down"></i></a>
						</li>
					</ul>
					<ul id="menu-activities" class="menu menu-mobile">
						<li>
							<a href="#"><?php esc_html_e( 'Topics', 'hsinsider' ); ?><i class="fa fa-angle-down"></i></a>
						</li>
					</ul>
					<ul id="top-search" class="menu">
						<li>
							<a href="#" class="trb_nav_search_form_submit"><i class="fa fa-search"></i></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="show-search">
				<?php get_search_form(); ?>
			</div>
		</div>
	</nav>
	
	<menuwrapper>
		<menu data-menu="menu-schools">
			<ul class="menu-overlay">
				<li class="back"><a href="#" class="backLink"><i class="fa fa-angle-left"> Back to all</i></a></li>
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
						<a href="#">A-C <i class="fa fa-angle-right"></i></a>
					</li>
					<li>
						<a href="#">D-F <i class="fa fa-angle-right"></i></a>
					</li>
					<li>
						<a href="#">G-L <i class="fa fa-angle-right"></i></a>
					</li>
					<li>
						<a href="#">M-P <i class="fa fa-angle-right"></i></a>
					</li>
					<li>
						<a href="#">R-T <i class="fa fa-angle-right"></i></a>
					</li>
					<li>
						<a href="#">V-Z <i class="fa fa-angle-right"></i></a>
					</li>
				</ul>
			</div>
		</menu>
		<menu data-menu="menu-activities">
			<div class="sections">
				<?php if( ( $menu_name = hsinsider_get_menu_name_by_location( 'sections_menu' ) ) ) : ?>
					<div class="title"><?php esc_html_e( $menu_name, 'hsinsider' ); ?></div>
				<?php endif; ?>
				<?php wp_nav_menu( array( 'theme_location' => 'sections_menu' ) ); ?>
			</div>
			<div class="topics">
				<?php if( ( $menu_name = hsinsider_get_menu_name_by_location( 'topics_menu' ) ) ) : ?>
					<div class="title">
						<i class="fa fa-flash"></i> <?php esc_html_e( $menu_name, 'hsinsider' ); ?>
					</div>
				<?php endif; ?>		
				<?php wp_nav_menu( array( 'theme_location' => 'topics_menu' ) ); ?>
			</div>
		</menu>
	</menuwrapper>
</header><!-- #masthead -->