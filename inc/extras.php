<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package polestar
 * @license GPL 2.0 
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function polestar_body_classes( $classes ) {
	// Group blog.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Header margin.
	if ( is_home() && polestar_has_featured_posts() ) {
		$classes[] = 'no-header-margin';
	}

	// Mobile compatibility classes.
	$classes[] = 'css3-animations';
	$classes[] = 'no-js';
	$classes[] = 'no-touch';

	// Responsive layout.
	$classes[] = 'responsive';

	// Sidebar.
	if ( is_active_sidebar( 'sidebar-main' ) ) {
		 $classes[] = 'sidebar';
	}

	// WooCommerce sidebar.
	if ( is_active_sidebar( 'sidebar-shop' ) && ! is_product() ) {
		 $classes[] = 'woocommerce-sidebar';
	}		

	// Non-singlar pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}		

	return $classes;
}
add_filter( 'body_class', 'polestar_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function polestar_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'polestar_pingback_header' );

if ( ! function_exists( 'polestar_unset_current_menu_class' ) ) :
/**
 * Unset the current menu class.
 */	
function polestar_remove_current_menu_class( $classes ) {
    $disallowed_class_names = array(
        'current-menu-item',
        'current_page_item',
    );
    foreach ( $classes as $class ) {
        if ( in_array( $class, $disallowed_class_names ) ) {
            $key = array_search( $class, $classes );
            if ( false !== $key ) {
                unset( $classes[$key] );
            }
        }
    }
    return $classes;
}
endif;
add_filter( 'nav_menu_css_class', 'polestar_unset_current_menu_class', 10, 1 );

if ( ! function_exists( 'polestar_post_class_filter' ) ) :
/**
* Filter post classes.
* @link https://codex.wordpress.org/Function_Reference/post_class.
*/
function polestar_post_class_filter( $classes ) {
	$classes[] = 'post';

	// Resolves structured data issue in core. See https://core.trac.wordpress.org/ticket/28482.
	if ( is_page() ) {
		$class_key = array_search( 'hentry', $classes );

		if ( $class_key !== false) {
			unset( $classes[ $class_key ] );
		}
	}

	$classes = array_unique( $classes );
	return $classes;
}
endif;
add_filter( 'post_class', 'polestar_post_class_filter' );
