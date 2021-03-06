<?php
/**
 * eu-video-gallery.php
 * Replace Gallery Shortcode Output with desired markup
 * Author: James Perez 
 */

function hsinsider_video_gallery() {

	$the_query = wp_cache_get( 'video_query' );	 
	if( $the_query == false ) {
	    /**
		 * build the args array for wp_query
		 */
		$args = array(
			'post_type' => 'video',
			'posts_per_page' => 8,
			'orderby' => 'date',
			'meta_query' => array( 
				array(
					'key' => '_thumbnail_id'
				) 
			),
		);
	    $the_query = new WP_Query( $args );
	 
	    // Set the cache to expire the data after 300 seconds
	    wp_cache_set( 'video_query', $the_query, '', 600 );
	}

	if ( $the_query->have_posts() ) :
		/**
		 * Group the thumbnails into groups of 4
		 * and show each group as a slide.
		 */
		$video_count = $the_query->post_count;
		$num_slides = ceil( $video_count / 4 );
		$videos = array();
		$marker = 0;
		$gallery = '';
		/**
		 * loop through the posts and create a list item for each one
		 */
		while ( $the_query->have_posts() ) : 
			$the_query->the_post();
			$post = $the_query->post;

			/**
			 * store the video data in easy to use variables
			 * we use the wp_get_attachment_url because we don't want 
			 * any of wordpress's default image classes
			 */
			$video_thumb_id = get_post_thumbnail_id( $post->ID );
			$video = array(
				'thumb' => wp_get_attachment_url( $video_thumb_id ),
				'youtube_id' => get_post_meta( $post->ID, 'video_info', TRUE )['youtube_id'],
				'title' => $post->post_title,
				'description' => get_the_excerpt(),
				'author' => hsinsider_get_coauthors(),
				'link' => get_permalink()
			);

			array_push( $videos, $video );
					
		endwhile;

		if( !empty( $videos ) ) :
			/** 
			 * store all html output to $gallery
			 */
			$gallery .= '<div id="video_gallery" class="eu_video_gallery_container" data-icon-path="' . esc_url( get_template_directory_uri() . '/assets/img/icons/' ) . '">';
			$gallery .= '	<div class="active_video row">';
			$gallery .=	'		<div class="video col-md-9"><div class="iframe-wrapper"><iframe id="player" type="text/html" width="640" height="390" src="'. esc_url( 'http://www.youtube.com/embed/' . $videos[0]['youtube_id'] ) . '?enablejsapi=1" frameborder="0"></iframe></div></div>';
			$gallery .= '		<div class="video_info col-md-3">';
			$gallery .= '			<span class="trb_socialize_bar">
										<a target="_blank" class="trb_socialize_item facebook" href="https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $videos[0]['link'] ) . '" style="padding-left: 0px;">
											<i class="LATFacebook"></i>
										</a>
										<a target="_blank" class="trb_socialize_item twitter" href="https://twitter.com/home?status=' . urlencode( $videos[0]['title'] ) . '+' . urlencode( $videos[0]['link'] ) .'">
											<i class="LATTwitter"></i>
										</a>
										<a class="trb_socialize_item" href="mailto:"><i class="LATEmail"></i></a>		
									</span>';
			$gallery .=	'			<h2 class="post-headline"><a href="' . esc_url( $videos[0]['link'] ) . '">' . esc_html( $videos[0]['title'] ) .'</a></h2>';
			$gallery .=	'			<p class="post-excerpt">' . esc_html( $videos[0]['description'] ) .'</p>';
			$gallery .= '			<p class="post-byline">' . wp_kses_post( $videos[0]['author'] ) . '</p>';
			$gallery .= '		</div>';
			$gallery .= '	</div>';
			$gallery .= '	<div class="row">';
			$gallery .= '   <div id="video-carousel" class="carousel slide" data-ride="carousel">
								<!-- Indicators -->
								<ol class="carousel-indicators">
									<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
									<li data-target="#carousel-example-generic" data-slide-to="1"></li>
									<li data-target="#carousel-example-generic" data-slide-to="2"></li>
								</ol>';
			$gallery .= '   	<ul class="eu_video_gallery carousel-inner" role="listbox">';

			$marker = 0;
					
			for( $slide = 0; $slide < $num_slides; $slide++ ) :
				$count = 0;
				$gallery .= '<li id="'. esc_attr( 'group-' . $slide ). '" class="' . esc_attr( 'item' . ( ( 0 == $slide ) ? ' active' : '' ) ) . '">';
						
				for( $key = $marker; $key < $video_count; $key++ ) :
					if ( 4 == $count ) :
						$marker = $key;
						break;
					else :
						$video = $videos[ $key ];
						$active = ( 0 == $key ) ? 'active' : '';
						$gallery .= '		<figure class="' . esc_attr( 'video_thumb ' . $active ) . '" data-youtube_id="' . esc_attr( $video['youtube_id'] ) . '" data-video_title="' . esc_attr( $video['title'] ) . '" data-video_author="' . esc_attr( $video['author'] ) . '" data-video_desc="' . esc_attr( $video['description'] ) . '" data-permalink="' . esc_url( $video['link'] ) . '" >';
						$gallery .= '			<div class="video_thumb_container"><img src="' . esc_attr( $video['thumb'] ) . '" /><span class="camera"><i class="fa fa-video-camera"></i></span></div>';
						$gallery .= '			<figcaption>';
						$gallery .= '				<h3 class="post-headline">' . esc_html( $video['title'] ) . '</h3>';
						$gallery .= '			</figcaption>';
						$gallery .= '		</figure>';
					endif;
					$count++;
				endfor;
						
				$gallery .= '</li>';
			endfor;
			/**
			 * close all open html elements
			 */
			$gallery .= '   </ul>';
			$gallery .= '   <!-- Controls -->
								<a class="left carousel-control" href="#video-carousel" role="button" data-slide="prev">
									<i class="LATArrowLeft01" aria-hidden="true"></i>
								</a>
								<a class="right carousel-control" href="#video-carousel" role="button" data-slide="next">
									<i class="LATArrowRight01" aria-hidden="true"></i>
								</a>
							</div>';
			$gallery .= '</div>';
			$gallery .= '</div>';
		else :
			$gallery .= esc_html__( 'No Videos Found', 'hsinsider' );
		endif;
		
	endif;        

	wp_reset_query();
	
	return $gallery;
}
