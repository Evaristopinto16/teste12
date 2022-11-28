// Namespace.
var oceanly = oceanly || {};

/**
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @param {Function} fn Callback function to run.
 */
function oceanlyDomReady( fn ) {
	if ( typeof fn !== 'function' ) {
		return;
	}

	if ( 'interactive' === document.readyState || 'complete' === document.readyState ) {
		return fn();
	}

	document.addEventListener( 'DOMContentLoaded', fn, false );
}

// Animation curves.
Math.easeInOutQuad = function ( t, b, c, d ) {
	t /= d / 2;
	if ( t < 1 ) return c / 2 * t * t + b;
	t--;
	return - c / 2 * ( t* ( t-2 ) - 1 ) + b;
};

// Setup main menu.
oceanly.setupMainMenu = {

	init: function() {
		const mainNavigation = document.getElementById( 'site-navigation' );
		if ( mainNavigation ) {

			const menu = mainNavigation.getElementsByTagName( 'ul' )[ 0 ]
			const toggle = mainNavigation.querySelector( '.menu-toggle' );

			// Hide menu toggle button if menu is empty and return early.
			if ( 'undefined' === typeof menu ) {
				if ( toggle ) {
					toggle.style.display = 'none';
				}

				return;
			}

			// Add class 'nav-menu' to the menu.
			menu.classList.add( 'nav-menu' );

			const arrows = mainNavigation.querySelectorAll( '.main-navigation-arrow-btn' );
			const links = mainNavigation.querySelectorAll( 'li > a' );
			const linksWithoutChildren = mainNavigation.querySelectorAll( 'li:not(.menu-item-has-children) > a' );
			const lastLinksWithoutChildren = mainNavigation.querySelectorAll( 'li:last-child:not(.menu-item-has-children) > a' );

			// Toggle navigation when the user clicks the menu toggle button.
			this.toggleNavigation( toggle, mainNavigation );

			// Add class if touch screen device.
			this.toggleTouchClass( mainNavigation );

			// Collapse menu when the user clicks outside the navigation.
			this.collapseIfClickOutside( toggle, mainNavigation );

			// Collapse menu when the user presses the escape key.
			this.collapseIfEscapeKeyPress( toggle, mainNavigation );

			// Collapse menu when the user resizes the window.
			this.collapseOnResize( toggle, mainNavigation );

			// Toggle sub-menu.
			this.toggleSubmenu( arrows, links, linksWithoutChildren, lastLinksWithoutChildren );

			// Trap focus in modal.
			this.trapFocusInModal( mainNavigation );
		}
	},

	toggleNavigation: function( button, nav ) {
		if ( ! button ) {
			return;
		}

		button.addEventListener( 'click', function( event ) {
			event.preventDefault();

			nav.classList.toggle( 'toggled' );

			if ( button ) {
				if ( 'true' === button.getAttribute( 'aria-expanded' ) ) {
					button.setAttribute( 'aria-expanded', 'false' );
				} else {
					button.setAttribute( 'aria-expanded', 'true' );
				}
			}
		} );
	},

	toggleTouchClass: function( nav ) {
		const touchClass = 'main-navigation--touch';
		if ( isTouchDevice() ) {
			nav.classList.add( touchClass );
		}

		window.addEventListener( 'resize', function() {
			if ( isTouchDevice() ) {
				nav.classList.add( touchClass );
			} else {
				nav.classList.remove( touchClass );
			}
		} );

		function isTouchDevice() {
			return ( ( 'ontouchstart' in window ) || ( navigator.maxTouchPoints > 0 ) || ( navigator.msMaxTouchPoints > 0 ) );
		}
	},

	collapseIfClickOutside: function( button, nav ) {
		document.addEventListener( 'click', function( event ) {
			const isClickInside = nav.contains( event.target );

			if ( ! isClickInside ) {
				nav.classList.remove( 'toggled' );

				if ( button ) {
					button.setAttribute( 'aria-expanded', 'false' );
				}

				// Remove all the focus classes in the ul.
				[].forEach.call( nav.querySelectorAll( '.focus' ), function( li ) {
					li.classList.remove( 'focus' );
				} );

				// Set aria-expanded to false.
				[].forEach.call( nav.querySelectorAll( '.main-navigation-arrow-btn' ), function( button ) {
					button.setAttribute( 'aria-expanded', 'false' );
				} );
			}
		} );
	},

	collapseIfEscapeKeyPress: function( button, nav ) {
		document.addEventListener( 'keyup', function( event ) {
			if ( 'Escape' === event.key ) {
				nav.classList.remove( 'toggled' );

				if ( button ) {
					button.setAttribute( 'aria-expanded', 'false' );
				}
			}
		} );
	},

	collapseOnResize: function( button, nav ) {
		window.addEventListener( 'resize', function() {
			if ( window.matchMedia( 'screen and (min-width: 576px)' ).matches ) {
				nav.classList.remove( 'toggled' );

				if ( button ) {
					button.setAttribute( 'aria-expanded', 'false' );
				}
			}
		} );
	},

	toggleSubmenu: function( arrows, links, linksWithoutChildren, lastLinksWithoutChildren ) {
		[].forEach.call( arrows, function( arrow ) {
			arrow.addEventListener( 'click', toggleFocus );
			arrow.addEventListener( 'keydown', toggleSubmenuWithArrow );
		} );

		[].forEach.call( links, function( link ) {
			link.addEventListener( 'focus', closeSubmenuWithLink );
		} );

		[].forEach.call( linksWithoutChildren, function( link ) {
			link.addEventListener( 'focus', openSubmenuWithLink );
		} );

		[].forEach.call( lastLinksWithoutChildren, function( link ) {
			link.addEventListener( 'keydown', closePreviousWithLink );
		} );

		function toggleFocus() {
			var self = this,
				addFocusEl = false; // Add focus class to this element.

			// Move up through the ancestors of the current arrow button until we hit ul.
			while ( 'ul' !== self.tagName.toLowerCase() ) {

				// If we hit the first li, then save it in addFocusEl if it does not contain the focus class.
				if ( 'li' === self.tagName.toLowerCase() && ! addFocusEl ) {
					if ( ! self.classList.contains( 'focus' ) ) {
						addFocusEl = self;
					}
				}

				self = self.parentElement;
			}

			// Remove all the focus classes in the ul.
			[].forEach.call( self.querySelectorAll( '.focus' ), function( li ) {
				li.classList.remove( 'focus' );
			} );

			// Set aria-expanded to false.
			[].forEach.call( self.querySelectorAll( '.main-navigation-arrow-btn' ), function( button ) {
				button.setAttribute( 'aria-expanded', 'false' );
			} );

			if ( addFocusEl ) {
				// Add focus class to addFocusEl.
				addFocusEl.classList.add( 'focus' );

				// Set aria-expanded to true.
				this.setAttribute( 'aria-expanded', 'true' );
			}
		}

		function toggleSubmenuWithArrow( event ) {
			const parentEl = this.parentElement,
				tabKey = ( 9 === event.keyCode ),
				shiftKey = event.shiftKey;

			if ( tabKey && shiftKey && parentEl.classList.contains( 'focus' ) ) {
				parentEl.classList.remove( 'focus' );
				this.setAttribute( 'aria-expanded', 'false' );
			} else if ( tabKey && ! shiftKey && ! parentEl.classList.contains( 'focus' ) ) {
				parentEl.classList.add( 'focus' );
				this.setAttribute( 'aria-expanded', 'true' );
			}
		}

		function closeSubmenuWithLink() {
			var self = this,
				previousClosed = false;

			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {

				// Close previous sub-menus before opening next.
				if ( ! previousClosed && ( 'ul' === self.tagName.toLowerCase() ) ) {
					// Remove all the focus classes in the ul.
					[].forEach.call( self.querySelectorAll( '.focus' ), function( li ) {
						li.classList.remove( 'focus' );
					} );

					// Set aria-expanded to false.
					[].forEach.call( self.querySelectorAll( '.main-navigation-arrow-btn' ), function( button ) {
						button.setAttribute( 'aria-expanded', 'false' );
					} );

					previousClosed = true;
				}

				self = self.parentElement;
			}
		}

		function openSubmenuWithLink() {
			var self = this,
				arrow;

			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {

				// On li elements add the class .focus and set aria-expanded to true.
				if ( 'li' === self.tagName.toLowerCase() && ! self.classList.contains( 'focus' ) ) {
					self.classList.add( 'focus' );

					arrow = self.querySelector( '.main-navigation-arrow-btn' );
					if ( arrow ) {
						this.setAttribute( 'aria-expanded', 'true' );
					}
				}

				self = self.parentElement;
			}
		}

		function closePreviousWithLink( event ) {
			var self = this,
				nextEl = false,
				tabKey = ( 9 === event.keyCode ),
				shiftKey = event.shiftKey;

			if ( tabKey && ! shiftKey ) {
				// Move up through the ancestors of the current link until there is sibling li.
				do {
					nextEl = ( function( element ) {
						do {
							element = element.nextSibling;
						} while ( element && ( 1 !== element.nodeType ) );

						return element;
					} ) ( self );

					self = self.parentElement;
				} while ( ! nextEl );

				// Remove all the focus classes in the li.
				[].forEach.call( self.querySelectorAll( '.focus' ), function( li ) {
					li.classList.remove( 'focus' );
				} );

				// Set aria-expanded to false.
				[].forEach.call( self.querySelectorAll( '.main-navigation-arrow-btn' ), function( button ) {
					button.setAttribute( 'aria-expanded', 'false' );
				} );
			}
		}
	},

	trapFocusInModal: function( nav ) {
		document.addEventListener( 'keydown', function( event ) {
			if ( ! nav.classList.contains( 'toggled' ) ) {
				return;
			}

			const elements = nav.querySelectorAll( 'input, a, button' );

			if ( elements.length < 1 ) {
				return;
			}

			const firstEl = elements[ 0 ],
				lastEl = elements[ elements.length - 1 ],
				activeEl = document.activeElement,
				tabKey = ( 9 === event.keyCode ),
				shiftKey = event.shiftKey;

			if ( tabKey && ! shiftKey && lastEl === activeEl ) {
				event.preventDefault();
				firstEl.focus();
			}

			if ( tabKey && shiftKey && firstEl === activeEl ) {
				event.preventDefault();
				lastEl.focus();
			}
		} );
	}

}; // oceanly.setupMainMenu

