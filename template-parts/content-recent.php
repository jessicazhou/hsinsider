<article id="post-<?php the_ID(); ?>" class="reduced clearfix">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>
	
	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	
	<div class="date">
		<span class="post-date"><?php the_time( 'F j, Y - g:iA' ); ?></span>
	</div>
	
	<div class="school">
		<?php hsinsider_school_link( 'school' ); ?>
	</div>
	
	<?php if( is_author() ) : ?>
		<p><a href="<?php the_permalink(); ?>" class="more-link">Read more <span class="fa fa-angle-right"></span></a></p>
	<?php endif; ?>
</article>