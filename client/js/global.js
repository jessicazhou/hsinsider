/**
 * If a gallery exists, run the YouTube Iframe API
 */
if( document.getElementById( "video-carousel" ) ) {
	var player;
	function onYouTubeIframeAPIReady() {
		console.log( 'player ready' );
		player = new YT.Player('player', {
			events: {
				'onStateChange': onPlayerStateChange
			}
		});
	}

	var done = false;
	function onPlayerStateChange( event ) {
		/*if (event.data == YT.PlayerState.PLAYING && !done) {
	        setTimeout(stopVideo, 6000);
	        done = true;
	    }*/
	}

	function stopVideo() {
		player.stopVideo();
	}

	function cueVideoById( youtube_id ) {
		player.cueVideoById( youtube_id );
	}
}