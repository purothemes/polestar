<?php
/**
 * Template part for displaying image format posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package polestar
 * @license GPL 2.0 
 */

$post_class = ( is_singular() ) ? 'entry' : 'archive-entry';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>

	<?php if ( polestar_get_image() ) : ?>
		<div class="entry-thumbnail">
			<?php echo polestar_get_image(); ?>
		</div>
	<?php elseif ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<?php if ( is_singular() ) : ?>
				<?php the_post_thumbnail(); ?>
			<?php else : ?>
				<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail() ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php polestar_post_meta(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->	

	<div class="entry-content">
		<?php 
			if ( is_single() || get_theme_mod( 'archive_post_content' ) == 'full' ) {
				echo apply_filters( 'the_content', polestar_strip_image( get_the_content() ) );
			} else {
				polestar_excerpt();
			}

			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'polestar' ) . '</span>',
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php polestar_entry_footer(); ?>
</article><!-- #post-## -->
