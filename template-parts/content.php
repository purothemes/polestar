<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package polestar
 * @license GPL 2.0 
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	if ( is_single() && has_post_thumbnail() && get_theme_mod( 'post_featured_image', customizer_library_get_default( 'post_featured_image' ) ) ) : ?>
		<div class="entry-thumbnail">
			<?php polestar_entry_thumbnail_meta(); ?>
			<?php the_post_thumbnail(); ?>			
			</a>
		</div>
	<?php elseif ( has_post_thumbnail() && get_theme_mod( 'archive_featured_image', customizer_library_get_default( 'archive_featured_image' ) ) ) : ?>
		<div class="entry-thumbnail">
			<?php polestar_entry_thumbnail_meta(); ?>
			<a href="<?php the_permalink(); ?>">			
				<span class="screen-reader-text"><?php esc_html_e( 'Open post', 'polestar' ); ?></span>
				<span class="overlay"></span>
				<span class="icon-add">
					<?php polestar_display_icon( 'add' ); ?>
				</span>
				<?php the_post_thumbnail(); ?>			
			</a>
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
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'polestar' ) . '</span>',
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php polestar_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
