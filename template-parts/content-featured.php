<?php
/**
 * The template part for displaying single posts.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class() . ' row'; ?>>
		<!-- image -->
	<figure class="featured-image">
		<?php the_post_thumbnail(); ?>
	</figure>
	<section>
		<!-- Social Share -->
		<?php ai_get_template_part( 'template-parts/module', 'share', array ( 'title' =>  get_the_title(), 'url' => get_permalink() ) ); ?>

		<!-- School -->
		<?php hsinsider_school_link(); ?>

		<!-- title -->
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		
		<footer class="entry-footer">
			<!-- byline -->
			<?php hsinsider_get_post_byline(); ?>
		</footer><!-- .entry-footer -->
	</section>
</article><!-- #post-## -->