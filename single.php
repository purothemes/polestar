<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package polestar
 * @license GPL 2.0 
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'sharedaddy'  ) && function_exists( 'sharing_display' ) ) {
				echo sharing_display();
			}

			if ( get_theme_mod( 'post_navigation' ) ) :
				polestar_the_post_navigation();
			endif;

			polestar_author_box();		

			if ( ! is_attachment() ) :
				polestar_related_posts( $post->ID );
			endif;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
