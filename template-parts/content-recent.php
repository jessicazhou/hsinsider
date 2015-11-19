<article id="post-<?php the_ID(); ?>" class="reduced">
	<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
		<figure class="post-image">
			<?php the_post_thumbnail(); ?>
		</figure>
		<?php endif; ?>
		
		<h4><?php the_title(); ?></h4>
	</a>

	<div class="date">
		<span class="post-date"><?php the_time( 'F j, Y - g:iA' ); ?></span>
	</div>
	
	<div class="school">
		<?php //hsinsider_school_link( 'school' ); ?>
	</div>
	
	<?php if( is_author() ) : ?>
		<p><a href="<?php the_permalink(); ?>" class="more-link">Read more <span class="fa fa-angle-right"></span></a></p>
	<?php endif; ?>
</article>

