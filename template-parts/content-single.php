<?php
/**
 * The template part for displaying single posts.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array(  'col-md-8', 'single' ) ); ?>>
	<header class="entry-header">
		<?php echo get_the_post_thumbnail(); ?>
		<?php ai_get_template_part( 'template-parts/module', 'share' ); ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php hsinsider_get_post_byline(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'hsinsider' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php hsinsider_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
