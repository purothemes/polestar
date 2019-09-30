<?php
/**
 * Loop Name: Blog
  *
 * Post loop for use with the SiteOrigin Post Loop widget in Page Builder.
 *
 * @package polestar
 * @license GPL 2.0 
 */

if ( have_posts() ) :

	if ( is_home() && ! is_front_page() ) : ?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>

	<?php
	endif;

	/* Start the Loop */
	while ( have_posts() ) : the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'template-parts/content', get_post_format() );

	endwhile;

	the_posts_pagination( array( 
		'prev_text' => '<span class="icon-long-arrow-left"></span>',
		'next_text' => '<span class="icon-long-arrow-right"></span>'
	) );

else :

	get_template_part( 'template-parts/content', 'none' );

endif; ?>
