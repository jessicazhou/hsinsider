<?php
/**
 * TODO: THIS CODE IS HACKED TOGETHER.  CLEAN IT UP
 * Gets the appropriate Mid-Blogroll Widgets
 * @param post_count integer, the current number of posts in the blogroll
 */

$post_count = ai_get_var( 'post_count' );

if( !empty( $post_count ) ) :

	$sidebar = $post_count / 2;

	if ( ! is_active_sidebar( 'mid-roll-' . $sidebar ) ) :
		return;
	else : ?>
	<div class="widget-area mid-roll <?php echo 'mid-roll-' . $sidebar; ?>" role="complementary">
		<div class="container">
		<?php dynamic_sidebar( 'mid-roll-' . $sidebar ); ?>
		<?php //echo ( 2 == $sidebar ) ? '<div class="col-md-4"><div class="block-ad ad" id="div-gpt-ad-783778988016615787-2"></div></div>' : ''; ?>
		</div>
	</div>
	<?php endif; ?>

<?php endif; ?>