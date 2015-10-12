<?php
/**
 * Third-party api integrations, third-party data feeds, etc.
 */

function hsinsider_do_social_head() {
	
	if( is_single() ) {
		/**
	 	 * Get the current global post object
	 	 */
		global $post;
		$post_id = $post->ID;

		/**
	 	 * Get the post excerpt form the $post object
	 	 * If it's empty, create an excerpt by trimming post_contnet 
	 	 */
		$excerpt = $post->post_excerpt;
		if( $excerpt == '' ) {
			$excerpt = wp_trim_words( $post->post_content );
		}
		
		$social_head = '
		<meta property="og:title" content="' . esc_attr( the_title_attribute( array( 'echo' => false ) ) ) . '" />
		<meta property="og:description" content="' . esc_attr( $excerpt ) . '" />
		<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />
		<meta property="og:url" content="' . esc_html( get_the_permalink() ) . '" />
		<meta property="og:type" content="article" />

		<meta name="twitter:card" value="summary" />
		<meta name="twitter:site" value="@hsinsder" />
		<meta name="twitter:url" value="' . esc_html( get_the_permalink() ) . '" />
		<meta name="twitter:title" value="' . esc_attr( the_title_attribute( array( 'echo' => false ) ) ) . '" />
		<meta name="twitter:description" value="' . esc_attr( $excerpt ) . '" />';
			
		if( has_post_thumbnail() ) {
			
			$featured_img = get_post_thumbnail_id( $post_id );
			$featured_img = wp_get_attachment_image_src( $featured_img );

			if( ! empty( $featured_img ) ) {
				$featured_img = $featured_img[0];
			}

			$social_head .= '
			<meta property="og:image" content="' . esc_url( $featured_img ) . '" />
			<meta name="twitter:image" value="' . esc_url( $featured_img ) . '" />';
		}
		echo $social_head;
		wp_reset_query();
	}
}
add_action( 'wp_head', 'hsinsider_do_social_head' );

function hsinsider_do_omniture_footer() {

	$pageName = '';
	$channel = '';
	if( ( $school = hsinsider_get_school() ) && !empty( $school ) ) {
		$pageName = ':school:' . $school->slug . ( is_single() ? ':' . get_the_ID() . '-' . get_post()->post_name : '' );
		$channel = ':school:' . $school->slug;
	} elseif( is_tag() ) {
		$term = get_queried_object();
		$pageName = ':tag:' . $term->slug;
		$channel = ':tag';
	} elseif( is_category() ) {
		$term = get_queried_object();
		$pageName = ':category:' . $term->slug;
		$channel = ':category';
	}

	//Truncate to 60 chars, to avoid the entire pageName string going over 100
	$pageName = substr( $pageName, 0, 60 );

	echo '
	<script type="text/javascript">
		((((window.trb || (window.trb = {})).data || (trb.data = {})).metrics || (trb.data.metrics = {})).thirdparty = {
			pageName: "lat:highschool:hsinsider' . esc_attr_e( $pageName, 'hsinsider' ) . ':articleproject",
			channel: "hsinsider' . esc_attr_e( $channel, 'hsinsider' ) . '",
			server: "highschool.latimes.com",
			hier1: "latimes:hsinsider' . esc_attr_e( $channel, 'hsinsider' ) . '",
			hier2: "hsinsider' . esc_attr_e( $channel, 'hsinsider' ) . '",
			prop1: "D=pageName",
			prop2: "hsinsider",
			prop38: "articleproject",
			prop57: "D=c38",
			eVar20: "latimes",
			eVar21: "D=c38",
			eVar34: "D=ch",
			eVar35: "D=pageName",
			events:""
		});
	</script>
	<script src="http://www.latimes.com/thirdpartyservice?disablenav=true&disablessor=true" async></script>';
}
add_action( 'wp_footer', 'hsinsider_do_omniture_footer' );

