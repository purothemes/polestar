<?php
/**
 * Loop Name: Posts Slider
 *
 * Post loop for use with the SiteOrigin Post Loop widget in Page Builder.
 *
 * @package polestar
 * @license GPL 2.0 
 */

wp_enqueue_script( 'jquery-flexslider' );

if ( have_posts() ) : ?>

	<div class="flexslider featured-posts-slider">

		<ul class="slides">

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php $thumbnail = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id() ) : false; ?>

				<li class="slide" <?php if ( ! empty( $thumbnail ) ) echo 'style="background-image: url( \''  . esc_url( $thumbnail ) . '\' )"'; ?>>
					<div class="overlay"><a href="<?php the_permalink(); ?>"></a></div>
					<div class="slide-content">	
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
						<div class="entry-excerpt">
							<?php polestar_excerpt(); ?>
						</div>
					</div>
				</li>

			<?php endwhile; ?>

		</ul>

		<ul class="flex-direction-nav">
			<li class="flex-nav-prev">
				<a class="flex-prev" href="#"><?php polestar_display_icon( 'left-arrow' ); ?></a>
			</li>
			<li class="flex-nav-next">
				<a class="flex-next" href="#"><?php polestar_display_icon( 'right-arrow' ); ?></a>
			</li>
		</ul>

	</div><!-- .featured-posts-slider -->

<?php endif; ?>
