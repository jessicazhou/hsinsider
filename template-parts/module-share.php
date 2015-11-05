<?php
/**
 * Social Share Bar Module
 *
 * @param  optional string title The title of the post to share
 * @param  optional string url The permalink of the post to share
 */

$title = ai_get_var( 'title' );
$url = ai_get_var( 'url' );

if( empty( $title ) || empty( $url ) ) {
	$url = home_url();
	$title = "High School Insider";
} ?>
<span class="trb_socialize_bar">
	<a target="_blank" class="trb_socialize_item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr( $url ); ?>" style="padding-left: 0px;">
		<i class="LATFacebook"></i>
	</a>
	<a target="_blank" class="trb_socialize_item" href="https://twitter.com/home?status=<?php echo esc_attr( $title ); ?>+<?php echo esc_attr( $url ); ?>">
		<i class="LATTwitter"></i>
	</a>
	<a class="trb_socialize_item" href="mailto:"><i class="LATEmail"></i></a>		
</span>
