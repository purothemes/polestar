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

	// Accent color.
	$setting = 'accent_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );
		$color_rgb = join( ', ', customizer_library_hex_to_rgb( $color ) );		

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a',
				'a:visited',
				'.main-navigation .current a',
				'.main-navigation .current_page_item > a',
				'.main-navigation .current-menu-item > a',
				'.main-navigation .current_page_ancestor > a',
				'.main-navigation .current-menu-ancestor > a',
				'.site-content .post-navigation a:hover',
				'.comment-navigation a:hover',
				'.footer-menu .menu li a:hover',
				'.footer-menu .menu li a:hover:before',
				'.breadcrumbs a:hover',
				'.widget-area .widget a:hover',
				'.site-footer .widget a:hover',
				'.widget #wp-calendar tfoot #prev a:hover',
        		'.widget #wp-calendar tfoot #next a:hover',
        		'.entry-meta > span a:hover',
        		'.more-wrapper a:hover',
        		'.yarpp-related ol li .related-post-title:hover',
        		'.related-posts-section ol li .related-post-title:hover',
        		'.yarpp-related ol li .related-post-date:hover',
        		'.related-posts-section ol li .related-post-date:hover',
        		'.author-box .author-description span a:hover',
        		'.comment-list .comment .comment-reply-link:hover',
      			'.comment-list .pingback .comment-reply-link:hover',
      			'.comment-reply-title #cancel-comment-reply-link:hover',
      			'#commentform .comment-notes a:hover',
    			'#commentform .logged-in-as a:hover',
    			'.site-footer .site-info a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );		

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.button',
				'#infinite-handle span button',
				'#infinite-handle span button:hover',
				'.page-links a span:hover',
				'.page-links span',
				'button',
				'input[type="button"]',
				'input[type="reset"]',
				'input[type="submit"]',
				'.pagination .page-numbers:hover',
				'.pagination .current',
				'.tags-links a:hover',
				'#page .widget_tag_cloud a:hover'

			),
			'declarations' => array(
				'background' => $color
			)
		) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.button:hover, .pagination .page-numbers:hover', 
				'#infinite-handle span button:hover', 
				'.page-links span:hover',
				'button:hover',
				'input[type="button"]:hover',
				'input[type="reset"]:hover',
				'input[type="submit"]:hover'
			),
			'declarations' => array(
				'background' => $color_rgb
			)
		) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.button:hover, .pagination .page-numbers:hover', 
				'#infinite-handle span button:hover', 
				'.page-links span:hover',
				'button:hover',
				'input[type="button"]:hover',
				'input[type="reset"]:hover',
				'input[type="submit"]:hover'
			),
			'declarations' => array(
				'background' => 'rgba(' . $color_rgb . ', 0.8)'
			)
		) );				

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'blockquote'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );

		if ( function_exists( 'is_woocommerce' ) ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.woocommerce .woocommerce-breadcrumb a:hover',
					'.woocommerce .star-rating',
					'.woocommerce .star-rating:before',
					'.woocommerce .price ins',
					'.woocommerce .product .summary .woocommerce-review-link:hover',
					'.woocommerce .product .summary .variations .reset_variations:hover',
					'.woocommerce .product .summary .stock',
					'.woocommerce .product .summary .product_meta a:hover',
					'.woocommerce .product .woocommerce-Reviews .stars a:hover',
					'.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover'
				),
				'declarations' => array(
					'color' => $color
				)
			) );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.woocommerce .woocommerce-pagination ul li a:hover',
					'.woocommerce .woocommerce-pagination ul li a.current',
					'.woocommerce .woocommerce-pagination ul li > span:hover',
					'.woocommerce .woocommerce-pagination ul li > span.current',
					'.button',
					'.woocommerce .products .product .added_to_cart',
					'button',
					'input[type="button"]',
					'input[type="reset"]',
					'input[type="submit"]',
					'.woocommerce .onsale'
				),
				'declarations' => array(
					'background' => $color
				)
			) );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.woocommerce .product .woocommerce-tabs .wc-tabs li.active'
				),
				'declarations' => array(
					'border-color' => $color
				)
			) );								

		}
		
	}

	// Heading color.
	$setting = 'heading_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',			
				'.entry-title',
				'.entry-title a',
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Heading font.
	$setting = 'heading_font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );
	if ( $mod != customizer_library_get_default( $setting ) ) {
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',			
				'.entry-title',
				'.entry-title a',
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );
	}

	// Body font.
	$setting = 'body_font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );
	if ( $mod != customizer_library_get_default( $setting ) ) {
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body',
				'button',
				'input',
				'select',
				'textarea'
			),
			'declarations' => array(
				'font-family' => $stack
			)
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
