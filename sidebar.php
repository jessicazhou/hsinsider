<?php
/**
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'single-post' ) ) :
	return;
else : ?>
<div id="sidebar-single-post" class="widget-area single-post col-md-4" role="complementary" style="border-bottom: 0px none;">
	<!-- Sidebar Widgets -->
	<?php dynamic_sidebar( 'single-post' ); ?>
</div>
<?php endif; ?>
