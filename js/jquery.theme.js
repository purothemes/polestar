/**
 * File jquery.theme.js.
 *
 * Handles the primary JavaScript functions for the theme - (c) Puro, freely distributable under the terms of the GPL 2.0 license. 
 */

/* globals jQuery, polestar */

jQuery( function( $ ) {

	// Element viewport visibility.
	$.fn.polestarIsVisible = function() {
		var rect = this[0].getBoundingClientRect();
		return (
			rect.bottom >= 0 &&
			rect.right >= 0 &&
			rect.top <= ( window.innerHeight || document.documentElement.clientHeight ) &&
			rect.left <= ( window.innerWidth || document.documentElement.clientWidth )
		);
	};

	// Entry thumbnail container size.
	$( window ).load( function() {
		$( '.entry-thumbnail' ).each( function() {
			img = $( this ).find( 'img' );
			img_width = img.width();
			img_height = img.height();
			$( this ).css( {
				maxWidth: img_width,
				maxHeight: img_height,
			} );
		} );
	} );

	// Setup FitVids for entry content, video post formats, SiteOrigin panels and WooCommerce pages. Ignore Tableau.
	if ( typeof $.fn.fitVids !== 'undefined' ) {
		$( '.entry-content, .entry-content .panel, .entry-video, .woocommerce #main' ).fitVids( { ignore: '.tableauViz' } );
	}

	// FlexSlider.
	$( document ).ready( function() {
		$( '.flexslider' ).each( function() {
			$( this ).flexslider( {
				animation: 'slide',
				controlNav: false,
				customDirectionNav: $( this ).find( '.flex-direction-nav a' ),
				start: function() {
					$( '.flexslider .slides img' ).show();
				}
			} );
		} );
	} );

	// Scroll to top.
	var sttWindowScroll = function() {
		var top = window.pageYOffset || document.documentElement.scrollTop;

		if ( top > $( '#masthead' ).outerHeight() ) {
			if ( ! $( '#scroll-to-top' ).hasClass( 'show' ) ) {
				$( '#scroll-to-top' ).css( 'pointer-events', 'auto' ).addClass( 'show' );
			}
		} else {
			if ( $( '#scroll-to-top' ).hasClass( 'show' ) ) {
				$( '#scroll-to-top' ).css( 'pointer-events', 'none' ).removeClass( 'show' );
			}
		}
	};
	sttWindowScroll();
	$( window ).scroll( sttWindowScroll );
	$( '#scroll-to-top' ).click( function() {
		$( 'html, body' ).animate( { scrollTop: 0 } );
	} );

	// Header search.
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
	$( window ).scroll( function() {
		if ( $hs.is( ':visible' ) ) {
			$hs.find( 'form' ).css( 'margin-top', - $hs.find( 'form' ).outerHeight() / 2 );
		}
	} );

	// Close the header search when clicking outside of the search field or open search button.
	$( '#header-search input[type=search]' ).on( 'focusout', function( e ) {
		if ( $( 'body' ).hasClass( 'disable-search-close' ) ) {
			return;
		}		
		$( '#close-search.animate-in' ).trigger( 'click' );
	} );

	// Close the header search with the escape key.
	$( document ).keyup( function( e ) {
		if ( e.keyCode === 27 ) { // Escape key maps to keycode 27.
			$( '#close-search.animate-in' ).trigger( 'click' );
		}
	} );

	// Main menu.
	$( window ).load( function() {
		$( 'body.no-js' ).removeClass( 'no-js' );
		if ( $( 'body' ).hasClass( 'css3-animations' ) ) {

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
		}
	} );

	// Main menu current menu item indication.
	$( document ).ready( function( $ ) {
		if ( window.location.hash ) {
			return;
		} else {
			$( '#site-navigation a[href="'+ window.location.href +'"]' ).parent( 'li' ).addClass( 'current-menu-item' );
		}
		$( window ).scroll( function() {
			if ( $( '#site-navigation ul li' ).hasClass( 'current' ) ) {
				$( '#site-navigation li' ).removeClass( 'current-menu-item' );
				$( '#site-navigation li.current-menu-ancestor' ).removeClass( 'current-menu-ancestor current-menu-parent' );
			} else {
				if ( $( document ).scrollTop() == 0 ) {
					$( '#site-navigation a[href="'+ window.location.href +'"]' ).parent( 'li' ).addClass( 'current-menu-item' );
					$( '#site-navigation a[href="'+ window.location.href +'"]' ).parents( 'li.menu-item-has-children' ).addClass( 'current-menu-ancestor current-menu-parent' );
				}
			}
		} );
	} );

	// Detect if is a touch device. We detect this through ontouchstart, msMaxTouchPoints and MaxTouchPoints.
	if ( 'ontouchstart' in document.documentElement || window.navigator.msMaxTouchPoints || window.navigator.MaxTouchPoints ) {
		if ( /iPad|iPhone|iPod/.test( navigator.userAgent ) && ! window.MSStream ) {
			$( 'body' ).css( 'cursor', 'pointer' );
			$( 'body' ).addClass( 'ios' );
		}

		$( '.main-navigation #primary-menu' ).find( '.menu-item-has-children > a' ).each( function() {
			$( this ).on( 'click touchend', function( e ) {
				var link = $( this );
				e.stopPropagation();

				if ( e.type == 'click' ) {
					return;
				}

				if ( ! link.parent().hasClass( 'hover' ) ) {
					// Remove .hover from all other sub menus.
					$( '.menu-item.hover' ).removeClass( 'hover' );
					link.parents('.menu-item').addClass( 'hover' );
					e.preventDefault();
				}

				// Remove .hover class when user clicks outside of sub menu.
				$( document ).one( 'click', function() {
					link.parent().removeClass( 'hover' );
				} );

			} );
		} );
	}

	// Smooth scroll from internal page anchors.
	headerHeight = function() {
		var adminBarHeight = $( '#wpadminbar' ).outerHeight(),
			isAdminBar = $( 'body' ).hasClass( 'admin-bar' ),
			isStickyHeader = $( 'header' ).hasClass( 'sticky' ),
			headerHeight;

		// Header height. 1px to account for header shadow.
		if ( isStickyHeader && isAdminBar && $( window ).width() > 600 ) { // From 600px the admin bar isn't sticky so we shouldn't take its height into account.
			headerHeight = adminBarHeight + $( 'header' ).outerHeight() - 1;
		} else if ( isStickyHeader ) {
			headerHeight = $( 'header' ).outerHeight() - 1;
		} else {
			headerHeight = 0;
		}
		return headerHeight;
	};

	$.fn.polestarSmoothScroll = function() {

		if ( $( 'body' ).hasClass( 'disable-smooth-scroll' ) ) {
			return;
		}

		$( this ).click( function( e ) {

			var hash    = this.hash;
			var idName  = hash.substring( 1 ); // Get ID name.
			var alink   = this;                // This button pressed.

			// Check if there is a section that had same id as the button pressed.
			if ( $( '.panel-grid [id*=' + idName + ']' ).length > 0 ) {
				$( '#site-navigation .current' ).removeClass( 'current' );
				$( alink ).parent( 'li' ).addClass( 'current' );
			} else {
				$( '#site-navigation .current' ).removeClass( 'current' );
			}
			if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
				var target = $( this.hash );
				target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) +']' );
				if ( target.length ) {
					$( 'html, body' ).animate( {
						scrollTop: target.offset().top - headerHeight()
					},
					{
						duration: 1200,
						start: function() {
							$( 'html, body' ).on( 'wheel touchmove', function() {
								$( 'html, body' ).stop().off( 'wheel touchmove' );
							} );
						},
						complete: function() {
							$( 'html, body' ).finish().off( 'wheel touchmove' );
						},
					} );
					return false;
				}
			}
		} );
	};

	$( window ).load( function() {
		$( '#site-navigation a[href*="#"]:not([href="#"]), .comments-link a[href*="#"]:not([href="#"]), .puro-scroll[href*="#"]:not([href="#"])' ).polestarSmoothScroll();
	} );

	// Adjust for sticky header when linking from external anchors.
	$( window ).load( function() {

		if ( location.pathname.replace( /^\//,'' ) == window.location.pathname.replace( /^\//,'' ) && location.hostname == window.location.hostname ) {
			var target = $( window.location.hash );
			if ( target.length ) {
				$( 'html, body' ).animate( {
					scrollTop: target.offset().top - headerHeight()
				}, 0 );
				return false;
			}
		}
	} );

	// Indicate which section of the page we're viewing with selected menu classes.
	function polestarSelected() {

		// Cursor position.
		var scrollTop = $( window ).scrollTop();

		// Used for checking if the cursor is in one section or not.
		var isInOneSection = 'no';

		// For all sections check if the cursor is inside a section.
		$( '.panel-row-style' ).each( function() {

			// Section ID.
			var thisID = '#' + $( this ).attr( 'id' );

			// Distance between top and our section. Minus 1px to compensate for an extra pixel produced when a Page Builder row bottom margin is set to 0.
			var offset = $( this ).offset().top - 1;

			// Section height.
			var thisHeight = $( this ).outerHeight();

			// Where the section begins.
			var thisBegin = offset - headerHeight();

			// Where the section ends.
			var thisEnd = offset + thisHeight - headerHeight();

			// If position of the cursor is inside of the this section.
			if ( scrollTop >= thisBegin && scrollTop <= thisEnd ) {
				isInOneSection = 'yes';
				$( '#site-navigation .current' ).removeClass( 'current' );
				// Find the menu button with the same ID section.
				$( '#site-navigation a[href$="' + thisID + '"]' ).parent( 'li' ).addClass( 'current' ); // Find the menu button with the same ID section.
				return false;
			}
			if ( isInOneSection === 'no' ) {
				$( '#site-navigation .current' ).removeClass( 'current' );
			}
		} );
	}

	$( window ).on( 'scroll', polestarSelected );

	// Mobile menu.
	var $mobileMenu = false;
	$( '#mobile-menu-button' ).click( function( e ) {
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

			if ( $( '.main-navigation .shopping-cart' ).length ) {
				$mobileMenu.append( $( '.main-navigation .shopping-cart .shopping-cart-link' ).clone() );
			}

			$mobileMenu.find( '#primary-menu' ).show().css( 'opacity', 1 );
			$mobileMenu.find( '.menu-item-has-children > a' ).addClass( 'has-dropdown' );
			$mobileMenu.find( '.page_item_has_children > a' ).addClass( 'has-dropdown' );
			$mobileMenu.find( '.has-dropdown' ).after( '<button class="dropdown-toggle" aria-expanded="false"><i class="icon-chevron-down" aria-hidden="true"></i></button>' );
			$mobileMenu.find( '.dropdown-toggle' ).click( function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-open' ).next( '.children, .sub-menu' ).slideToggle( 'fast' );
			} );

			$mobileMenu.find( '.has-dropdown' ).click( function( e ) {
				if ( typeof $( this ).attr( 'href' ) === "undefined" || $( this ).attr( 'href' ) == "#" ) {
					e.preventDefault();
					$( this ).siblings( '.dropdown-toggle' ).trigger( 'click' );
				}
			} );

			var mmOverflow = function() {
				if ( $( '#masthead' ).hasClass( 'sticky' ) ) {
					var adminBarHeight = $( '#wpadminbar' ).css( 'position' ) === 'fixed' ? $( '#wpadminbar' ).outerHeight() : 0;
					var mhHeight = $( '#masthead' ).innerHeight();
					var mobileMenuHeight = $( window ).height() - mhHeight - adminBarHeight;
					$( '#mobile-navigation' ).css( 'max-height', mobileMenuHeight );
				}
			}
			mmOverflow();

			$( window ).resize( mmOverflow );
			$( '#mobile-navigation' ).scroll( mmOverflow );

		}

		$mobileMenu.slideToggle( 'fast' );

		$( '#mobile-navigation a' ).click( function( e ) {
			if ( ! $( this ).hasClass( 'has-dropdown' ) || ( typeof $( this ).attr( 'href' ) !== "undefined" && $( this ).attr( 'href' )  !== "#" ) ) {
				if ( $mobileMenu.is(' :visible' ) ) {
					$mobileMenu.slideUp( 'fast' );
				}
			}
			$$.removeClass( 'to-close' );
		} );

		$( '#mobile-navigation a[href*="#"]:not([href="#"])' ).polestarSmoothScroll();

	} );

} );

