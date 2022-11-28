( function( $ ) {
	'use strict';

	// Select Multiple Control.
	wp.customize.controlConstructor['oceanly-select-multiple'] = wp.customize.Control.extend( {
		ready: function() {
			var control = this;

			$( 'select', control.container ).change(
				function() {
					var value = $( this ).val();

					if ( null === value ) {
						control.setting.set( '' );
					} else {
						control.setting.set( value );
					}
				}
			);
		}
	} );

} )( jQuery );
