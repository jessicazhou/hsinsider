// Hide lazy load gravatar images
jQuery('img[src="https://s0.wp.com/wp-content/themes/vip/plugins/lazy-load/images/1x1.trans.gif"]').hide();

if( jQuery( '.BrightcoveExperience' ).length != -1 ) {
  alert('do the thing');
  brightcove.createExperiences();
}
