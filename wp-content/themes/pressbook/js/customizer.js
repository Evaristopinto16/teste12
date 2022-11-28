/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title > a' ).text( to );
		} );
	} );

	// Site tagline.
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-tagline' ).text( to );
		} );
	} );

	// Theme CSS output.
	var pressbook_css_output, pressbook_prop_value;

	$.each( pressbook.styles, function( key, rules ) {

		wp.customize( 'set_styles[' + key + ']', function( value ) {

			value.bind( function( to ) {
				if ( ! $( 'style#pressbook-styles-' + key ).length ) {
					$( '<style id="pressbook-styles-' + key + '"></style>' ).insertAfter( '#' + pressbook.handle_id );
				}

				pressbook_css_output = '';

				$.each( rules, function( selector, values ) {

					$.each( values, function( prop_key, prop_value ) {
						if ( prop_value.remove && prop_value.remove.length ) {
							$.each( prop_value.remove, function( remove_style_key, remove_style_id ) {
								$( 'style#pressbook-styles-' + remove_style_id ).remove();
							} );
						}

						if ( 'header_bg_position' === key ) {
							to = to.replaceAll( '-', ' ' );
						}

						pressbook_prop_value = prop_value.place.replaceAll( '_PLACE', to );

						if ( prop_value.extra && ! $.isEmptyObject( prop_value.extra ) ) {
							$.each( prop_value.extra, function( extra_place_key, extra_place ) {
								pressbook_prop_value = pressbook_prop_value.replaceAll( extra_place, wp.customize( 'set_styles[' + extra_place_key + ']' ).get() );
							} );
						}

						pressbook_css_output += ( selector + '{' );

						pressbook_css_output += ( prop_key + ':' + pressbook_prop_value + ';' );

						pressbook_css_output += '}';
					} );

				} );

				$( 'style#pressbook-styles-' + key ).html( pressbook_css_output );

			} );

		} );

	} );

}( jQuery ) );