( function( $ ) {
	$( window ).load( function() {

		polestar.logoScale = parseFloat( polestar.logoScale );

		// Header padding to be used if logo scaling is enabled.
		var $mh = $( '#masthead' ),
			mhPadding = {
				top: parseInt( $mh.css( 'padding-top' ) ),
				bottom: parseInt( $mh.css( 'padding-bottom' ) )
			};

		// Sticky header logo scaling.
		if ( $mh.data( 'scale-logo' ) ) {

			var $img = $mh.find( '.site-branding img' ),
				imgWidth = $img.width(),
				imgHeight = $img.height(),
				scaledWidth = imgWidth * polestar.logoScale;
				scaledHeight = imgHeight * polestar.logoScale;

			$( ".site-branding img" ).wrap( "<div class='custom-logo-wrapper'></div>");

			var smResizeLogo = function() {
				var $branding = $mh.find( '.site-branding > *' ),
					top = window.pageYOffset || document.documentElement.scrollTop;

				// Check if the menu is meant to be sticky or not, and if it is apply padding/class
				if ( top > 0 ) {
					$mh.css( {
						'padding-top': mhPadding.top * polestar.logoScale,
						'padding-bottom': mhPadding.bottom * polestar.logoScale
					} );

				} else {
					$mh.css( {
						'padding-top': mhPadding.top,
						'padding-bottom': mhPadding.bottom
					} );
				}

				if ( $img.length ) {
					// Are we at the top of the page?
					if ( top > 0 ) {
						// Calulate scale amount based on distance from the top of the page.
						var logoScale = polestar.logoScale + ( Math.max( 0, 48 - top ) / 48 * ( 1 - polestar.logoScale ) );
						if ( $img.height() != scaledHeight || $img.width() != scaledWidth || logoScale != polestar.logoScale ) {
							$( '.site-branding img' ).css( {
								width: logoScale * 100 + '%',
							} );
						}
					} else {
						// Ensure no scaling is present.
						$( '.site-branding img' ).css( {
							width: '',
						} );
					}

				} else if ( top > 0 ) {
					$branding.css( 'transform', 'scale(' + polestar.logoScale + ')' );

				} else {
					$branding.css( 'transform', 'scale(1)' );
				}
			};
			smResizeLogo();
			$( window ).scroll( smResizeLogo ).resize( smResizeLogo );
		}

		// Sticky header.
		if ( $( '#masthead' ).hasClass( 'sticky' ) ) {
			var $mh = $( '#masthead' ),
				$mhs = $( '<div class="masthead-sentinel"></div>' ).insertAfter( $mh ),
				$tb = $( '#topbar' ),
				$tbwc = $( '#topbar .woocommerce-store-notice[style*="display: none"]' );

			var smSetup = function() {

				if ( $( 'body' ).hasClass( 'mobile-header-ns' ) && ( $( window ).width() < polestar.collapse ) ) {
					return;
				}

				if ( $mhs !== false ) {
					$mhs.css( 'height', $mh.outerHeight() );
				}

				if ( ! $( 'body' ).hasClass( 'no-topbar' ) && ! $tb.polestarIsVisible() ) {
					$( 'body' ).addClass( 'topbar-out' );
				}

				if ( $tb.length && $( 'body' ).hasClass( 'topbar-out' ) && $tb.polestarIsVisible() ) {
					$( 'body' ).removeClass( 'topbar-out' );
				}

				if ( $( 'body' ).hasClass( 'no-topbar' ) && ! $( window ).scrollTop() ) {
					$( 'body' ).addClass( 'topbar-out' );
				}

				if ( $( 'body' ).hasClass( 'no-topbar' ) || ( ! $( 'body' ).hasClass( 'no-topbar' ) && $( 'body' ).hasClass( 'topbar-out' ) ) || $tbwc.length ) {
					$mh.css( 'position', 'fixed' );
				} else if ( ! $( 'body' ).hasClass( 'no-topbar' ) && ! $( 'body' ).hasClass( 'topbar-out' ) ) {
					$mh.css( 'position', 'absolute' );
				}

			};

			smSetup();
			$( window ).resize( smSetup ).scroll( smSetup );

			// Sticky header shadow.
			var smShadow = function() {
				if ( $( window ).scrollTop() > 0 ) {
					$( $mh ).addClass( 'stuck' );
				} else {
					$( $mh ).removeClass( 'stuck' );
				}
			};
			smShadow();
			$( window ).scroll( smShadow );

		}

	} );
} )( jQuery );
