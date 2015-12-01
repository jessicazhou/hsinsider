<?php
/**
 * TODO: THIS CODE IS HACKED TOGETHER.  CLEAN IT UP
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'popular-posts' ) ) :
	return;
else : ?>
<div id="popular" class="widget-area row" role="complementary">
	<?php dynamic_sidebar( 'popular-posts' ); ?>
</div>
<?php endif; ?>
