/**
 * LA Times HS Insider Recent & Popular Posts Widget Script
 *
 */
jQuery( document ).ready( function( $ ) {
	$( '#recent-widget-tabs .toggle a.btn' ).click( function( e ) {
		e.preventDefault();
		
		$( '#recent-widget-tabs .toggle a.btn' ).removeClass( 'active' );
		$( this ).addClass( 'active' );

		tab = $( this ).data( 'tab' );
		$( '#recent-widget .panel' ).removeClass( 'active' );		
		$( '#recent-widget #' + tab ).addClass( 'active' );
	} );
} );
