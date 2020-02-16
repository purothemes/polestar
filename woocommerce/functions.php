<?php
/**
 * Add theme support for Woocommerce.
 *
 * @package polestar
 * @license GPL 2.0 
 */

function polestar_woocommerce_setup() {

	/**
	 * Add support for WooCommerce.
	 * @link https://docs.woocommerce.com/document/declare-woocommerce-support-in-third-party-theme/
	 */
	add_theme_support( 'woocommerce' );

	/**
	 * Add support for WooCommerce galleries.
	 * @link https://woocommerce.wordpress.com/2017/02/28/adding-support-for-woocommerce-2-7s-new-gallery-feature-to-your-theme/
	 */
	add_theme_support( 'wc-product-gallery-slider' );

	if ( get_theme_mod( 'product_gallery' ) == 'slider_lightbox' ) {
		add_theme_support( 'wc-product-gallery-lightbox' );
	} elseif ( get_theme_mod( 'product_gallery' ) == 'slider_zoom' ) {
		add_theme_support( 'wc-product-gallery-zoom' );
	} elseif ( get_theme_mod( 'product_gallery' ) == 'slider_lightbox_zoom' ) {
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
	}

	/**
	 * Remove the default WooCommerce stylesheets.
	 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
	 */
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	// Remove the default WooCommerce containers.
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

}
add_action( 'after_setup_theme', 'polestar_woocommerce_setup' );

/**
 * Enqueue WooCommerce scripts and styles.
 */
function polestar_woocommerce_scripts() {

	// WooCommerce stylesheet.
	wp_enqueue_style( 'polestar-woocommerce-style', get_template_directory_uri() . '/woocommerce' . PURO_THEME_CSS_PREFIX . '.css', array(), PURO_THEME_VERSION );

	// WooCommerce JavaScript.
	wp_enqueue_script( 'polestar-woocommerce-script', get_template_directory_uri() . '/woocommerce/js/jquery.woocommerce'  . PURO_THEME_JS_PREFIX .  '.js', array( 'jquery' ), PURO_THEME_VERSION, true );

	$script_data = array(
		'chevron_down' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10" height="10" viewBox="0 0 32 32"><path d="M30.054 14.429l-13.25 13.232q-0.339 0.339-0.804 0.339t-0.804-0.339l-13.25-13.232q-0.339-0.339-0.339-0.813t0.339-0.813l2.964-2.946q0.339-0.339 0.804-0.339t0.804 0.339l9.482 9.482 9.482-9.482q0.339-0.339 0.804-0.339t0.804 0.339l2.964 2.946q0.339 0.339 0.339 0.813t-0.339 0.813z"></path></svg>',
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	);
	wp_localize_script( 'polestar-woocommerce-script', 'polestar_data', $script_data );

}
add_action( 'wp_enqueue_scripts', 'polestar_woocommerce_scripts' );

/**
 * Markup to be outputted before WooCommerce content.
 */
function polestar_woocommerce_wrapper_before() {
	echo '<div id="primary" class="content-area"><main id="main" class="site-main">';
}
add_action( 'woocommerce_before_main_content', 'polestar_woocommerce_wrapper_before' );

/**
 * Markup to be outputted after WooCommerce content.
 */
function polestar_woocommerce_wrapper_after() {
	echo '</main><!-- #main --></div><!-- #primary -->';
}
add_action( 'woocommerce_after_main_content', 'polestar_woocommerce_wrapper_after' );

if ( ! function_exists( 'polestar_woocommerce_update_cart_count' ) ) :
/**
 * Update cart count with the masthead cart icon.
 */
function polestar_woocommerce_update_cart_count( $fragments ) {
	ob_start();
	?>
	<span class="shopping-cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
	<?php

	$fragments['span.shopping-cart-count'] = ob_get_clean();

	return $fragments;
}
endif;
add_filter( 'woocommerce_add_to_cart_fragments', 'polestar_woocommerce_update_cart_count' );

/**
 * Filter the product archive pagination.
 */
function polestar_woocommerce_pagination_args( $array ) {
	$array = array(
		'prev_text'    => '<span class="icon-long-arrow-left"></span>',
		'next_text'    => '<span class="icon-long-arrow-right"></span>',
		'type'         => 'list',
	);
	return $array;
}
add_filter( 'woocommerce_pagination_args', 'polestar_woocommerce_pagination_args', 10, 1 );

/**
 * Change the gallery thumbnail image size.
 * @link https://github.com/woocommerce/woocommerce/wiki/Customizing-image-sizes-in-3.3-
 */
function polestar_woocommerce_single_gallery_thumbnail_size( $size ) {
	return array(
		'width'  => 150,
		'height' => 150,
		'crop'   => 1,
	);
}
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'polestar_woocommerce_single_gallery_thumbnail_size' );

/**
 * Custom WooCommerce template tags.
 */
include get_template_directory() . '/woocommerce/template-tags.php';
