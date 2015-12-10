<?php
/**
 * TODO: THIS CODE IS HACKED TOGETHER.  CLEAN IT UP
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'featured-posts' ) ) :
	return;
else : ?>
<div id="featured" class="widget-area row" role="complementary">
	<?php dynamic_sidebar( 'featured-posts' ); ?>
</div>
<?php endif; ?>
