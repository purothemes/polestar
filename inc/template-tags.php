<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package polestar
 * @license GPL 2.0 
 */

if ( ! function_exists( 'polestar_author_box' ) ) :
/**
 * Display the post author biographical info on single posts.
 */
function polestar_author_box() { ?>
	<div class="author-box">
		<div class="author-avatar">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
			</a>
		</div><!-- .author-avatar -->
		<div class="author-description">
			<h3><?php echo get_the_author(); ?></h3>
			<span class="author-posts">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php esc_html_e( 'View posts by ', 'polestar' );
					echo get_the_author(); ?>
				</a>
			</span>	
			<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<div><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></div>
			<?php endif; ?>
		</div><!-- .author-description -->
	</div><!-- .author-box -->
<?php }
endif;

if ( ! function_exists( 'polestar_breadcrumbs' ) ) :
/**
 * Display Yoast SEO breadcrumbs or Breadcrumb NavXT below the header.
 */
function polestar_breadcrumbs() {
	if ( function_exists( 'bcn_display' ) ) {
		?><div class="breadcrumbs bcn">
			<?php bcn_display(); ?>
		</div><?php
	} elseif ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
	}
}
endif;
add_action( 'polestar_content_top', 'polestar_breadcrumbs' );

if ( ! function_exists( 'polestar_mini_cart' ) ) :
/**
 * Display the WooCommerce mini cart.
 */
function polestar_mini_cart() {
	if ( class_exists( 'Woocommerce' ) && ! ( is_cart() || is_checkout() ) ) : ?>
		<?php global $woocommerce; ?>
		<ul class="shopping-cart">
			<li>
				<a class="shopping-cart-link" href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
					<span class="screen-reader-text"><?php esc_html_e( 'View shopping cart', 'polestar' ); ?></span>
					<?php polestar_display_icon( 'cart' ); ?>
					<span class="shopping-cart-text"><?php esc_html_e( 'View Cart', 'polestar' ); ?></span>
					<span class="shopping-cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
				</a>
				<ul class="shopping-cart-dropdown" id="cart-drop">
					<?php the_widget( 'WC_Widget_Cart' );?>
				</ul>
			</li>
		</ul>
	<?php endif; ?>
<?php
}
endif;

if ( ! function_exists( 'polestar_comment' ) ) :
/**
 * The callback function for wp_list_comments in comments.php.
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments.
 */		
function polestar_comment( $comment, $args, $depth ) {
	?>
	<li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<?php $type = get_comment_type( $comment->comment_ID ); ?>
		<div class="comment-box">
			<?php if ( $type == 'comment' ) : ?>
				<div class="avatar-container">
					<?php echo get_avatar( get_comment_author_email(), 60 ) ?>
				</div>
			<?php endif; ?>

			<div class="comment-container">
				<div class="info">
					<span class="author"><?php comment_author_link(); ?></span><br>
					<span class="date"><?php comment_date( apply_filters( 'polestar_date_format', 'F d, Y' ) ); ?></span>
				</div>

				<div class="comment-content content">
					<?php comment_text() ?>
				</div>

				<?php if ( $depth <= $args['max_depth'] ) : ?>
					<?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ?>
				<?php endif; ?>
			</div>
		</div>
	<?php
}
endif;

if ( ! function_exists( 'polestar_entry_footer' ) ) :
/**
 * Print HTML with meta information for the post tags.
 */
function polestar_entry_footer() {

	if ( is_single() && has_tag() && get_theme_mod( 'post_tags', true ) ) {
		echo '<footer class="entry-footer"><span class="tags-links">' . get_the_tag_list() . '</span></footer>';
	}	
}
endif;

if ( ! function_exists( 'polestar_footer_text' ) ) :
/**
 * Displays the footer text.
 */
