/**
 * File jquery.theme.js.
 *
 * Handles the primary JavaScript functions for the theme.
 */
jQuery( function( $ ) {

	// Element viewport visibility.
	$.fn.isVisible = function() {
		var rect = this[0].getBoundingClientRect();
		return (
			rect.bottom >= 0 &&
			rect.right >= 0 &&
			rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
			rect.left <= (window.innerWidth || document.documentElement.clientWidth)
		);
	};		

	// Burst animation.
	var mousePos = {x: 0, y: 0};
	$( document ).mousemove( function( e ) {
		mousePos = {
			x: e.pageX,
			y: e.pageY
		};
	} );

	$.fn.burstAnimation = function( options ) {
		var settings = $.extend( {
			event: "click",
			container: "parent"
		}, options );

		return $( this ).each( function() {
			var $$ = $( this ),
				$p = settings.container === 'parent' ? $$.parent() : $$.closest( settings.container ),
				$o = $( '<div class="burst-animation-overlay"></div>' ),
				$c = $( '<div class="burst-circle"></div>' ).appendTo( $o );

			$$.on( settings.event, function () {
				$o.appendTo( $p );
				$c
					.css( {
						top: mousePos.y - $p.offset().top,
						left: mousePos.x - $p.offset().left,
						opacity: 0.1,
						scale: 1
					} )
					.transition( {
						opacity: 0,
						scale: $p.width()
					}, 500, 'ease', function () {
						$o.detach();
					} );
			} );

		} );
	};	

    // Setup FitVids for entry content, Page Builder by SiteOrigin and WooCommerce. Ignore Tableau.
    if ( typeof $.fn.fitVids !== 'undefined' ) {
        $( '.entry-content, .entry-content .panel, .woocommerce #main' ).fitVids( { ignore: '.tableauViz' } );
    }

	// FlexSlider.
	$( document ).ready( function() {
		if ( $.isFunction( $.fn.flexslider ) ) {
			$( '.featured-posts-slider' ).flexslider( {
				animation: "slide",
				controlNav: false,
				customDirectionNav: $( ".flex-direction-nav a" )
			} );
			$( '.gallery-format-slider' ).flexslider( {
				animation: "slide",
				controlNav: false,
				customDirectionNav: $( ".flex-direction-nav a" )
			} );			
		}
	} );

	// Scroll to top.
	var sttWindowScroll = function () {
		var top = window.pageYOffset || document.documentElement.scrollTop;

		if ( top > $( '#masthead' ).outerHeight() ) {
			if ( ! $( '#scroll-to-top' ).hasClass( 'show' ) ) {
				$( '#scroll-to-top' ).css( 'pointer-events', 'auto' ).addClass( 'show' );
			}
		}
		else {
			if ( $( '#scroll-to-top' ).hasClass( 'show' ) ) {
				$( '#scroll-to-top' ).css( 'pointer-events', 'none' ).removeClass( 'show' );
			}
		}
	};
	sttWindowScroll();
	$( window ).scroll( sttWindowScroll );
	$( '#scroll-to-top' ).click( function () {
		$( 'html, body' ).animate( { scrollTop: 0 } );
	} );

	// Sticky header.
	if ( $( '#masthead' ).hasClass( 'sticky' ) ) {
		var $mhs = false,
			pageTop = $( '#page' ).offset().top,
			$mh = $( '#masthead' );

		var smSetup = function() {

			if ( $mhs === false ) {
				$mhs = $( '<div class="masthead-sentinel"></div>' ).insertAfter( $mh );
				$mhs.css( 'height', $mh.outerHeight() );
			}

			$mh.css( 'position', 'fixed' );
		};
		smSetup();
		$( window ).resize( smSetup ).scroll( smSetup );

		// Sticky header shadow.
		var smShadow = function () {
            if ( $( window ).scrollTop() > 0 ) {
                $( $mh ).addClass( 'stuck' );
            }
            else {
                $( $mh ).removeClass( 'stuck' );
            }			
		};
		smShadow();
        $( window ).scroll( smShadow );

        // Header padding to be used if logo scaling is enabled.
		var mhPadding = {
			top: parseInt( $mh.css( 'padding-top' ) ),
			bottom: parseInt( $mh.css( 'padding-bottom' ) )
		};

		// Sticky header logo scaling.
		if ( $mh.data( 'scale-logo' ) ) {
			var smResizeLogo = function () {
				var top = window.pageYOffset || document.documentElement.scrollTop;
				top -= pageTop;

				var $img = $mh.find( '.site-branding img' ),
					$branding = $mh.find( '.site-branding > *' );

				$img.removeAttr( 'style' );
				var imgWidth = $img.width(),
					imgHeight = $img.height();

				if ( top > 0 ) {
					var scale = 0.775 + ( Math.max( 0, 48 - top ) / 48 * ( 1 - 0.775 ) );

					if ( $img.length ) {

						$img.css( {
							width: imgWidth * scale,
							height: imgHeight * scale,
							'max-width' : 'none'
						} );
					}
					else {
						$branding.css( 'transform', 'scale(' + scale + ')' );
					}

					$mh.css( {
						'padding-top': mhPadding.top * scale,
						'padding-bottom': mhPadding.bottom * scale
					} ).addClass( 'stuck' );
				}
				else {
					if ( ! $img.length ) {
						$branding.css( 'transform', 'scale(1)' );
					}

					$mh.css( {
						'padding-top': mhPadding.top,
						'padding-bottom': mhPadding.bottom
					} ).removeClass( 'stuck' );
				}
			};
			smResizeLogo();
			$( window ).scroll( smResizeLogo ).resize( smResizeLogo );
		}
	}

	// Header search.
	$( '.search-field' ).burstAnimation( {
		event: "focus",
		container: ".search-form"
	} );

	var $hs = $( '#header-search' );
	$( '#masthead .search-icon' ).click( function() {
		$hs.fadeIn( 'fast' );
		$hs.find( 'form' ).css( 'margin-top', - $hs.find( 'form' ).innerHeight() / 2 );
		$hs.find( 'input[type="search"]' ).focus().select();
		$hs.find( '#close-search' ).addClass( 'animate-in' );
	} );
	$hs.find( '#close-search' ).click( function() {
		$hs.fadeOut( 350 );
		$( this ).removeClass( 'animate-in' );
	} );
	$( window ).scroll( function () {
		if ( $hs.is( ':visible' ) ) {
			$hs.find( 'form' ).css( 'margin-top', - $hs.find( 'form' ).outerHeight() / 2 );
		}
	} );

	// Main menu.
	// Remove the no-js body class.
	$( 'body.no-js' ).removeClass( 'no-js' );	
	if ( $( 'body' ).hasClass( 'css3-animations' ) ) {
		// Display the burst animation.
		$( '.search-field' ).burstAnimation( {
			event: "focus",
			container: ".search-form"
		} );

		var resetMenu = function () {
			$( '.main-navigation ul ul' ).each( function() {
				var $$ = $( this );
				var width = Math.max.apply( Math, $$.find( '> li > a' ).map( function () {
					return $( this ).width();
				} ).get() );
				$$.find( '> li > a' ).width( width );
			} );
		};
		resetMenu();
		$( window ).resize( resetMenu );

		// Add keyboard access to the menu.
		$( '.menu-item' ).children( 'a' ).focus( function() {
			$( this ).parents( 'ul, li' ).addClass( 'focus' );
		} );

		// Click event fires after focus event.
		$( '.menu-item' ).children( 'a' ).click( function() {
			$( this ).parents( 'ul, li' ).removeClass( 'focus' );
		} );
		
		$( '.menu-item' ).children( 'a' ).focusout( function() {
			$( this ).parents( 'ul, li' ).removeClass( 'focus' );
		} );

		// Burst animation when the user clicks on a sub link.
		$( '.main-navigation ul ul li a' ).burstAnimation( {
			event: "click",
			container: "parent"
		} );
	}  

	// Mobile menu.
	var $mobileMenu = false;
	$( '#mobile-menu-button' ).click( function ( e ) {
		e.preventDefault();
		var $$ = $( this );
		$$.toggleClass( 'to-close' );

		if ( $mobileMenu === false ) {
			$mobileMenu = $( '<div></div>' )
				.append( $( '.main-navigation ul' ).first().clone() )
				.attr( 'id', 'mobile-navigation' )
				.appendTo( '#masthead' ).hide();	

			if ( $( '#header-search form' ).length ) {
				$mobileMenu.append( $( '#header-search form' ).clone() );
			}
        	$mobileMenu.find( '#primary-menu' ).show().css( 'opacity', 1 );
			$mobileMenu.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false"><i class="icon-chevron-down" aria-hidden="true"></i></button>' );
			$mobileMenu.find( '.dropdown-toggle' ).click( function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-open' ).next( '.children, .sub-menu' ).slideToggle( 'fast' );
			} );

			var mmOverflow = function() {
				if ( $( '#masthead' ).hasClass( 'sticky' ) ) {
					// Don't let the height of the dropdown extend below the bottom of the screen.
					var adminBarHeight = $( '#wpadminbar' ).css( 'position' ) === 'fixed' ? $( '#wpadminbar' ).outerHeight() : 0;
					var mobileMenuHeight = $( window ).height() - $( '#masthead' ).innerHeight() - adminBarHeight;

					if ( $( '#mobile-navigation' ).outerHeight() > mobileMenuHeight ) {
						$( '#mobile-navigation' ).css( {
							'max-height': mobileMenuHeight,
							'overflow-y': 'scroll',
							'-webkit-overflow-scrolling': 'touch'
						} );
					} else {
						$( '#mobile-navigation' ).css( 'max-height', mobileMenuHeight );
					}
				}
			};

			mmOverflow();
			$( window ).resize( mmOverflow );

		}

		$mobileMenu.slideToggle( 'fast' );

		$( '#mobile-navigation a' ).click( function( e ) {
			if ( $mobileMenu.is(' :visible' ) ) {
				$mobileMenu.slideUp( 'fast' );
			}
			
			$$.removeClass( 'to-close' );
		} );

		$( '#mobile-navigation a[href*="#"]:not([href="#"])' ).polestarSmoothScroll();

	} );   

} );	
