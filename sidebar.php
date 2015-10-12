<?php
/**
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) :
	return;
else : ?>
<div id="sidebar-main" class="widget-area" role="complementary">
	<div class="block-ad ad" id="div-gpt-ad-783778988016615787-2"></div>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
<?php endif; ?>
