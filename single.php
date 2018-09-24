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
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			if ( class_exists( 'Jetpack_Likes' ) ) {
				$custom_likes = new Jetpack_Likes;
				echo $custom_likes->post_likes( '' );
			}

			if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'sharedaddy'  ) && function_exists( 'sharing_display' ) ) {
				echo sharing_display();
			}

			if ( get_theme_mod( 'post_navigation', true ) ) {
				the_post_navigation( array(
					'prev_text' => '<span class="sub-title"> ' . esc_html__( 'Previous Post', 'polestar' ) . '</span> <div>%title</div>',
					'next_text' => '<span class="sub-title">' . esc_html__( 'Next Post', 'polestar' ) . ' </span> <div>%title</div>',
				) );
			}
			
			if ( get_theme_mod( 'post_author_box', true ) ) polestar_author_box();

			if ( get_theme_mod( 'related_posts', true ) && ! is_attachment() ) polestar_related_posts( $post->ID );

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
