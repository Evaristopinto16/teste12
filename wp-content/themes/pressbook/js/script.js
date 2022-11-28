// Namespace.
var pressbook = pressbook || {};

/**
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @param {Function} fn Callback function to run.
 */
function pressbookDomReady( fn ) {
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
pressbook.setupMainMenu = {

	init: function() {
		const mainNav = document.getElementById( 'site-navigation' );
		if ( mainNav ) {

			const menu = mainNav.getElementsByTagName( 'ul' )[ 0 ]
			const toggle = mainNav.querySelector( '.primary-menu-toggle' );

			// Hide menu toggle button if menu is empty and return early.
			if ( 'undefined' === typeof menu ) {
				if ( toggle ) {
					toggle.style.display = 'none';
				}

				return;
			}

			// Add class 'nav-menu' to the menu.
			menu.classList.add( 'nav-menu' );

			const arrows = mainNav.querySelectorAll( '.main-navigation-arrow-btn' );
			const links = mainNav.querySelectorAll( 'li > a' );
			const linksWithoutChildren = mainNav.querySelectorAll( 'li:not(.menu-item-has-children) > a' );
			const lastLinksWithoutChildren = mainNav.querySelectorAll( 'li:last-child:not(.menu-item-has-children) > a' );
			const searchMenu = mainNav.querySelector( '.primary-menu-search' );
			const searchToggle = mainNav.querySelector( '.primary-menu-search-toggle' );

			// Add class if touch screen device.
			this.toggleTouchClass( mainNav );

			// Toggle navigation when the user clicks the menu toggle button.
			this.toggleNavigation( toggle, mainNav );

			// Collapse menu when the user clicks outside the navigation.
			this.collapseIfClickOutside( toggle, mainNav );

			// Collapse menu when the user presses the escape key.
			this.collapseIfEscapeKeyPress( toggle, mainNav );

			// Collapse menu when the user resizes the window.
			this.collapseOnResize( toggle, mainNav );

			// Toggle sub-menu.
			this.toggleSubmenu( arrows, links, linksWithoutChildren, lastLinksWithoutChildren );

			// Trap focus in modal.
			this.trapFocusInModal( mainNav );

			// Toggle search form.
			this.toggleSearch( searchToggle, searchMenu );

			// Trap focus in search.
			this.trapFocusInSearch( searchMenu );
		}
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

	collapseIfClickOutside: function( button, nav ) {
		const that = this;
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

				// Collapse search form.
				that.collapseSearchForm( nav );
			}
		} );
	},

	collapseIfEscapeKeyPress: function( button, nav ) {
		const that = this;
		document.addEventListener( 'keyup', function( event ) {
			if ( 'Escape' === event.key ) {
				nav.classList.remove( 'toggled' );

				if ( button ) {
					button.setAttribute( 'aria-expanded', 'false' );
				}

				// Collapse search form.
				that.collapseSearchForm( nav );
			}
		} );
	},

	collapseOnResize: function( button, nav ) {
		window.addEventListener( 'resize', function() {
			if ( window.matchMedia( 'screen and (min-width: 768px)' ).matches ) {
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
	},

	toggleSearch: function( toggle, search ) {
		if ( ! toggle || ! search ) {
			return;
		}

		toggle.addEventListener( 'click', function( event ) {
			event.preventDefault();

			search.classList.toggle( 'toggled' );

			if ( 'true' === toggle.getAttribute( 'aria-expanded' ) ) {
				toggle.setAttribute( 'aria-expanded', 'false' );
			} else {
				toggle.setAttribute( 'aria-expanded', 'true' );
			}
		} );
	},

	collapseSearchForm: function( nav ) {
		const search = nav.querySelector( '.primary-menu-search' );
		const toggle = nav.querySelector( '.primary-menu-search-toggle' );

		if ( search ) {
			search.classList.remove( 'toggled' );
		}

		if ( toggle ) {
			toggle.setAttribute( 'aria-expanded', 'false' );
		}
	},

	trapFocusInSearch: function( search ) {
		document.addEventListener( 'keydown', function( event ) {
			if ( ! search || ! search.classList.contains( 'toggled' ) ) {
				return;
			}

			const toggle = search.querySelector( '.primary-menu-search-toggle' );

			if ( 'none' === window.getComputedStyle( toggle, null ).display ) {
				return;
			}

			const elements = search.querySelectorAll( 'input, a, button' );

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
	},

}; // pressbook.setupMainMenu

// Go to top.
pressbook.goToTop = {

	offset: 300,
	offsetOpacity: 1200,
	scrollDuration: 700,

	init: function() {
		const goToTop = document.querySelector( '.go-to-top' );
		if ( goToTop ) {
			this.handleScroll( goToTop );
			this.handleClick( goToTop );
		}
	},

	handleScroll: function( goToTop ) {
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
				goToTop.classList.add( 'go-to-top--show' )
			} else {
				goToTop.classList.remove( 'go-to-top--show' );
				goToTop.classList.remove( 'go-to-top--fade-out' );
			}

			if ( windowTop > offsetOpacity ) {
				goToTop.classList.add( 'go-to-top--fade-out' );
			}

			scrolling = false;
		};
	},

	handleClick: function( goToTop ) {
		goToTop.addEventListener( 'click', function( event ) {
			event.preventDefault();

			if ( ! window.requestAnimationFrame ) {
				window.scrollTo( 0, 0 )
			} else {
				scrollTo( 0, this.scrollDuration );
			}

			goToTop.blur();
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

}; // pressbook.goToTop

pressbookDomReady( function() {
	pressbook.setupMainMenu.init(); // Setup main menu.
	pressbook.goToTop.init(); // Setup go to top.
} );
