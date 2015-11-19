/**
 * LA Times HS Insider Maps
 * This script uses the Google Maps API to display a map of Los Angeles
 * and populate it with markers for the participating schools
 */

/**
 * Callback function to initialize the map once the Google Maps API is loaded
 */

var map;

function initMap() {

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
		},{
		}
	];

	var styledMap = new google.maps.StyledMapType( styles, {
		name: "Styled Map"
	});

	school_marker = $( '#gmap' ).data( 'marker' );

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

		codeAddress( school_marker );
	}
}

function codeAddress( school_marker ) {
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
			map.setCenter( marker.getPosition() );
		} else {
			alert( "Geocode was not successful for the following reason: " + status );
		}
	} );
}
