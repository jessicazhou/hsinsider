<?php

if ( ! function_exists( 'hsinsider_setup' ) ):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as
	 * indicating support post thumbnails.
	 */
	function hsinsider_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		// load_theme_textdomain( 'hsinsider', HSINSIDER_PATH . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add styles to visual editor
		add_editor_style( 'static/css/editor-style.css' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// Set up theme's use of wp_nav_menu().
		register_nav_menus( array(
			'sections_menu' =>	__( 'Sections', 'hsinsider' ),
			'topics_menu'	=>	__( 'Topics', 'hsinsider' ),
			'about_menu' 	=>	__( 'About', 'hsinsider' ),
		) );

		// Enable support for HTML5 components.
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );
	}
	add_action( 'after_setup_theme', 'hsinsider_setup' );
endif; // hsinsider_setup
