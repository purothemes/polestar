<?php
/**
 * Implements styles set in the theme Customizer.
 *
 * @package polestar
 * @license GPL 2.0 
 */

if ( ! function_exists( 'polestar_build_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @return void
 */
function polestar_build_styles() {		
		
}
endif;
add_action( 'customizer_library_styles', 'polestar_build_styles' );

if ( ! function_exists( 'polestar_styles' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @return void
 */
function polestar_styles() {

	do_action( 'customizer_library_styles' );

	// Echo the rules.
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<style type=\"text/css\" id=\"polestar-custom-css\">\n";
		echo $css;
		echo "\n</style>\n";
	}
}
endif;
add_action( 'wp_head', 'polestar_styles', 11 );