// Back to top.
oceanly.backToTop = {

	offset: 300,
	offsetOpacity: 1200,
	scrollDuration: 700,

	init: function() {
		const backToTop = document.querySelector( '.back-to-top' );
		if ( backToTop ) {
			this.handleScroll( backToTop );
			this.handleClick( backToTop );
		}
	},

	handleScroll: function( backToTop ) {
		var offset = this.offset,
			offsetOpacity = this.offsetOpacity,
			scrolling = false;

		window.addEventListener( 'scroll', function() {
			if ( ! scrolling ) {
				scrolling = true;
				if ( ! window.requestAnimationFrame ) {
					setTimeout( toggleOnChangeOffset, 250 );
				} else {
					window.requestAnimationFrame( toggleOnChangeOffset );
				}
			}
		} );

		function toggleOnChangeOffset() {
			var windowTop = window.scrollY || document.documentElement.scrollTop;

			if ( windowTop > offset ) {
				backToTop.classList.add( 'back-to-top--show' )
			} else {
				backToTop.classList.remove( 'back-to-top--show' );
				backToTop.classList.remove( 'back-to-top--fade-out' );
			}

			if ( windowTop > offsetOpacity ) {
				backToTop.classList.add( 'back-to-top--fade-out' );
			}

			scrolling = false;
		};
	},

	handleClick: function( backToTop ) {
		backToTop.addEventListener( 'click', function( event ) {
			event.preventDefault();

			if ( ! window.requestAnimationFrame ) {
				window.scrollTo( 0, 0 )
			} else {
				scrollTo( 0, this.scrollDuration );
			}

			backToTop.blur();
		}.bind( this ) );

		// Smooth scroll.
		function scrollTo( final, duration, cb ) {
			var start = window.scrollY || document.documentElement.scrollTop,
				currentTime = null;

				var animateScroll = function( timestamp ) {
				if ( ! currentTime ) {
					currentTime = timestamp;
				}

				var progress = timestamp - currentTime;

				if ( progress > duration ) {
					progress = duration;
				}

				var val = Math.easeInOutQuad( progress, start, final - start, duration );

				window.scrollTo( 0, val );
				if ( progress < duration ) {
					window.requestAnimationFrame( animateScroll );
				} else {
					cb && cb();
				}
			};

			window.requestAnimationFrame( animateScroll );
		};
	}

}; // oceanly.backToTop

oceanlyDomReady( function() {
	oceanly.setupMainMenu.init(); // Setup main menu.
	oceanly.backToTop.init(); // Setup back to top.
} );
