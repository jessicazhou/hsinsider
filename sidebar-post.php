<?php
/**
 * TODO: THIS CODE IS HACKED TOGETHER.  CLEAN IT UP
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'single-post' ) ) :
	return;
else : ?>
<div id="sidebar-single-post" class="widget-area single-post col-md-4" role="complementary" style="border-bottom: 0px none;">
	<div class="block-ad ad" id="lat-hs-300x250-1" style="padding-top: 60px;"></div>
	<h3 style="text-align: center;"><?php esc_html_e( 'Featured on HS Insider', 'hsinsider' ); ?></h3>
	<?php dynamic_sidebar( 'single-post' ); ?>
</div>
<?php endif; ?>
