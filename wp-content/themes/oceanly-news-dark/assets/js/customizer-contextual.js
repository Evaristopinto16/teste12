wp.customize.bind( 'ready', function() {

	// Contextual: Featured Posts Source.
	wp.customize( ( 'set_featured_posts[source]' ), function( value ) {
		var setupControl = function( source ) {

			return function( control ) {
				var setActiveState, isDisplayed;

				isDisplayed = function() {
					return ( source === value.get() );
				};

				setActiveState = function() {
					control.active.set( isDisplayed() );
				};

				control.active.validate = isDisplayed;
				setActiveState();
				value.bind( setActiveState );
			};

		};

		wp.customize.control( ( 'set_featured_posts[categories]' ), setupControl( 'categories' ) );
		wp.customize.control( ( 'set_featured_posts[tags]' ), setupControl( 'tags' ) );
	} );

} );
