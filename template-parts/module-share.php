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

	<span class="trb_socialize_item" data-role="socialshare_parent">
		<i class="LATShare"></i>
		<ul class="trb_socialize_submenu">
			
			<a target=_blank class="trb_socialize_item" href="https://www.pinterest.com/pin/create/button/?url=<?php echo esc_attr( $url ); ?>&media=&description=<?php echo esc_attr( $title ); ?>">
				<i class="LATPinterest"></i>
			</a>
			
			<a target=_blank class="trb_socialize_item" href="https://plus.google.com/share?url=<?php echo esc_attr( $url ); ?>">
				<i class="LATGooglePlus"></i>
			</a>
			
			<a target=_blank class="trb_socialize_item" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_attr( $url ); ?>&title=<?php echo esc_attr( $title ); ?>">
				<i class="LATLinkedIn"></i>
			</a>
			
			<a target=_blank class="trb_socialize_item" href="http://www.stumbleupon.com/submit?url=<?php echo esc_attr( $url ); ?>&title=<?php echo esc_attr( $title ); ?>">
				<i class="LATStumbleUpon"></i>
			</a>
			
			<a target=_blank class="trb_socialize_item" href="http://www.reddit.com/submit?url=<?php echo esc_attr( $url ); ?>&title=<?php echo esc_attr( $title ); ?>">
				<i class="LATReddit"></i>
			</a>
		</ul>
	</span>

	<a class="trb_socialize_item" href="mailto:"><i class="LATEmail"></i></a>		

	<a class="trb_socialize_item" href="#" onclick="window.print();return false;"><i class="LATPrinter"></i></a>
</span>
