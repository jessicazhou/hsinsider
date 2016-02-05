<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HSInsider
 */

get_header(); 

$term = wpcom_vip_get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

/** 
* If the taxonomy term exists, do stuff
*/
if( is_object( $term ) ) : ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container-fluid" role="main">
			<header class="hero jumbotron blogroll archive-header row">
				<?php 
					$school_address = hsinsider_get_school_meta( 'address' );
					$school = hsinsider_get_school();

					//Defaults
					$school_marker = 'none';
					$column = 'no-post-image';

					if( ! empty( $school_address ) ) {
						$school_marker = array( 
							'school' => $school->name,
							'address' => $school_address
						);

						$school_marker = json_encode( $school_marker ); 
						$column = 'col-md-5 col-md-push-7';
					}
				?>
				<section class="col-xs-12 <?php echo $column; ?>">
					<!-- Social Share -->
					<?php ai_get_template_part( 'template-parts/module', 'share', array ( 'title' =>  get_the_title(), 'url' => get_term_link( $term ) ) ); ?>
					<!-- title -->
					<h1 class="entry-title"><?php esc_html_e( $school->name, 'hsinsider' ); ?></h1>

					<div class="row">
						<?php if( hsinsider_has_school_image() ): ?>
						<div class="col-sm-12 col-md-4 school-image-column">
							<?php hsinsider_school_image(); ?>
						</div>
						<?php endif; ?>

						<?php if( '' != $school->description ): ?>
						<div class="col-sm-12 col-md-8 school-description-column">
							<p><?php echo $school->description; ?></p>
						</div>
						<?php endif; ?>
					</div>
				</section><!-- .page-header -->
				
				<?php if( ! empty( $school_address ) ) : ?>
				<div class="map col-xs-12 col-md-7 col-md-pull-5">
					<div id="gmap" data-marker='<?php esc_attr_e( $school_marker, 'hsinsider' ); ?>'></div>
				</div>
				<?php endif; ?>
			</header>

			<?php if ( have_posts() ) : ?>
			<?php $post_count = 0; ?>
			<section class="blogroll row">
				<?php while ( have_posts() ) : the_post(); //the Loop ?>

					<?php
						/**
						 * Include the Post-Format-specific template for the content.
						 * Remove the $curated post from the blogroll
						 * TODO: Move jumbotron div into featured template
						 */
						if( $curated != get_the_ID() ) {
							ai_get_template_part( 'template-parts/content', 'blogroll' );
							$post_count ++;
						}
				
						if( 0 == $post_count % 2 ) {
							ai_get_template_part( 'template-parts/module', 'mid-roll', array( 'post_count' => $post_count ) );
						}
					?>
				<?php endwhile; ?>
			</section>

			<?php hsinsider_the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php endif; ?>

<?php get_footer(); ?>
