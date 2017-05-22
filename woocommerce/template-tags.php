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
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'polestar_woocommerce_archive_product_image', 10 );
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	// Use a custom upsell function to change number of items.
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'polestar_woocommerce_output_upsells', 15 );

	// Remove the cross-sell display.
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );		

}
endif;
add_action( 'after_setup_theme', 'polestar_woocommerce_change_hooks' );

if ( ! function_exists( 'polestar_woocommerce_archive_product_image' ) ) :
/**
 * Archive product images.
 */
function polestar_woocommerce_archive_product_image() { ?>
	<div class="loop-product-thumbnail">
		<?php woocommerce_template_loop_product_link_open(); ?>
		<?php woocommerce_template_loop_product_thumbnail(); ?>
		<?php woocommerce_template_loop_product_link_close(); ?>
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
	return get_stylesheet_directory_uri() . '/woocommerce/images/paypal-icon.png';
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

if ( ! function_exists( 'polestar_woocommerce_output_upsells' ) ) {
	/*
	 * Change the number of up-sell items.
	 *
	 * @link https://docs.woocommerce.com/document/change-number-of-upsells-output/
	 */
	function polestar_woocommerce_output_upsells() {
		woocommerce_upsell_display( 4, 4 );
	}
}
