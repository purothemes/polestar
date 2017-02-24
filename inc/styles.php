<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Customizer Library Demo
 */

if ( ! function_exists( 'polestar_build_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function polestar_build_styles() {

	// Header background color.
	$setting = 'header_background_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header',
				'.site-header .polestar-container'
			),
			'declarations' => array(
				'background' => $color
			)
		) );
	}

	// Header border color.
	$setting = 'header_border_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header'			
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Header padding.
	$setting = 'header_padding';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$number = customizer_library_sanitize_number_absint( $mod, $setting );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header'			
			),
			'declarations' => array(
				'padding-top' => $number . 'px',
				'padding-bottom' => $number . 'px',
			)
		) );
	}

	// Header margin.
	$setting = 'header_margin';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$number = customizer_library_sanitize_number_absint( $mod, $setting );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header',
				'.masthead-sentinel'			
			),
			'declarations' => array(
				'margin-bottom' => $number . 'px',
			)
		) );
	}			

	// Mobile menu collapse.
	$setting = 'mobile_menu_collapse';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod ) {

		$number = customizer_library_sanitize_number_absint( $mod, $setting );

	    Customizer_Library_Styles()->add( array(    	
	        'selectors' => array(
	            '#masthead.mobile-menu .main-navigation ul',
	            '#masthead.mobile-menu .main-navigation .search-icon'
	        ),
	        'declarations' => array(
	            'display' => 'none',
	        ),
	        'media' => '(max-width:' . $number . 'px)'
	    ) );

	    Customizer_Library_Styles()->add( array(    	
	        'selectors' => array(
	            '#masthead.mobile-menu #mobile-menu-button'
	            	        ),
	        'declarations' => array(
	            'display' => 'inline-block',
	        ),
	        'media' => '(max-width:' . $number . 'px)'
	    ) );	    

	}

	// Sidebar width.
	$setting = 'sidebar_width';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$number = customizer_library_sanitize_number_absint( $mod, $setting );

	    Customizer_Library_Styles()->add( array(    	
	        'selectors' => array(
	            '.sidebar .content-area',
	        ),
	        'declarations' => array(
	            'width' => 100 - $number . '%',
	        ),
	    ) );			

	    Customizer_Library_Styles()->add( array(    	
	        'selectors' => array(
	            '.widget-area',
	        ),
	        'declarations' => array(
	            'width' => $number . '%',
	        ),
	    ) );	    	    

	}
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
 * @since  1.0.0.
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
