// HS Insider Responsive Ads

var gptadslots = [];
var googletag = googletag || {};

googletag.cmd = googletag.cmd || [];
( function(){ var gads = document.createElement( 'script' );
	gads.async = true; gads.type = 'text/javascript';
	var useSSL = 'https:' == document.location.protocol;
	gads.src = ( useSSL ? 'https:' : 'http:' ) + '//www.googletagservices.com/tag/js/gpt.js';
	var node = document.getElementsByTagName( 'script' )[0];
	node.parentNode.insertBefore( gads, node );
} )();

var mappingHorizontal = null;
googletag.cmd.push( function() {

	mappingHorizontal = googletag.sizeMapping().addSize( [1024, 300], [[970, 300], [970, 250], [970, 90], [768, 90]] ).addSize( [0, 0], [[320, 50]] ).build();

	//Adslot 1 declaration
	gptadslots[1] = googletag.defineSlot( '/4011/trb.latimes/hsinsider/test', [[728, 90]], 'lat-hs-728x90' ).defineSizeMapping( mappingHorizontal ).setTargeting( 'pos', ['1'] ).addService( googletag.pubads() );

	//Adslot 2 declaration
	gptadslots[2] = googletag.defineSlot( '/4011/trb.latimes/hsinsider/test', [[300, 250]], 'lat-hs-300x250-1' ).setTargeting( 'pos', ['1'] ).addService( googletag.pubads() );

	//Adslot 3 declaration
	gptadslots[3] = googletag.defineSlot( '/4011/trb.latimes/hsinsider/test', [[300, 250]], 'lat-hs-300x250-2' ).setTargeting( 'pos', ['2'] ).addService( googletag.pubads() );

	//Adslot 4 declaration
	gptadslots[4] = googletag.defineSlot( '/4011/trb.latimes/hsinsider', [[970, 90], [728, 90]], 'div-gpt-ad-536534220936805316-1' ).setTargeting( 'pos', ['1'] ).addService( googletag.pubads() );

	//Adslot 5 declaration
	gptadslots[5] = googletag.defineSlot( '/4011/trb.latimes/hsinsider', [[300, 600], [300, 250]], 'div-gpt-ad-536534220936805316-2' ).setTargeting( 'pos', ['2'] ).addService( googletag.pubads() );

	//Adslot 6 declaration
	gptadslots[6] = googletag.defineOutOfPageSlot( '/4011/trb.latimes/hsinsider', 'div-gpt-ad-536534220936805316-oop' ).addService( googletag.pubads() );

	//Adslot 7 declaration
	gptadslots[7] = googletag.defineSlot( '/4011/trb.latimes/hsinsider', [[970, 90], [728, 90]], 'div-gpt-ad-783778988016615787-1' ).setTargeting( 'pos', ['1'] ).addService( googletag.pubads() );

	//Adslot 8 declaration
	gptadslots[8] = googletag.defineSlot( '/4011/trb.latimes/hsinsider', [[300, 600], [300, 250]], 'div-gpt-ad-783778988016615787-2' ).setTargeting( 'pos', ['2'] ).addService( googletag.pubads() );

	//Adslot 9 declaration
	gptadslots[9] = googletag.defineOutOfPageSlot( '/4011/trb.latimes/hsinsider', 'div-gpt-ad-783778988016615787-oop' ).addService( googletag.pubads() );

	googletag.pubads().setTargeting( 'ptype', ['sf'] );
	googletag.pubads().enableAsyncRendering();
	googletag.pubads().collapseEmptyDivs();
	googletag.enableServices();

	// Show the Ads
	googletag.display( 'div-gpt-ad-783778988016615787-1' );
	googletag.display( 'div-gpt-ad-783778988016615787-2' ); 
	googletag.display( 'lat-hs-728x90' );
	googletag.display( 'lat-hs-300x250-1' );
	googletag.display( 'lat-hs-300x250-2' );
} );

