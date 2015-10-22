<?php
/**
 * TODO: THIS CODE IS HACKED TOGETHER.  CLEAN IT UP
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'popular-posts' ) ) :
	return;
else : ?>
<div id="sidebar-main" class="widget-area" role="complementary">
	<h2 style="text-align: center; padding-bottom: 20px;"><?php esc_html_e( 'Featured on HS Insider', 'hsinsider' ); ?></h2>
	<?php dynamic_sidebar( 'popular-posts' ); ?>
	<!-- <div class="block-ad ad" id="div-gpt-ad-783778988016615787-2"></div> -->
</div>
<?php endif; ?>
