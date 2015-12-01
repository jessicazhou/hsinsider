<?php
/**
 * TODO: THIS CODE IS HACKED TOGETHER.  CLEAN IT UP
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'single-post' ) ) :
	return;
else : ?>
<div id="sidebar-single-post" class="widget-area single-post col-md-4" role="complementary" style="border-bottom: 0px none;">
	<!-- Desktop Ad -->
	<div class="block-ad ad hidden-xs" id='div-gpt-ad-597875899873789138-1'></div>
	<!-- Mobile Ad -->
	<div class="block-ad ad visible-xs-block" id='div-gpt-ad-283030070724299354-1'></div>
	<!-- Sidebar Widgets -->
	<?php dynamic_sidebar( 'single-post' ); ?>
</div>
<?php endif; ?>
