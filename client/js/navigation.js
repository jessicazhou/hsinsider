/**
 * Controls the Navigation Menu and Search Form
 * Old Header and Navbar code
 * TODO: refactor if time allows
 */

var menuContainer = false;
var thisClick = false;
var backLinkTop = false;
jQuery( document ).ready( function( $ ) { 

	"use strict";
	
	// Scroll to top
	$( '.to-top' ).click( function(){ 
		$( 'html, body' ).animate( { scrollTop : 0 }, 800 );
		return false;
	} );

	/**
	 * Show/Hide Searchform
	 */
	$( '#top-search' ).on( 'click', function ( e ) { 
		e.preventDefault();

    	$( '.show-search' ).slideToggle( 'fast' );
    	$( 'button.menu-mobile' ).removeClass( 'active' );
	} );
	
	/**
	 * Show/Hide Menus
	 * Refactored: 10/15
	 */
	$( 'button.menu-mobile' ).click( function( e ) { 
		e.preventDefault();
		e.stopPropagation();

		/**
		 * If this is the active menu, close it
		 */
		if( $( this ).hasClass( 'active' ) ) { 
			menuContainer.hide( "slide", { direction: "right" }, 500 );
			menuContainer = false;

			$( this ).removeClass( 'active' );
		}

		else {
			
			/** 
			 * Make sure search bar is closed
			 */
			$( '.show-search' ).hide();

			/**
			 * If another menu is open, close it
			 */
			if( menuContainer ) { 
				menuContainer.hide( "slide", { direction: "right" }, 500 );
				menuContainer = false;
			}

			/** 
			 * Make this the active button/menu
			 */
			$( 'button.menu-mobile' ).removeClass( 'active' );
			$( this ).addClass( 'active' );

			menuContainer = $( 'menu[data-menu="' + $( this ).attr( 'id' ) + '"]' );

			$( '.menuwrapper' ).css( { 'marginTop':$( 'nav#navigation' ).position().top+$( 'nav#navigation' ).outerHeight( true )+1 } );
			$( '.menuwrapper' ).show();

			menuContainer.show( "slide", { direction: "right" }, 500 );

			$( 'html' ).click( 'menuOffClick' );
		}
	} );

	/** 
	 * Show/Hide School Lists
	 */
	$( 'a', 'menu[data-menu="menu-schools"]' ).click( function( e ) { 
		if( $( this ).attr( 'href' ) == '#' && !jQuery( this ).hasClass( 'backLink' ) ) { 
			e.preventDefault();
			
			backLinkTop = jQuery( this ).text().substr( 0, 1 );
			$( '.menu-overlay', 'menu[data-menu="menu-schools"]' ).show( "slide", { direction: "right" }, 490, function() { 
				jQuery( '.menu-overlay', 'menu[data-menu="menu-schools"]' ).scrollTop( jQuery( '.menu-overlay' ).scrollTop() - jQuery( '.menu-overlay' ).offset().top + jQuery( '#' + backLinkTop ).offset().top - 37 );
				jQuery( '.back', 'menu[data-menu="menu-schools"]' ).show();
			 } ).css( 'overflow', 'scroll' );
			jQuery( '.menu-overlay', 'menu[data-menu="menu-schools"]' ).scrollTop( jQuery( '.menu-overlay' ).scrollTop() - jQuery( '.menu-overlay' ).offset().top + jQuery( '#' + backLinkTop ).offset().top - 37 );
			
		 }
	 } );
	
	$( '.back a', 'menu[data-menu="menu-schools"]' ).click( function( e ) { 
		e.preventDefault();
		$( '.menu-overlay', 'menu[data-menu="menu-schools"]' ).hide( "slide", { direction: "right" }, 500 ).css( 'overflow', 'scroll' );
		$( '.back', 'menu[data-menu="menu-schools"]' ).hide();
	 } );
	
	/** 
	 * I think this hides an open menu when the page is clicked
	 */
	$( 'html' ).click( function( e ) { 

		/** 
		 * I have no idea what thisClick is for
		 * I suspect the original programmer didn't know
		 * about the e.stopPropagation() function
		 */
		if( thisClick ) { 
			thisClick = false;
			return;
		 }
		
		if( !menuContainer ) { 
			return;
		 }

		if( !menuContainer.is( e.target ) && menuContainer.has( e.target ).length === 0 ) { 
		
			if( $( '.menu-overlay' ).is( ':visible' ) ) { 
				$( '.menu-overlay', 'menu[data-menu="menu-schools"]' ).hide( "slide", { direction: "right" }, 500 );
				$( '.back', 'menu[data-menu="menu-schools"]' ).hide();
			 }
		
			if( $( 'a', '#menu-hamburger' ).hasClass( 'active' ) ) { 
				return hideMenuMobile();
			 }
		
			window.setTimeout( function() { 
				jQuery( '.menuwrapper' ).hide();
			 }, 500 );

			menuContainer.hide( "slide", { direction: "right" }, 500 );
			
			$( 'li', '.menu-mobile' ).removeClass( 'active' );
			
			menuContainer = false;
		 }
	
	} );
	

	/** 
	 * Code for the collapsed menu view.
	 * Removed for now, will add back in later
	 */
	$( 'a', '#menu-hamburger' ).click( function( e ) { 
		e.preventDefault();
		$( '.show-search' ).hide();

		if( !$( this ).hasClass( 'active' ) ) { 
			$( this ).addClass( 'active' );
			$( '.menuwrapper' ).css( { 'marginTop': $( 'nav#navigation' ).position().top + $( 'nav#navigation' ).outerHeight( true ) } );
			$( '.menuwrapper' ).show();

			jQuery( 'menu[data-menu="menu-activities"]' ).css( { 'paddingBottom': 10000 } );
			
			$( 'menu' ).show( "slide", { direction: "right" }, 500 );
			window.setTimeout( function() { 
				jQuery( '.menuwrapper' ).css( { 'backgroundColor': '#1c1c1c' } );
				jQuery( 'menu[data-menu="menu-activities"]' ).css( { 'paddingBottom': 0 } );
			 }, 500 );
			
			thisClick = true;
			menuContainer = jQuery( '.menuwrapper' );
		 }
	} );
	
	var hideMenuMobile = function() { 
		$( 'a', '#menu-hamburger' ).removeClass( 'active' );
		$( 'menu[data-menu="menu-activities"]' ).css( { 'paddingBottom': 10000 } );
		$( 'menu' ).hide( "slide", { direction: "right" }, 500 );
		
		jQuery( '.menuwrapper' ).css( { 'background': 'transparent' } );

		window.setTimeout( function() { 
			jQuery( '.menuwrapper' ).hide();
			jQuery( 'menu[data-menu="menu-activities"]' ).css( { 'paddingBottom': 0 } );
		 }, 500 );
	};
	
	$( '.poll_excerpt', '.poll_wrapper' ).css( 'top', ( $( '.pds-question' ).outerHeight() + 2 ) + 'px' );

	$( window ).scroll( function() { 
		sticky_navigation();
	} );
	
	$( window ).resize( function() { 
		sticky_navigation();
	} );
	
	/** 
	 * Sticky Navigation
	 * I don't know why this is in javascript
	 * Can and should be done in CSS
	 */
	var sticky_navigation_offset_top = $( 'nav#navigation' ).offset().top;
	var sticky_nav_current = 'absolute';
	var sticky_navigation = function() { 
		var scroll_top = $( window ).scrollTop(); // our current vertical position from the top
		
		// if we've scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
		if ( scroll_top > sticky_navigation_offset_top ) { 
			if( sticky_nav_current == 'absolute' ) { 
				$( 'nav#navigation' ).css( { 'position': 'fixed', 'top':0 } );
				$( '.menuwrapper' ).css( { 'marginTop':$( 'nav#navigation' ).position().top+$( 'nav#navigation' ).outerHeight( true )+1 } );
				sticky_nav_current = 'fixed';
			 }
		 } else { 
			if( sticky_nav_current == 'fixed' ) { 
				$( 'nav#navigation' ).css( { 'position': 'absolute', 'top': 'auto' } );
				$( '.menuwrapper' ).css( { 'marginTop':$( 'nav#navigation' ).position().top+$( 'nav#navigation' ).outerHeight( true )+1 } );
				sticky_nav_current = 'absolute';
			 } else { 
				$( '.menuwrapper' ).css( { 'marginTop':$( 'nav#navigation' ).position().top+$( 'nav#navigation' ).outerHeight( true )-scroll_top } );
			 }
		 }   
	};

	
} );
