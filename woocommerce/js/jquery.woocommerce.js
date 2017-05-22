/**
 * File jquery.woocommerce.js.
 *
 * Handles the WooCommerce JavaScript functions for the theme.
 */
jQuery( function( $ ) {

	// Product archive order drop-down.
	$('.woocommerce-ordering select').each( function() {
		var $$ = $( this );

		var c = $( '<div></div>' )
			.html( '<span class="current">' + $$.find( ':selected' ).html() + '</span>' + polestar_data.chevron_down )
			.addClass('ordering-selector-wrapper')
			.insertAfter( $$ );

		var dropdownContainer = $( '<div/>' )
			.addClass( 'ordering-dropdown-container' )
			.appendTo( c );

		var dropdown = $( '<ul></ul>' )
			.addClass( 'ordering-dropdown' )
			.appendTo( dropdownContainer );

		var widest = 0;
		$$.find( 'option' ).each( function() {
			var $o = $(this);
			dropdown.append(
				$( "<li></li>" )
					.html( $o.html() )
					.data( 'val', $o.attr( 'value' ) )
					.click( function() {
						$$.val( $( this ).data( 'val' ) );
						$$.closest( 'form' ).submit();
					} )
			);

			widest = Math.max( c.find( '.current' ).html( $o.html() ).width(), widest );

		} );

		c.find( '.current' ).html( $$.find( ':selected' ).html() ).width( widest );

		$$.hide();
	} );	

} );
