<?php
/**
 * The sidebar containing the widgets in the site footer
 */

if ( ! is_active_sidebar( 'footer-widgets' ) ) :
	return;
else : ?>
<div id="footer-widgets" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'footer-widgets' ); ?>
</div>
<?php endif; ?>