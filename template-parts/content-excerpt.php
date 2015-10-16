<?php
/**
 * The template part for displaying single posts.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<!-- School -->
		<?php hsinsider_school_link(); ?>

		<!-- title -->
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		
		<!-- byline -->
		<?php hsinsider_get_post_byline(); ?>

		<!-- image -->
		<figure class="featured-image">
			<?php the_post_thumbnail(); ?>
		</figure>
	</header><!-- .entry-header -->

	<div class="brief">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<a class="read-more" href="<?php get_permalink( get_the_ID() ); ?>"><?php _e( 'Read More', 'hsinsider' ); ?></a>
		<!-- Social Share -->
		<?php ai_get_template_part( 'template-parts/module', 'share', array ( 'title' =>  get_the_title(), 'url' => get_permalink() ) ); ?>
	</footer><!-- .entry-footer -->
	<hr />
</article><!-- #post-## -->