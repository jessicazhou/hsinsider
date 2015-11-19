<?php
/**
 * The template part for displaying single posts.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php $column_class = 'no-post-image' ?>
		<!-- image -->
		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="featured-image col-xs-12 col-sm-12 col-md-7">
				<?php the_post_thumbnail(); ?>
			</figure>
			<?php $column_class = 'col-md-5'; ?>
		<?php endif ?>

		<section class="col-xs-12 col-sm-12 <?php echo $column_class; ?>">
			<!-- Social Share -->
			<?php ai_get_template_part( 'template-parts/module', 'share', array ( 'title' =>  get_the_title(), 'url' => get_permalink() ) ); ?>

			<!-- School -->
			<?php hsinsider_school_link( 'school', $post->ID ); ?>

			<!-- title -->
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			
			<footer class="entry-footer">
				<!-- byline -->
				<?php hsinsider_get_post_byline(); ?>
			</footer><!-- .entry-footer -->
		</section>
</article><!-- #post-## -->