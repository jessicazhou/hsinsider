/**
 * LA Times HS Insider Maps
 * This script uses the Google Maps API to display a map of Los Angeles
 * and populate it with markers for the participating schools
 */

/**
 * Callback function to initialize the map once the Google Maps API is loaded
 */

var map;
var bounds;
// I'd prefer to not have to use global vars, I couldn't think of another way to do it.
var delay = false;
var nextAddress = 0;
var lastAddress = 0;
var school_array = [];

function initMap() {
	if( jQuery( '#gmap' ).length ) {
		var styles = [
			{
				"featureType": "landscape.man_made",
				"stylers": [
					{ "color": "#fbfbfb" }
				]
			},{
				"featureType": "landscape.natural",
				"stylers": [
					{ "color": "#f1f1f1" }
				]
			},{
				"featureType": "water",
				"stylers": [
					{ "color": "#a3ddf4" }
				]
			},{
				"featureType": "road.highway",
				"elementType": "geometry.fill",
				"stylers": [
					{ "color": "#ffffba" }
				]
			},{
				"featureType": "road.highway",
				"elementType": "geometry.stroke",
				"stylers": [
					{ "color": "#ffd8b5" }
				]
			},{
				"featureType": "poi.park",
				"stylers": [
					{ "color": "#ccf1ba" }
				]
			},{
				"featureType": "poi.business",
				"elementType": "geometry",
				"stylers": [
					{ "color": "#edece6" }
				]
			}
		];

		var styledMap = new google.maps.StyledMapType( styles, {
			name: "Styled Map"
		});

		school_marker = jQuery( '#gmap' ).data( 'marker' );

		if( school_marker !== '' ) {

			var mapOptions = {
				center: { lat: 34.052235, lng: -118.243683 },
				zoom: 10,
				scrollwheel: false,
				zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL
				}
			};

			map = new google.maps.Map( document.getElementById( 'gmap' ), mapOptions );
			google.maps.event.trigger( map, 'resize' );

			// apply the styles
			map.mapTypes.set( 'map_style', styledMap );
			map.setMapTypeId( 'map_style' );

			bounds = new google.maps.LatLngBounds();

			if( jQuery.isArray( school_marker ) ) {
        school_array = school_marker;
        codeNextAddress();
			}
			else {
				geocodeAddress( school_marker );

				var fixBoundsZoom = google.maps.event.addListener( map, 'bounds_changed', function( event ) {
						map.setZoom( 9 );
						setTimeout( function() { google.maps.event.removeListener( fixBoundsZoom ) }, 2000 );
				} );
			}
		}
	}
}

function codeNextAddress() {
  if( nextAddress < school_array.length ) {
    if(delay){
      setTimeout( function() { geocodeAddress(school_array[nextAddress], codeNextAddress) }, 2500);
      delay = false;
    }
    else {
      geocodeAddress(school_array[nextAddress], codeNextAddress);
    }
    lastAddress = nextAddress;
    nextAddress++;
  }
}

function geocodeAddress( school_marker, next ) {
	/**
	 * Create geocoder object
	 */
	var geocoder;
	geocoder = new google.maps.Geocoder();

	var school_name = String( school_marker.school );
	/**
	 * Use geocoder to convert address into longitude and latitude
	 * and drop a pin on the map
	 */
	geocoder.geocode( { 'address': school_marker.address }, function( results, status ) {
		if ( status == google.maps.GeocoderStatus.OK ) {
			var marker = new google.maps.Marker( {
				map: map,
				position: results[0].geometry.location,
				title: school_name
			} );

			var infowindow = new google.maps.InfoWindow({
				content: school_name
			});

			marker.addListener( 'mouseover', function() {
				infowindow.open( map, marker );
			} );

			marker.addListener( 'mouseout', function() {
				infowindow.close();
			} );

			var LatLng = marker.getPosition();
			bounds.extend( LatLng );
			map.fitBounds( bounds );

		}
    else {
      // === if we were sending the requests to fast, try this one again and increase the delay
      if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
        if( lastAddress <= nextAddress ) {
          nextAddress--;
        }
        delay = true;
      }
      else {
        var reason="Code "+status;
        var msg = 'address="' + school_marker.address + '" error=' +reason+ '(delay='+delay+'ms)<br>';
        console.log( "Geocode was not successful for the following reason: " + msg );
      }
		}
    next();
	} );
}
