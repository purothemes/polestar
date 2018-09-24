<?php
/**
 * YARPP Template: Polestar
 *
 * @link https://wordpress.org/plugins/yet-another-related-posts-plugin/
 *
 * @package polestar
 * @license GPL 2.0
 */
?>

<h2 class="related-posts"><?php esc_html_e( 'You May Also Like', 'polestar' ); ?></h2>
<?php if ( have_posts() ) : ?>
	<ol>
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<?php 
					if ( has_post_thumbnail() && is_active_sidebar( 'sidebar-main' ) )
						the_post_thumbnail( 'polestar-247x164-crop' );
					elseif ( has_post_thumbnail() )
						the_post_thumbnail( 'polestar-354x234-crop' );
					?>
					<h3 class="related-post-title"><?php the_title(); ?></h3>
					<p class="related-post-date"><?php echo get_the_date(); ?></p>
				</a>
			</li>
		<?php endwhile; ?>
	</ol>
<?php else: ?>
	<p><?php esc_html_e( 'No related posts.', 'polestar' ); ?></p>
<?php endif; ?>
