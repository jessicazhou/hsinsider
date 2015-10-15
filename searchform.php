<form role="search" method="get" id="searchform" class="container-fluid" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="row">
		<div class="col-xs-2 col-sm-1 col-md-1">
			<span><?php _e( 'Search', 'hsinsider' ); ?></span>
		</div>
		<div class="col-xs-7 col-sm-9 col-md-10">
			<input type="text" name="s" id="s" />
		</div>
		<div class="col-xs-3 col-sm-2 col-md-1">
			<input type="submit" value="<?php esc_attr_e( 'Go', 'hsinsider' ); ?>">
		</div>
	</div>
</form>