function polestar_footer_text() {

	$text = get_theme_mod( 'footer_text', esc_html__( 'Copyright &copy; {year} {sitename}', 'polestar' ) );

	$text = str_replace(
		array( '{sitename}', '{year}' ),
		array( get_bloginfo( 'sitename' ), date_i18n( esc_html__( 'Y', 'polestar' ) ) ),
		$text
	);
	echo wp_kses_post( $text );
}
endif;

/**
 * Add a filter for Jetpack Featured Content.
 */
function polestar_get_featured_posts() {
	return apply_filters( 'polestar_get_featured_posts', array() );
}

/**
 * Check the Jetpack Featured Content.
 */
function polestar_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() )
		return false;

	$minimum = absint( $minimum );
	$featured_posts = apply_filters( 'polestar_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) )
		return false;

	if ( $minimum > count( $featured_posts ) )
		return false;

	return true;
}

if ( ! function_exists( 'polestar_display_featured_posts' ) ) :
/**
 * Output the Jetpack Featured Content.
 */
function polestar_display_featured_posts() {
	if ( is_home() && polestar_has_featured_posts() ) {
		get_template_part( 'template-parts/featured', 'slider' );
	}
}
endif;
add_action( 'polestar_content_before', 'polestar_display_featured_posts' );

if ( ! function_exists( 'polestar_display_icon' ) ) :
/**
 * Display theme icons.
 */
