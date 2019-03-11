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

		// Color.
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
				'.site-content .more-wrapper a:hover',
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

		// Background Hex.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'button',
				'.button',
				'.pagination .page-numbers:hover',
				'.pagination .page-numbers:focus',
				'.pagination .current',
				'#infinite-handle span button',
				'#infinite-handle span button:hover',
				'.added_to_cart',
				'input[type="button"]',
				'input[type="reset"]',
				'input[type="submit"]',
				'.main-navigation ul .menu-button a',
				'.page-links .post-page-numbers:hover',
				'.page-links .post-page-numbers.current',
				'.tags-links a:hover',
				'#page .widget_tag_cloud a:hover'
			),
			'declarations' => array(
				'background' => $color
			)
		) );

		// Background RGBA.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.button:hover',
				'#infinite-handle span button:hover',
				'button:hover',
				'.added_to_cart:hover',
				'input[type="button"]:hover',
				'input[type="reset"]:hover',
				'input[type="submit"]:hover',
				'.main-navigation ul .menu-button a:hover'
			),
			'declarations' => array(
				'background-color' => 'rgba(' . $color_rgb . ', 0.8)'
			)
		) );

		// Border Color.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'blockquote'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );

		// WooCommerce
		if ( function_exists( 'is_woocommerce' ) ) {

			// Color.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .shopping-cart-dropdown .widget li a:hover',
					'.woocommerce .woocommerce-breadcrumb a:hover',
					'.woocommerce .woocommerce-breadcrumb a:hover',
					'.woocommerce .star-rating',
					'.woocommerce .star-rating:before',
					'.woocommerce a .star-rating',
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

			// Background.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .shopping-cart-link .shopping-cart-count',
					'.woocommerce .woocommerce-pagination ul li a:hover',
					'.woocommerce .woocommerce-pagination ul li a.current',
					'.woocommerce .woocommerce-pagination ul li > span:hover',
					'.woocommerce .woocommerce-pagination ul li > span.current',
					'.woocommerce .onsale'
				),
				'declarations' => array(
					'background' => $color
				)
			) );

			// Background RGBA.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .shopping-cart-link:hover .shopping-cart-count'
				),
				'declarations' => array(
					'background' => 'rgba(' . $color_rgb . ', 0.8)'
				)
			) );

			// Border Color.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.woocommerce .product .woocommerce-tabs .wc-tabs li.active'
				),
				'declarations' => array(
					'border-color' => $color
				)
			) );

		} // endif is_woocommerce.
		
	}

	// Heading Color.
	$setting = 'heading_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		// Color.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'table th',
				'label',
				'fieldset legend',
				'.main-navigation li a',
				'#mobile-navigation ul li a',
				'#mobile-navigation ul li .dropdown-toggle',
				'.comment-navigation a',
				'.widget #wp-calendar caption',
				'.widget #wp-calendar tfoot #prev a',
				'.widget #wp-calendar tfoot #next a',
				'.site-content .entry-title',
				'.site-content .entry-title a',
				'.site-content .more-wrapper a',
				'.page-links .page-links-title',
				'.comment-list .comment .author',
				'.comment-list .pingback .author',
				'.comment-list .comment .author a',
				'.comment-list .pingback .author a',
				'.comment-list .comment .comment-reply-link',
				'.comment-list .pingback .comment-reply-link'
			),
			'declarations' => array(
				'color' => $color
			)
		) );

		// WooCommerce
		if ( function_exists( 'is_woocommerce' ) ) {

			// Color.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .shopping-cart-text'
				),
				'declarations' => array(
					'color' => $color
				)
			) );

			// Fill.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .shopping-cart-link svg'
				),
				'declarations' => array(
					'fill' => $color
				)
			) );

		} // endif is_woocommerce.

		if ( ! function_exists( 'polestar_premium_setup' ) ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .site-branding .site-title a',
				),
				'declarations' => array(
					'color' => $color
				)
			) );

		}

		// Background.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#mobile-menu-button span'
			),
			'declarations' => array(
				'background' => $color
			)
		) );

		// Fill.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.main-navigation .search-icon svg path',
				'.site-header #header-search #close-search svg path'
			),
			'declarations' => array(
				'fill' => $color
			)
		) );

		// WooCommerce
		if ( function_exists( 'is_woocommerce' ) ) {

			// Color.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.woocommerce .woocommerce-ordering .ordering-selector-wrapper:hover',
					'.woocommerce .woocommerce-ordering .ordering-selector-wrapper .ordering-dropdown li:hover',
					'.woocommerce .product .summary .product_meta',
					'.woocommerce .product .woocommerce-tabs .wc-tabs li a',
					'.woocommerce .product .woocommerce-Reviews .meta',
					'.woocommerce .product .woocommerce-Reviews .meta a',
					'.woocommerce-message',
					'.woocommerce-error',
					'.woocommerce-info'
				),
				'declarations' => array(
					'color' => $color
				)
			) );

			// Fill.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.woocommerce .woocommerce-ordering .ordering-selector-wrapper:hover',
					'.woocommerce .woocommerce-ordering .ordering-selector-wrapper:hover svg path'
				),
				'declarations' => array(
					'fill' => $color
				)
			) );

		} // endif is_woocommerce.
	}

	// Text Color.
	$setting = 'text_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		// Color.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body',
				'button',
				'input',
				'select',
				'textarea',
				'blockquote cite',
				'a:hover',
				'a:focus',
				'a:active',
				'.main-navigation li:hover > a',
				'.main-navigation li.focus > a',
				'#mobile-navigation ul li a:hover',
				'#mobile-navigation ul li .dropdown-toggle:hover',
				'.pagination .page-numbers',
				'.pagination .page-numbers:visited',
				'.site-content .post-navigation a',
				'.entry-title a:hover',
				'.page-links .page-links-title:hover',
				'.page-links a span',
				'.tags-links a',
				'#page .widget_tag_cloud a',
				'.author-box .author-description span a',
				'.comment-list .comment',
				'.comment-list .pingback',
				'.comment-list .comment .author a:hover',
				'.comment-list .pingback .author a:hover',
				'#commentform .comment-notes a',
				'#commentform .logged-in-as a',
				'#commentform .comment-subscription-form label',
				'.widget-area .widget a', 
				'.site-footer .widget a',
				'.site-header .shopping-cart-dropdown .widget li a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );

		if ( ! function_exists( 'polestar_premium_setup' ) ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .site-branding .site-description'
				),
				'declarations' => array(
					'color' => $color
				)
			) );

		}

		// Border Color.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'abbr',
				'acronym'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );		

		// Fill.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.main-navigation .search-icon svg:hover path',
				'.site-header #header-search #close-search svg:hover path'
			),
			'declarations' => array(
				'fill' => $color
			)
		) );

		// WooCommerce
		if ( function_exists( 'is_woocommerce' ) ) {

			// Color.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .shopping-cart-link:hover .shopping-cart-text',
					'.woocommerce .woocommerce-pagination ul li a',
					'.woocommerce .woocommerce-pagination ul li > span',
					'.woocommerce .products .product h3:hover',
					'.woocommerce .products .product .price',
					'.woocommerce .price',
					'.woocommerce .product .summary .variations .reset_variations',
					'.woocommerce .product .summary .product_meta a',
					'.woocommerce .product .woocommerce-Reviews .meta a:hover',
					'.woocommerce-cart table.cart .cart_item a',
					'.woocommerce-account .woocommerce-MyAccount-navigation ul li a'
				),
				'declarations' => array(
					'color' => $color
				)
			) );

			// Fill.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .shopping-cart-link:hover svg',
					'.woocommerce .woocommerce-ordering .ordering-selector-wrapper svg path',
				),
				'declarations' => array(
					'fill' => $color
				)
			) );

		} // endif is_woocommerce.
	}

	// Secondary Text Color.
	$setting = 'secondary_text_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		// Color.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-content .post-navigation a .sub-title',
				'.breadcrumbs',
				'.breadcrumbs a',
				'.entry-meta > span',
				'.entry-meta > span:after',
				'.yarpp-related ol li .related-post-date',
				'.related-posts-section ol li .related-post-date',
				'.comment-list .comment .date',
				'.comment-list .pingback .date',
				'.comment-reply-title #cancel-comment-reply-link'
			),
			'declarations' => array(
				'color' => $color
			)
		) );

		// Fill.
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.search-form button[type="submit"] svg path'
			),
			'declarations' => array(
				'fill' => $color
			)
		) );

		// WooCommerce
		if ( function_exists( 'is_woocommerce' ) ) {

			// Color.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.woocommerce .woocommerce-breadcrumb',
					'.woocommerce .woocommerce-breadcrumb a',
					'.woocommerce .woocommerce-result-count',
					'.woocommerce .woocommerce-ordering .ordering-selector-wrapper .ordering-dropdown li',
					'.woocommerce .product .summary .woocommerce-review-link',
					'.woocommerce .product .woocommerce-Reviews .comment-date',
					'.woocommerce-cart table.cart .cart_item a:hover'
				),
				'declarations' => array(
					'color' => $color
				)
			) );

			// Fill.
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.widget_product_search .woocommerce-product-search button[type="submit"] svg path'
				),
				'declarations' => array(
					'fill' => $color
				)
			) );

		} // endif is_woocommerce.
	}

	// Heading Font.
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
				'fieldset legend',
				'.main-navigation li',
				'#mobile-navigation ul li'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

		if ( ! function_exists( 'polestar_premium_setup' ) ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .site-branding .site-title',
					'.site-header .site-branding .site-description'
				),
				'declarations' => array(
					'font-family' => $stack
				)
			) );

		}

		// WooCommerce
		if ( function_exists( 'is_woocommerce' ) ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .shopping-cart-link',
					'.woocommerce .product .woocommerce-tabs .wc-tabs li'
				),
				'declarations' => array(
					'font-family' => $stack
				)
			) );

		} // endif is_woocommerce.
	}

	// Body Font.
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
				'textarea',
				'.comment-reply-title #cancel-comment-reply-link'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

		if ( function_exists( 'is_woocommerce' ) ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-header .shopping-cart-dropdown *'
				),
				'declarations' => array(
					'font-family' => $stack
				)
			) );

		} // endif is_woocommerce.
	}

}
endif;
add_action( 'customizer_library_styles', 'polestar_build_styles' );

