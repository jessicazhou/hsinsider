<article id="post-<?php the_ID(); ?>" class="reduced">
	<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
		<figure class="post-image">
			<?php the_post_thumbnail(); ?>
		</figure>
		<?php endif; ?>
		<div class="post-info">
			<h4><?php the_title(); ?></h4>
			<?php if ( is_single() ) : ?>
				<!-- byline -->
				<?php echo esc_html( 'By ') . hsinsider_get_coauthors(); ?>
			<?php endif; ?>
		</div>
	</a>
	<?php if( is_author() ) : ?>
		<p><a href="<?php the_permalink(); ?>" class="more-link">Read more <span class="fa fa-angle-right"></span></a></p>
	<?php endif; ?>
</article>