function polestar_display_icon( $type ) {
	switch( $type ) {
		case 'add' : ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
				<path d="M18.984 12.984h-6v6h-1.969v-6h-6v-1.969h6v-6h1.969v6h6v1.969z"></path>
			</svg>
		<?php break;

		case 'cart' : ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
			<path d="M31.914 5.4l-2.914 11.6c0 0.139-0.028 0.27-0.078 0.389-0.102 0.24-0.293 0.432-0.532 0.533-0.12 0.051-0.252 0.078-0.39 0.078h-19l0.8 4h17.2c0.553 0 1 0.447 1 1s-0.447 1-1 1h-18c-0.553 0-1-0.447-1-1l-3.8-19h-3.2c-0.552 0-1-0.448-1-1s0.448-1 1-1h4c0.553 0 1 0.448 1 1l0.2 1h24.8c0.553 0 1 0.448 1 1 0 0.143-0.032 0.277-0.086 0.4zM8.6 16h3.4v-10h-5.4l2 10zM18 6h-5v10h5v-10zM24 6h-5v10h5v-10zM25 6v10h2.253l2.533-10h-4.786zM11 26c1.657 0 3 1.344 3 3s-1.343 3-3 3-3-1.344-3-3 1.343-3 3-3zM11 30c0.553 0 1-0.447 1-1s-0.447-1-1-1-1 0.447-1 1 0.447 1 1 1zM25 26c1.657 0 3 1.344 3 3s-1.343 3-3 3-3-1.344-3-3 1.343-3 3-3zM25 30c0.553 0 1-0.447 1-1s-0.447-1-1-1-1 0.447-1 1 0.447 1 1 1z"></path>
			</svg>
		<?php break;		

		case 'close' : ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
				<path d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path>
			</svg>
		<?php break;

		case 'left-arrow' : ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21" height="28" viewBox="0 0 21 28">
				<path d="M18.297 4.703l-8.297 8.297 8.297 8.297c0.391 0.391 0.391 1.016 0 1.406l-2.594 2.594c-0.391 0.391-1.016 0.391-1.406 0l-11.594-11.594c-0.391-0.391-0.391-1.016 0-1.406l11.594-11.594c0.391-0.391 1.016-0.391 1.406 0l2.594 2.594c0.391 0.391 0.391 1.016 0 1.406z"></path>
			</svg>
		<?php break;			

		case 'menu': ?>
			<span></span>
			<span></span>
			<span></span>
			<span></span>		
		<?php break;

		case 'pin': ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="28" viewBox="0 0 18 28">
				<path d="M7.5 13.5v-7c0-0.281-0.219-0.5-0.5-0.5s-0.5 0.219-0.5 0.5v7c0 0.281 0.219 0.5 0.5 0.5s0.5-0.219 0.5-0.5zM18 19c0 0.547-0.453 1-1 1h-6.703l-0.797 7.547c-0.031 0.25-0.234 0.453-0.484 0.453h-0.016c-0.25 0-0.453-0.172-0.5-0.422l-1.188-7.578h-6.312c-0.547 0-1-0.453-1-1 0-2.562 1.937-5 4-5v-8c-1.094 0-2-0.906-2-2s0.906-2 2-2h10c1.094 0 2 0.906 2 2s-0.906 2-2 2v8c2.063 0 4 2.438 4 5z"></path>
			</svg>
		<?php break;

		case 'right-arrow' : ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19" height="28" viewBox="0 0 19 28">
				<path d="M17.297 13.703l-11.594 11.594c-0.391 0.391-1.016 0.391-1.406 0l-2.594-2.594c-0.391-0.391-0.391-1.016 0-1.406l8.297-8.297-8.297-8.297c-0.391-0.391-0.391-1.016 0-1.406l2.594-2.594c0.391-0.391 1.016-0.391 1.406 0l11.594 11.594c0.391 0.391 0.391 1.016 0 1.406z"></path>
			</svg>
		<?php break;				

		case 'search': ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
				<path d="M15.56 15.56c-0.587 0.587-1.538 0.587-2.125 0l-2.652-2.652c-1.090 0.699-2.379 1.116-3.771 1.116-3.872 0-7.012-3.139-7.012-7.012s3.14-7.012 7.012-7.012c3.873 0 7.012 3.139 7.012 7.012 0 1.391-0.417 2.68-1.116 3.771l2.652 2.652c0.587 0.587 0.587 1.538 0 2.125zM7.012 2.003c-2.766 0-5.009 2.242-5.009 5.009s2.243 5.009 5.009 5.009c2.766 0 5.009-2.242 5.009-5.009s-2.242-5.009-5.009-5.009z"></path>
			</svg>
		<?php break;

		case 'up-arrow' : ?>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28" height="28" viewBox="0 0 28 28">
				<path d="M26.297 20.797l-2.594 2.578c-0.391 0.391-1.016 0.391-1.406 0l-8.297-8.297-8.297 8.297c-0.391 0.391-1.016 0.391-1.406 0l-2.594-2.578c-0.391-0.391-0.391-1.031 0-1.422l11.594-11.578c0.391-0.391 1.016-0.391 1.406 0l11.594 11.578c0.391 0.391 0.391 1.031 0 1.422z"></path>
			</svg>
		<?php break;		
	}
}
endif;

if ( ! function_exists( 'polestar_strip_gallery' ) ) :
/**
 * Removes the first gallery on the page.
 */
function polestar_strip_gallery( $content ) {
	preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

	if ( ! empty( $matches ) ) {
		foreach ( $matches as $shortcode ) {
			if ( 'gallery' === $shortcode[2] ) {
				$pos = strpos( $content, $shortcode[0] );
				if( false !== $pos ) {
					return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
				}
			}
		}
	}

	return $content;
}
endif;

if ( ! function_exists( 'polestar_get_image' ) ) :
/**
 * Gets the first image on the page.
 */
function polestar_get_image() {
	$first_image = '';

	$output = preg_match_all( '/<img[^>]+\>/i', get_the_content(), $images );
	$first_image = $images[0][0];

	return ( '' !== $first_image ) ? $first_image : false;
}
endif;

if ( ! function_exists( 'polestar_strip_image' ) ) :
/**
 * Removes the first image on the page.
 */
function polestar_strip_image( $content ) {
	return preg_replace( '/<img[^>]+\>/i', '', $content, 1 );
}
endif;

if ( ! function_exists( 'polestar_get_video' ) ) :
/**
 * Get the video from the current post.
 */
