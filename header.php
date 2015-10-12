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
		<?php ai_get_template_part( 'template-parts/site', 'header' ); ?>
		<?php if( is_home() || is_category() ) : ?>
		<div class="jumbotron">
			<div id="banner" class="container-fluid">
			</div>
		</div>
		<?php endif; ?>
		<div id="content" class="site-content container">
			<div class="row hidden-sm hidden-xs">
				<div class="col-sm-12">
					<div class="leaderboard ad" id="div-gpt-ad-783778988016615787-1"></div>
				</div>
			</div>
