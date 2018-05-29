<?php
/**
 * Deprecated functions.
 *
 * @package polestar
 * @license GPL 2.0
 */

if ( ! function_exists( 'polestar_excerpt_length' ) ) :
/**
 * Filter the excerpt length.
 * @deprecated 1.2.7 Use polestar_excerpt()
 */
function polestar_excerpt_length( $length ) {
	return get_theme_mod( 'excerpt_length', 55 );
}
add_filter( 'excerpt_length', 'polestar_excerpt_length', 10 );
endif;

if ( ! function_exists( 'polestar_excerpt_more' ) ) :
/**
 * Add a more link to the excerpt.
 * @deprecated 1.2.7 Use polestar_excerpt() 
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
