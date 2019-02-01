<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package polestar
 * @license GPL 2.0 
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && get_theme_mod( 'archive_featured_image', true ) ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'polestar-720x480-crop' ); ?>
			</a>
		</div>
	<?php endif; ?>

		<div class="polestar-content-wrapper">
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php polestar_post_meta(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php polestar_excerpt(); ?>
			</div><!-- .entry-summary -->

		</div>

</article><!-- #post-## -->
