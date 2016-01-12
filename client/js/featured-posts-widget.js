/**
 * LA Times HS Insider Recent & Popular Posts Widget Script
 *
 */
jQuery( document ).ready( function( $ ) {
	$(window).on( 'load resize', adjustFeaturedItems );
	function adjustFeaturedItems() {
		newHeight = 0;
		$( '#featured .reduced' ).each( function( e ) {
			// Make sure each element is at it's deal height
			idealHeight = $( 'figure', $( this ) ).height() +  $( '.post-info', $( this ) ).height();
			if( $( this ).height() != idealHeight ) {
				$( this ).height( idealHeight );
			}

			// Find the tallest element
			thisHeight = $( this ).height();
			if( thisHeight > newHeight ) {
				newHeight = thisHeight;
			}
		} );

		// Set all elements heights to the tallest one
		$( '#featured .reduced' ).each( function( e ) {
			$( this ).height( newHeight );
		} );
	}
} );
