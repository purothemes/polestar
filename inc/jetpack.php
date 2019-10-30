<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package polestar
 * @license GPL 2.0 
 */

if ( ! function_exists( 'polestar_jetpack_setup' ) ) :
/**
 * Jetpack setup function.
 *
 */
function polestar_jetpack_setup() {
	/*
	 * Enable support for Jetpack Featured Content.
	 * See https://jetpack.com/support/featured-content/
	 */
	add_theme_support( 'featured-content', array(
		'filter'     => 'polestar_get_featured_posts',
		'post_types' => array( 'post' ),
	) );

	/*
	 * Enable support for Jetpack Infinite Scroll.
	 * See: https://jetpack.com/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render' => 'polestar_infinite_scroll_render',
		'footer' => 'page',
		'posts_per_page' => get_option( 'jetpack_portfolio_posts_per_page' )
	) );
}
endif;
// polestar_jetpack_setup
add_action( 'after_setup_theme', 'polestar_jetpack_setup' );

if ( ! function_exists( 'polestar_infinite_scroll_render' ) ) :
/**
 * Custom render function for Infinite Scroll.
 */
function polestar_infinite_scroll_render() {
	if ( function_exists( 'is_woocommerce' ) && ( is_shop() || is_woocommerce() ) ) {
		echo '<ul class="products">';
		while ( have_posts() ) {
			the_post();
			wc_get_template_part( 'content', 'product' );
		}
		echo '</ul>';
	} else {
		while ( have_posts() ) {
			the_post();
			if ( is_search() ) :
				get_template_part( 'template-parts/content', 'search' );
			else :
				get_template_part( 'template-parts/content', get_post_format() );
			endif;
		}
	}
}
endif;

/**
 * Remove sharing buttons from their default locations.
 */
 function polestar_remove_sharing() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
add_action( 'loop_start', 'polestar_remove_sharing' );
