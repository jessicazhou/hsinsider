/**
 * Controls the Navigation Menu and Search Form
 * Old Header and Navbar code
 * TODO: refactor if time allows
 */

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

		if( $( 'menu.open' ).length ) {
			$( 'menu.open' ).hide( "slide", { direction: "right" }, 500, function( e ) {
				$( '.active' ).removeClass( 'active' );
				$( 'menu.open' ).removeClass( 'open' );
				$( '.menuwrapper' ).hide();
				$( '.menuwrapper' ).find( '.menu-overlay' ).hide();
				$( 'body' ).removeClass( 'noscroll' );
			} );
		}

    	$( '.show-search' ).slideToggle( 'fast' );
    	$( 'button.menu-mobile' ).removeClass( 'active' );
	} );
	
	/**
	 * Show/Hide Menus
	 * Refactored (again) : 11/2
	 */
	$( 'button.menu-mobile' ).click( function( e ) {
		e.preventDefault();
		e.stopPropagation();

		var currentMenu;

		if( $( this ).hasClass( 'active' ) ) {
			// find currently open menu and remove the open class
			currentMenu = $( 'menu.open' );
			currentMenu.removeClass( 'open' );

			//remove active class from button
			$( this ).removeClass( 'active' );
			
			//hide the menu
			currentMenu.hide( "slide", { direction: "right" }, 500, function( e ) {	
				$( '.menuwrapper' ).hide();
				currentMenu.find( '.menu-overlay' ).hide();
				$( 'body' ).removeClass( 'noscroll' );
			} );

		} else {
			// hide search bar
			$( '.show-search' ).hide( 'slide' );

			// remove active class from buttons
			$( '.active' ).removeClass( 'active' );
			$( this ).addClass( 'active' );
			currentMenu = $( 'menu[data-menu="' + $( this ).attr( 'id' ) + '"]' );
			
			// close any open menus
			if( $( 'menu.open' ).length ) {
				$( 'menu.open' ).hide( "slide", { direction: "right" }, 500, function ( e ) {
					
					// add open class to selected menu
					$( 'menu.open' ).removeClass( 'open' );
					currentMenu.addClass( 'open' );
					currentMenu.show( "slide", { direction: "right" }, 500, function ( e ) {
						currentMenu.find( '.menu-overlay' ).hide();
					} );
				} );
			
			} else {
				// add open class to selected menu
				currentMenu.addClass( 'open' );

				$( '.menuwrapper' ).css( { 'marginTop':$( 'nav#navigation' ).position().top + $( 'nav#navigation' ).outerHeight( true ) - 1 } );
				$( '.menuwrapper' ).show();

				currentMenu.show( "slide", { direction: "right" }, 500 );

				$( 'body' ).addClass( 'noscroll' );
			}
		}
	} );

	/** 
	 * Show/Hide School Lists
	 */
	$( 'a', 'menu[data-menu="menu-schools"]' ).click( function( e ) { 
		e.stopPropagation();
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
	 * Hide menu when page is clicked
	 * Refactored - 11/2
	 */
	$( '.menuwrapper' ).click( function( e ) {
		if( $( 'menu.open' ).length ) {
			$( 'button.menu.active' ).removeClass( 'active' );
			var currentMenu = $( 'menu.open' );
			currentMenu.hide( "slide", { direction: "right" }, 500, function( e ) {	
				$( '.menuwrapper' ).hide();
				currentMenu.removeClass( 'open' );
				currentMenu.find( '.menu-overlay' ).hide();
				$( 'body' ).removeClass( 'noscroll' );
			} );
		}
	} );
	
	/** 
	 * Code for the collapsed Hamburger Menu
	 * Refactored - 11/3
	 */
	$( '#menu-hamburger' ).click( function( e ) { 
		e.preventDefault();
		$( '.show-search' ).hide();

		if( !$( this ).hasClass( 'active' ) ) { 
			$( this ).addClass( 'active' );
			$( '.menuwrapper' ).css( { 'marginTop': $( 'nav#navigation' ).position().top + $( 'nav#navigation' ).outerHeight( true ) - 1 } );
			$( '.menuwrapper' ).show();

			jQuery( 'menu[data-menu="menu-activities"]' ).css( { 'paddingBottom': 10000 } );
			
			$( 'menu' ).show( "slide", { direction: "right" }, 500 );
			window.setTimeout( function() { 
				jQuery( 'menu[data-menu="menu-activities"]' ).css( { 'paddingBottom': 0 } );
			 }, 500 );
			
			$( 'body' ).addClass( 'noscroll' );

		} else {
			$( '#menu-hamburger' ).removeClass( 'active' );
			$( 'menu[data-menu="menu-activities"]' ).css( { 'paddingBottom': 10000 } );
			$( 'menu' ).hide( "slide", { direction: "right" }, 500 );
			
			jQuery( '.menuwrapper' ).css( { 'background': 'transparent' } );

			window.setTimeout( function() { 
				jQuery( '.menuwrapper' ).hide();
				jQuery( 'menu[data-menu="menu-activities"]' ).css( { 'paddingBottom': 0 } );
			}, 500 );

			$( 'body' ).removeClass( 'noscroll' );
		}
	} );
	
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
