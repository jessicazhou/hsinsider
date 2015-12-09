<?php
/**
 * Template Name: About Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blankstrap
 */

get_header(); ?>

	<div id="primary" class="content-area container-fluid">
		<header id="page-top" class="row">
			<div class="container">
				<section class="row">
					<div class="col-xs-12 col-md-6">
						<img class="img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/static/images/hsinsider-logo-reverse.png' ); ?>" >
					</div>
					<div class="col-xs-12 col-md-6">
						<p class="lead"><?php esc_html_e( 'Do you — or your students — have important stories to tell?  Are you reporting on topics that you believe deserve a larger audience?  Do you want to sharpen your multimedia skills?', 'hsinsider' ); ?></p>
					</div>
				</section>
			</div>
		</header>
		
		<?php
			/**
			 * Collect the school address markers in an array
			 */
			$terms = get_terms( 'school', array( 'hide_empty' => 0 ) ); 
			$markers = array();

			foreach( $terms as $term ) {
				$school_info = Fieldmanager_Util_Term_Meta()->get_term_meta( $term->term_id, 'school', 'school_info', false );

				if( ! empty( $school_info[0]['address'] ) && '' != $school_info[0]['address'] ) {
					$school_marker = array( 
						'school' => $term->name,
						'address' => $school_info[0]['address'] 
					);
					array_push( $markers, $school_marker );
				}
			}
			$markers = json_encode( $markers );
		?>
		<?php if( !empty( $markers ) ) : ?>
		<section class="row">
			<div class="map col-xs-12">
				<div id="gmap" data-marker='<?php echo $markers; ?>'></div>
			</div>
		</section>
		<?php endif; ?>

		<main id="main" class="site-main row" role="main">
			<div class="container">
				<div class="row">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', 'page' ); ?>
					<?php endwhile; // End of the loop. ?>
					<div class="col-xs-12 col-sm-10 col-sm-offset-1 page_widget">
						<?php the_widget( 'HSInsider_Widget_Newsletter', array( 'title' => 'Join the HS Insider Newsletter!' ) ); ?>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