function polestar_get_video() {
	$first_url    = '';
	$first_video  = '';

	$i = 0;

	preg_match_all( '|^\s*https?://[^\s"]+\s*$|im', get_the_content(), $urls );

	foreach ( $urls[0] as $url ) {
		$i++;

		if ( 1 === $i ) {
			$first_url = trim( $url );
		}

		$oembed = wp_oembed_get( esc_url( $url ) );

		if ( ! $oembed ) continue;

		$first_video = $oembed;

		break;
	}

	return ( '' !== $first_video ) ? $first_video : false;
}
endif;

if ( ! function_exists( 'polestar_strip_video' ) ) :
/**
 * Removes the first video from the page.
 */
function polestar_strip_video( $content ) {
	if ( polestar_get_video() ) {
		preg_match_all( '|^\s*https?://[^\s"]+\s*$|im', $content, $urls );

		if ( ! empty( $urls[0] ) ) {
			$content = str_replace( $urls[0], '', $content );
		}

		return $content;
	}
}
endif;

if ( ! function_exists( 'polestar_display_logo' ) ) :
/**
 * Display the logo or site title and site description.
 */
function polestar_display_logo() {
	$logo = get_theme_mod( 'logo' );

	if ( $logo ) {
		$attrs = apply_filters( 'polestar_logo_attributes', array() );

		?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="screen-reader-text"><?php esc_html_e( 'Home', 'polestar' ); ?></span><?php
			echo wp_get_attachment_image( $logo, 'full', false, $attrs );
		?></a><?php if ( get_theme_mod( 'tagline' ) && get_bloginfo( 'description' ) ) : ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		<?php endif;

	} elseif ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		?><?php the_custom_logo();
		if ( get_theme_mod( 'tagline' ) && get_bloginfo( 'description' ) ) : ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		<?php endif;
	}
	else {
		if ( is_front_page() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php if ( get_theme_mod( 'tagline' ) && get_bloginfo( 'description' ) ) : ?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php endif; ?>				
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php if ( get_theme_mod( 'tagline' ) && get_bloginfo( 'description' ) ) : ?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php endif; ?>			
		<?php endif;
	}
}
endif;

if ( ! function_exists( 'polestar_excerpt_length' ) ) :
/**
 * Filter the excerpt length.
 */
function polestar_excerpt_length( $length ) {
	return get_theme_mod( 'excerpt_length', 55 );
}
add_filter( 'excerpt_length', 'polestar_excerpt_length', 10 );
endif;

if ( ! function_exists( 'polestar_excerpt_more' ) ) :
/**
 * Add a more link to the excerpt.
 */
function polestar_excerpt_more( $more ) {
	if ( is_search() ) return;
	if ( get_theme_mod( 'archive_post_content' ) == 'excerpt' && get_theme_mod( 'excerpt_more', true ) ) {
		$read_more_text = get_theme_mod( 'read_more_text', esc_html__( 'Continue reading', 'polestar' ) );
		return the_title( '<span class="screen-reader-text">"', '"</span>', false ) . '<p><span class="more-wrapper"><a href="' . esc_url( get_permalink() ) . '">' . $read_more_text . ' <span class="icon-long-arrow-right"></span></a></span></p>';
	}
}
endif;
add_filter( 'excerpt_more', 'polestar_excerpt_more' );

if ( ! function_exists( 'polestar_read_more_link' ) ) :
/**
 * Filter the read more link.
 */
function polestar_read_more_link() {
	$read_more_text = get_theme_mod( 'read_more_text', esc_html__( 'Continue reading', 'polestar' ) );
	return the_title( '<span class="screen-reader-text">"', '"</span>', false ) . '<span class="more-wrapper"><a href="' . esc_url( get_permalink() ) . '">' . $read_more_text . ' <span class="icon-long-arrow-right"></span></a></span>';
}
endif;
add_filter( 'the_content_more_link', 'polestar_read_more_link' );