function polestar_mobile_menu_collapse() {
	$setting = 'mobile_menu_collapse';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( ! $mod ) {
		$number = 780;
	} else {
		$number = customizer_library_sanitize_number_absint( $mod, $setting );
	}

	$number_min = $number + 1;
	
	Customizer_Library_Styles()->add( array(
		'selectors' => array(
			'body:not(.page-layout-stripped) #masthead.mobile-menu .main-navigation > div:not(.mega-menu-wrap)',
			'#masthead.mobile-menu .main-navigation .shopping-cart',
			'#masthead.mobile-menu .main-navigation .search-icon'
		),
		'declarations' => array(
			'display' => 'none'
		),
		'media' => '(max-width:' . $number . 'px)'
	) );

	Customizer_Library_Styles()->add( array(
		'selectors' => array(
			'#masthead.mobile-menu #mobile-menu-button'
		),
		'declarations' => array(
			'display' => 'inline-block'
		),
		'media' => '(max-width:' . $number . 'px)'
	) );

	Customizer_Library_Styles()->add( array(
		'selectors' => array(
			'.site-header #mobile-navigation'
		),
		'declarations' => array(
			'display' => 'none !important'
		),
		'media' => '(min-width:' . $number_min . 'px)'
	) );

	if ( is_active_sidebar( 'sidebar-polestar-header' ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header .widgets .widget'
			),
			'declarations' => array(
				'margin' => '0 0 5% 0',
				'text-align' => 'center',
				'width' => '100% !important'
			),
			'media' => '(max-width:' . $number . 'px)'
		) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header .widgets .widget:last-of-type'
			),
			'declarations' => array(
				'margin-bottom' => '0',
			),
			'media' => '(max-width:' . $number . 'px)'
		) );
	}
}
add_action( 'customizer_library_styles', 'polestar_mobile_menu_collapse' );

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
