<div class="post-author">

	<div class="author-content">
		<p>
			<?php if( laths_get_school_meta( 'twitter' ) ) { ?>
				<a target="_blank" class="author-social" href="<?php echo esc_url( laths_get_school_meta( 'twitter' ) ); ?>"><span class="trb_socialize_item" data-role="socialshare_share" data-socialshare-type="twitter"></span></a>
			<?php } ?>
			<?php if( laths_get_school_meta( 'facebook' ) ) { ?>
				<a target="_blank" class="author-social" href="<?php echo esc_url( laths_get_school_meta( 'facebook' ) ); ?>"><span class="trb_socialize_item" data-role="socialshare_share" data-socialshare-type="facebook"></span></a>
			<?php } ?>
		</p>
		<?php if( laths_get_school_meta( 'website' ) ) { ?>
			<p><a target="_blank" class="author-social" href="<?php echo esc_url( laths_get_school_meta( 'website' ) ); ?>"><?php echo esc_url( laths_get_school_meta( 'website' ) ); ?></a></p>
		<?php } ?>
	</div>

	<div class="author-content clearleft">
		<?php echo term_description(); ?>
	</div>
	
</div>