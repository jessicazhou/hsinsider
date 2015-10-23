/**
 * eu_gallery.js
 * Script to handle gallery 'Popout' transition
 * Author: James Perez
 * Created On: 08/19/15
 */	    

$( document ).ready( function(){

	/**
	 * If a gallery doesn't exist on this page, then don't do anything
	 */
	if( $( '.eu_gallery_container' ).length ) {
		/**
		 * Use javascript to compile parameters for gigya
		 */
		$( '.eu_gallery li figure' ).each( function () {
			featured_img = $( this ).find( 'img' ).attr( 'src' );
			permalink = window.location.href;
			the_title = document.title;
			target = $( this ).find( '.gigya-post > div' ).attr( 'id' );
			icon_path = $( this ).closest( '.eu_gallery' ).data( 'icon-path' );

			var share_args = { 
				featured_img: featured_img, 
				permalink: permalink, 
				the_title: the_title, 
				target: target, 
				icon_path: icon_path 
			};

			emergingusShowShareUI( share_args );
		});

		/**
		 * Use javascript to handle control responsive control positioning
		 * Necessary due to dynamic container heights making css percentages impossible
		 */
		$(window).on( 'load resize', euGalleryAdjust );

		/**
		 * Append the expansion button to the slider
		 */
		$( '.eu_gallery_container .orbit-container' ).append( $( '<button class="eu_expand_gallery"><i class="fa fa-expand"></i></button>' ) );
		
		/**
		 * Remove extra whitespace in eu_slide_number for formatting
		 */
		slide_number = $( '.eu_slide_number' ).html();
		slide_number = slide_number.replace(/\s+/g, '');

		$( '.eu_slide_number' ).html( slide_number );

		$( 'button.eu_expand_gallery' ).click( function( e ) {
			e.stopPropagation();

			container = '.eu_gallery_container';
			
			if( !$(container).hasClass( 'expand' ) ) {

				/**
				 * stop the main page from scrolling and disable resize listener
				 */
				$('body').css( {'overflow': 'hidden' } );
				$(document).bind('scroll',function () { 
					window.scrollTo( 0, 0 ); 
				});
				 $(window).off( 'load resize' );

				$( '.eu_expand_gallery' ).html( '<i class="fa fa-close"></i>' );

				/**
				 * get the gallery container's current width and position
				 */
				start_pos = $( container ).offset();
				start_width = $( container ).width();

				/** 
				 * make the gallery container fixed so it can become an overlay 
				 */
				$( container ).css( 'position', 'fixed');
				$( container ).css( 'z-index', 999 );
				
				/**
				 * offset incase the user has scrolled
				 */
				y_offset = window.pageYOffset;
				
				/**
				 * move the container to the top left of the viewport
				 * and toggle the 'exapnd' class
				 */
				$( container ).offset( { top: 0 + y_offset, left: 0 } );
				$( container ).toggleClass( 'expand' );
					
				/**
				 * fix the gallery height to show the larger images
				 */
				figure_height = $( container ).find( 'ul.eu_gallery li figure' ).height();
				$( container ).find( 'ul.eu_gallery' ).height( figure_height );
				$( container ).find( '.orbit-container' ).height( figure_height );
			} else {
				$( '.eu_expand_gallery' ).html( '<i class="fa fa-expand"></i>' );
				
				/**
				 * make the gallery container static again to reinsert it into the page
				 */
				$( container ).css( 'position', 'relative');
				$( container ).toggleClass( 'expand' );
				
				/**
				 * squish the gallery height back to what it was
				 */
				figure_height = $( container ).find( 'ul.eu_gallery li figure' ).height();
				$( container ).find( 'ul.eu_gallery' ).removeAttr( 'style' );
				$( container ).find( '.orbit-container' ).removeAttr( 'style' );
				$( container ).css( 'width', '100%' );
				
				/**
				 * re-enable scrolling and control adjustments
				 */
				$(document).unbind('scroll'); 
				$('body').css( { 'overflow': 'visible' } );

				$(window).on( 'load resize', euGalleryAdjust );
			}
		});
		
		/**
		 * Adjust the position of the controls based on the image height
		 */
		function euGalleryAdjust() {
			img_height = $( 'ul.eu_gallery li figure .img_container' ).height();

			/**
			 * Resize img_container
			 */
			img_cont_w = $( '.img_container' ).width();
			img_cont_h = ( 387*img_cont_w ) / 582;
			$( '.img_container' ).height( img_cont_h );
			$( '.eu_gallery' ).height( $( '.eu_gallery li' ).height() );

			/**
			 * Reposition the gallery controls
			 */
			y_pos = img_height - 45;
			$( '.eu_expand_gallery' ).css( 'top', y_pos );
			$( '.eu_slide_number' ).css( 'top', y_pos - 45 );
			$( '.eu_prev, .eu_next' ).css('top', y_pos/2 );
			if( 720 >= $(window).width() ) {
				$( '.eu_slide_number' ).css( 'top', y_pos );
			}
		}
	}
	/**
 	 * If its a video gallery, we need the YouTube IFrame API
	 */
	else if( $( '.eu_video_gallery_container' ).length ) {
		//var youtube_id = $( 'ul.eu_video_gallery li.active figure' ).first().data( 'youtube_id' );

		/*var share_args = { 
			featured_img: $( 'ul.eu_video_gallery li.active figure' ).first().find( 'img' ).attr( 'src' ), 
			permalink: $( 'ul.eu_video_gallery li.active figure' ).first().data( 'permalink' ),
			the_title: $( 'ul.eu_video_gallery li.active figure' ).first().data( 'video_title' ), 
			target: 'gigya-container', 
			icon_path: $( '.eu_video_gallery_container' ).data( 'icon-path' )
		};*/
		
		//emergingusShowShareUI( share_args );

		/**
 		 * Import YouTube IFrame API
		 */
		var tag = document.createElement( 'script' );
		tag.src = "http://www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName( 'script' )[ 0 ];
		firstScriptTag.parentNode.insertBefore( tag, firstScriptTag );

		/**
 		 * Switch video when a thumbnail is clicked
		 */
		$( '.eu_video_gallery figure' ).click( function( e ) {
			youtube_id = $( this ).data( 'youtube_id' );
			description = $( this ).data( 'video_desc' );
			video_title = $( this ).data( 'video_title' );
			permalink = $( this ).data( 'permalink' );
			author = $( this ).data( 'video_author' );

			console.log( player );

			player.cueVideoById( youtube_id );

			$( '.video_info h2' ).html( '<a href="' + permalink + '" >' + video_title + '</a>' );
			$( '.video_info .post-excerpt' ).html( description );
			$( '.video_info .post-byline' ).html( author );
			$( '.video_thumb' ).removeClass( 'active' );
			$( this ).addClass( 'active ');

			//$( '.gigya-post' ).html( '<div id="gigya-container"></div>' );

			/*share_args = { 
				featured_img: $( this ).find( 'img' ).attr( 'src' ), 
				permalink: permalink, 
				the_title: video_title, 
				target: 'gigya-container', 
				icon_path: $( '.eu_video_gallery_container' ).data( 'icon-path' )
			};*/
			//emergingusShowShareUI( share_args );			
		});
	}

	/*function emergingusShowShareUI( share_args ) {
		var shareImage = function( provider ) {
			return share_args.icon_path + provider.toLowerCase() + '_000000_20.png';
		};

		var act = new gigya.socialize.UserAction();
		act.setTitle( share_args.thetitle );
		act.setLinkBack( share_args.permalink );
		act.addMediaItem( { type: 'image', src: share_args.featured_img, href: share_args.permalink } );

		var showShareBarUI_params = {
			containerID: share_args.target,
			shareButtons: [ 'Facebook', 'Twitter', 'Share', 'Email', 'Print' ].map( function( provider ) {
				return {
					provider: provider,
					iconImgUp: shareImage( provider )
				};
			}),
			iconsOnly: 'true',
			showCounts: 'none',
			userAction: act,
			moreEnabledProviders: 'facebook, twitter, google, linkedin, googlebookmarks, reddit, tumblr, pinterest, gmail, evernote',
			showEmailButton: false
			}
		gigya.socialize.showShareBarUI( showShareBarUI_params );
	}*/
});