if ( ! function_exists( 'polestar_post_meta' ) ) :
/**
 * Print HTML with meta information for the sticky status, current post-date/time, author, comment count and post categories.
 */
function polestar_post_meta() {
	if ( ( is_home() || is_archive() || is_search() ) && get_theme_mod( 'post_date', true ) ) {
		echo '<span class="entry-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date( apply_filters( 'polestar_date_format', 'F d, Y' ) ) ) . '</time><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time></span></a>';
	}

	if ( is_single() && get_theme_mod( 'post_date', true ) ) {
		echo '<span class="entry-date"><time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date( apply_filters( 'polestar_date_format', 'F d, Y' ) ) ) . '</time><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time></span>';
	}

	if ( get_theme_mod( 'post_author', true ) ) {
		echo '<span class="byline"><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . esc_html( get_the_author() ) . '</a></span></span>';
	}
	
	if ( comments_open() && get_theme_mod( 'post_comment_count', true ) ) { 
		echo '<span class="comments-link">';
  		comments_popup_link( esc_html__( 'Leave a comment', 'polestar' ), esc_html__( 'One Comment', 'polestar' ), esc_html__( '% Comments', 'polestar' ) );
  		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'polestar_entry_thumbnail_meta' ) ) :
/**
 * Print HTML with meta information for the sticky status, current post-date/time, author, comment count and post categories.
 */
function polestar_entry_thumbnail_meta() {
	echo '<div class="thumbnail-meta">';
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<ul><li>' . esc_html__( 'Sticky', 'polestar' ) . '</li></ul>';
	}
	if ( has_category() ) {
		echo get_the_category_list();
	}
	echo '</div>';
}
endif;

if ( ! function_exists( 'polestar_related_posts' ) ) :
/**
 * Display related posts on single posts.
 */
function polestar_related_posts( $post_id ) {
	if ( function_exists( 'related_posts' ) ) { // Check for YARPP plugin (https://wordpress.org/plugins/yet-another-related-posts-plugin/).
		related_posts();
	} else { // The fallback loop.
		$categories = get_the_category( $post_id );
		$first_cat = $categories[0]->cat_ID;
		$args=array(
			'category__in' => array( $first_cat ),
			'post__not_in' => array( $post_id ),
			'posts_per_page' => 3,
			'ignore_sticky_posts' => -1
		);
		$related_posts = new WP_Query( $args ); ?>

		<div class="related-posts-section">
			<h2 class="related-posts"><?php esc_html_e( 'You May Also Like', 'polestar' ); ?></h2>
			<?php if ( $related_posts ) : ?>
				<ol>
					<?php if ( $related_posts->have_posts() ) : ?>
						<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<?php 
									if ( has_post_thumbnail() && is_active_sidebar( 'sidebar-main' ) )
										the_post_thumbnail( 'polestar-247x164-crop' );
									elseif ( has_post_thumbnail() )
										the_post_thumbnail( 'polestar-354x234-crop' );
									?>
									<h3 class="related-post-title"><?php the_title(); ?></h3>
									<p class="related-post-date"><?php the_time( apply_filters( 'polestar_date_format', 'F d, Y' ) ); ?></p>
								</a>
							</li>
						<?php endwhile; ?>
					<?php endif; ?>
				</ol>
			<?php else : ?>
				<p><?php esc_html_e( 'No related posts.', 'polestar' ); ?></p>
			<?php endif; ?>
		</div>
		<?php wp_reset_query();
	}
}
endif;

if ( ! function_exists( 'polestar_tag_cloud' ) ) :
/**
 * Filter the Tag Cloud widget.
 */
function polestar_tag_cloud( $args ) {
	$args['unit'] = 'px';
	$args['largest'] = 12;
	$args['smallest'] = 12;
	return $args;
}
endif;
add_filter( 'widget_tag_cloud_args', 'polestar_tag_cloud' );
