( function() {
	'use strict';

	if ( ( typeof Macy !== 'undefined' ) && ( typeof pressbookMasonry !== 'undefined' ) ) {
		const element = '.pb-grid-post-row';
		const grid = document.querySelector( element );
		if ( grid ) {
			var macy = Macy( {
				container: element,
				trueOrder: false,
				waitForImages: false,
				margin: Math.abs( pressbookMasonry.margin ),
				columns: Math.abs( pressbookMasonry.cols_2xl ),
				breakAt: {
					1280: Math.abs( pressbookMasonry.cols_xl ),
					1024: Math.abs( pressbookMasonry.cols_lg ),
					768: Math.abs( pressbookMasonry.cols_md ),
					575: Math.abs( pressbookMasonry.cols_sm ),
					349: Math.abs( pressbookMasonry.cols_xs )
				}
			} );

			macy.runOnImageLoad( function () {
				macy.recalculate( true );
			}, true );

			if ( typeof jQuery !== 'undefined' ) {
				jQuery( document.body ).on( 'post-load', function () {
					const html = jQuery( '.infinite-wrap:last .pb-grid-post-row' ).html();
					jQuery( '.infinite-wrap:last' ).hide();
					jQuery( '.pb-grid-post-row' ).append( html );
					macy.recalculate( true );
				} );
			}
		}
	}

} )();
