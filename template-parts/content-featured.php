<article id="post-<?php the_ID(); ?>" class="reduced">
	<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>">
		<figure class="post-image">
			<?php the_post_thumbnail(); ?>
		</figure>
	</a>
	<?php endif; ?>
	<div class="post-info">
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php if ( is_single() ) : ?>
			<!-- byline -->
			<span><?php echo esc_html( 'By ') . hsinsider_get_coauthors(); ?></span>
		<?php endif; ?>
	</div>
	<?php if( is_author() ) : ?>
		<p><a href="<?php the_permalink(); ?>" class="more-link">Read more <span class="fa fa-angle-right"></span></a></p>
	<?php endif; ?>
</article>

