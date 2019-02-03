<?php
/**
 * Custom WooCommerce template tags for this theme.
 *
 * @package polestar
 * @license GPL 2.0 
 */

if ( ! function_exists( 'polestar_woocommerce_change_hooks' ) ) :
/**
 * Change default WooCommerce hooks as required.
 */
function polestar_woocommerce_change_hooks() {

	// Modify the archive content.
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'polestar_woocommerce_archive_product_image', 10 );

	// Use a custom upsell function to change number of items.
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'polestar_woocommerce_output_upsells', 15 );

	// Add Quick View hooks.
	add_action( 'polestar_woocommerce_quick_view_images', 'polestar_woocommerce_quick_view_image', 5 );
	add_action( 'polestar_woocommerce_quick_view_title', 'woocommerce_template_single_title', 5 );
	add_action( 'polestar_woocommerce_quick_view_title', 'woocommerce_template_single_rating', 15 );
	add_action( 'polestar_woocommerce_quick_view_content', 'woocommerce_template_single_price', 10 );
	add_action( 'polestar_woocommerce_quick_view_content', 'woocommerce_template_single_excerpt', 15 );
	add_action( 'polestar_woocommerce_quick_view_content', 'woocommerce_template_single_add_to_cart', 20 );	

	// Remove store notice hook.
	remove_action( 'wp_footer', 'woocommerce_demo_store' );

}
endif;
add_action( 'after_setup_theme', 'polestar_woocommerce_change_hooks' );

/**
 * Output the store notification.
 */
function polestar_woocommerce_demo_store() {
	if ( ! is_store_notice_showing() ) {
		return;
	}

	$notice = get_option( 'woocommerce_demo_store_notice' );

	if ( empty( $notice ) ) {
		$notice = __( 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'polestar' );
	}

	echo '<p class="woocommerce-store-notice demo_store">' . wp_kses_post( $notice ) . ' <a href="#" class="woocommerce-store-notice__dismiss-link">' . esc_html__( 'Dismiss', 'polestar' ) . '</a></p>';
}

if ( ! function_exists( 'polestar_woocommerce_archive_product_image' ) ) :
/**
 * Archive product images.
 */
function polestar_woocommerce_archive_product_image() { ?>
	<div class="loop-product-thumbnail">
		<?php woocommerce_template_loop_product_link_open(); ?>
		<?php woocommerce_template_loop_product_thumbnail(); ?>
		<?php woocommerce_template_loop_product_link_close(); ?>
		<?php if ( get_theme_mod( 'quick_view', true ) && ! ( get_theme_mod( 'archive_columns' ) == 5 ) ) {
			polestar_woocommerce_quick_view_button();
		} ?>
		<?php if ( get_theme_mod( 'add_to_cart', true ) && ! ( get_theme_mod( 'archive_columns' ) == 5 ) ) {
			woocommerce_template_loop_add_to_cart();
		} ?>
	</div>
<?php }
endif;

if ( ! function_exists( 'polestar_woocommerce_description_title' ) ) :
/**
 * Remove the product description title.
 */
function polestar_woocommerce_description_title() {
	return '';
}
endif;
add_filter( 'woocommerce_product_description_heading', 'polestar_woocommerce_description_title' );

if ( ! function_exists( 'polestar_woocommerce_paypal_icon' ) ) :
/**
 * Add a consistent PayPal icon.
 */
function polestar_woocommerce_paypal_icon( $url ) {
	return get_template_directory_uri() . '/woocommerce/images/paypal-icon.png';
}
endif;
add_filter( 'woocommerce_paypal_icon', 'polestar_woocommerce_paypal_icon' );

if ( ! function_exists( 'polestar_woocommerce_reviews_title' ) ) :
/**
 * Remove the product reviews title.
 */
function polestar_woocommerce_reviews_title() {
	return '';
}
endif;
add_filter( 'woocommerce_product_review_heading', 'polestar_woocommerce_reviews_title' );

if ( ! function_exists( 'polestar_woocommerce_tag_cloud_widget' ) ) :
/**
 * Filter the WooCommerce Tag Cloud widget.
 */
function polestar_woocommerce_tag_cloud_widget() {
	$args['unit'] = 'px';
	$args['largest'] = 12;
	$args['smallest'] = 12;
	$args['taxonomy'] = 'product_tag';
	return $args;
}
endif;
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'polestar_woocommerce_tag_cloud_widget' );

if ( ! function_exists( 'polestar_woocommerce_output_upsells' ) ) :
/*
 * Change the number of up-sell items.
 *
 * @link https://docs.woocommerce.com/document/change-number-of-upsells-output/
 */
function polestar_woocommerce_output_upsells() {
	woocommerce_upsell_display( 4, 4 );
}
endif;

if ( ! function_exists( 'polestar_woocommerce_quick_view_button' ) ) :
/**
 * Quick view button.
 */
