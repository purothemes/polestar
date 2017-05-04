/**
 * File polestar-premium.js.
 *
 * Upsell notice.
 */
( function( $ ) {

	// Add upgrade message.
	if ( 'undefined' !== typeof polestar10n ) {
		upsell = $( '<a class="polestar-premium-link"></a>' )
			.attr( 'href', polestar10n.polestarURL )
			.attr( 'target', '_blank' )
			.text( polestar10n.polestarLabel )
			.css({
				'display' : 'inline-block',
				'background-color' : '#4d8ffb',
				'color' : '#fff',
				'text-decoration' : 'none',
				'text-transform' : 'uppercase',
				'margin-top' : '6px',
				'padding' : '4px 6px',
				'font-size': '10px',
				'letter-spacing': '1px',
				'line-height': '1.5',
				'clear' : 'both'
			})
		;

		setTimeout(function () {
			$( '#accordion-section-themes h3' ).append( upsell );
		}, 200);

		// Remove accordion click event.
		$( '.polestar-premium-link' ).on( 'click', function( e ) {
			e.stopPropagation();
		});
	}

} )( jQuery );