function polestar_woocommerce_quick_view_button() {
	global $product;
	echo '<a href="#" id="product-id-' . $product->get_id() . '" class="button product-quick-view-button" data-product-id="' . $product->get_id() . '">' . esc_html__( 'Quick View', 'polestar') . '</a>';
	$gallery = $product->get_gallery_image_ids();
	if ( ! empty( $gallery ) && ! has_action( 'wp_footer', 'polestar_enqueue_flexslider' ) ) {
		add_action( 'wp_footer', 'polestar_enqueue_flexslider' );
	}
}
endif;

if ( ! function_exists( 'polestar_woocommerce_quick_view_image' ) ) :
/**
 * Displays image in the product quick view.
 */
function polestar_woocommerce_quick_view_image() {
	global $product;
	$gallery = $product->get_gallery_image_ids();

	if ( empty( $gallery ) && ! has_post_thumbnail() ) return;

	if ( empty( $gallery ) ) {
		echo woocommerce_get_product_thumbnail( 'shop_single' );
	} else {
		?>
		<div class="product-images-slider flexslider">
			<ul class="slides">
				<?php if ( has_post_thumbnail() ) {
					$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_element = get_the_post_thumbnail( $product->get_id(), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'title' => $image_title, 'alt' => $image_title ) );
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li class="slide product-featured-image">%s</li>', $image_element ), $product->get_id() );
				} ?>

				<?php if ( $gallery ) {
					foreach ( $gallery as $image ) {
						$image_link = wp_get_attachment_url( $image );
						$image_title = esc_attr( get_the_title( $image ) );
						?>

						<li class="slide product-gallery-image">
							<img src="<?php echo $image_link; ?>" alt="<?php echo $image_title ?>" title="<?php echo $image_title ?>" />
						</li>

						<?php
					}
				} ?>

			</ul>
			<ul class="flex-direction-nav">
				<li class="flex-nav-prev">
					<a class="flex-prev" href="#"><?php polestar_display_icon( 'left-arrow' ); ?></a>
				</li>
				<li class="flex-nav-next">
					<a class="flex-next" href="#"><?php polestar_display_icon( 'right-arrow' ); ?></a>
				</li>
			</ul>
		</div>
	<?php
	}
}
endif;

if ( ! function_exists( 'polestar_woocommerce_quick_view' ) ) :
/**
 * Setup quick view modal in the footer.
 */
function polestar_woocommerce_quick_view() { ?>
	<?php if ( get_theme_mod( 'quick_view', true ) ) : ?>
		<!-- WooCommerce Quick View -->
		<div id="quick-view-container">
			<div id="product-quick-view" class="quick-view"></div>
		</div>
	<?php endif; ?>
<?php }
endif;
add_action( 'wp_footer', 'polestar_woocommerce_quick_view', 100 );

if ( ! function_exists( 'polestar_product_quick_view_ajax' ) ) :
/**
 * Add the Quick View modal content.
 */
function polestar_product_quick_view_ajax() {

	if ( ! isset( $_REQUEST['product_id'] ) ) {
		die();
	}
	$product_id = intval( $_REQUEST['product_id'] );

	// Set the main wp query for the product.
	wp( 'p=' . $product_id . '&post_type=product' );

	ob_start();
	// Load content template.
	wc_get_template( 'quick-view.php' );
	echo ob_get_clean();

	die();
}
endif;
add_action( 'wp_ajax_polestar_product_quick_view', 'polestar_product_quick_view_ajax' );
add_action( 'wp_ajax_nopriv_polestar_product_quick_view', 'polestar_product_quick_view_ajax' );

if ( ! function_exists( 'polestar_woocommerce_quick_view_image' ) ) :
/**
 * Displays image in the product quick view.
 */
function polestar_woocommerce_quick_view_image() {
	global $product;
	$gallery = $product->get_gallery_image_ids();

	if ( empty( $gallery ) && ! has_post_thumbnail() ) return;

	if ( empty( $gallery ) ) {
		echo woocommerce_get_product_thumbnail( 'shop_single' );
	} else {
		?>
		<div class="product-images-slider flexslider">
			<ul class="slides">
				<?php if ( has_post_thumbnail() ) {
					$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_element = get_the_post_thumbnail( $product->get_id(), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'title' => $image_title, 'alt' => $image_title ) );
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li class="slide product-featured-image">%s</li>', $image_element ), $product->get_id() );
				} ?>

				<?php if ( $gallery ) {
					foreach ( $gallery as $image ) {
						$image_link = wp_get_attachment_url( $image );
						$image_title = esc_attr( get_the_title( $image ) );
						?>

						<li class="slide product-gallery-image">
							<img src="<?php echo $image_link; ?>" alt="<?php echo $image_title ?>" title="<?php echo $image_title ?>" />
						</li>

						<?php
					}
				} ?>

			</ul>
		</div>
	<?php
	}
}
endif;
