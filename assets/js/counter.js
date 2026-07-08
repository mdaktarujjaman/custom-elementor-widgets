/* assets/js/counter.js
 * Vanilla JS count-up animation for the Counter widget.
 * No jQuery dependency. Animates once per element when it enters the viewport.
 */
(function () {
	'use strict';

	function formatNumber( value, useSeparator ) {
		var rounded = Math.round( value );
		return useSeparator ? rounded.toLocaleString( 'en-US' ) : String( rounded );
	}

	function animateCounter( el ) {
		if ( el.dataset.counted === '1' ) {
			return;
		}
		el.dataset.counted = '1';

		var start     = parseInt( el.dataset.start, 10 ) || 0;
		var end       = parseInt( el.dataset.end, 10 ) || 0;
		var duration  = parseInt( el.dataset.duration, 10 ) || 2000;
		var separator = el.dataset.separator === '1';
		var prefix    = el.dataset.prefix || '';
		var suffix    = el.dataset.suffix || '';

		var startTime = null;

		function step( timestamp ) {
			if ( ! startTime ) {
				startTime = timestamp;
			}
			var progress = Math.min( ( timestamp - startTime ) / duration, 1 );
			// easeOutQuad for a natural deceleration.
			var eased    = 1 - ( 1 - progress ) * ( 1 - progress );
			var current  = start + ( end - start ) * eased;

			el.textContent = prefix + formatNumber( current, separator ) + suffix;

			if ( progress < 1 ) {
				window.requestAnimationFrame( step );
			} else {
				el.textContent = prefix + formatNumber( end, separator ) + suffix;
			}
		}

		window.requestAnimationFrame( step );
	}

	function observeCounters( scope ) {
		var counters = scope.querySelectorAll( '.cew-counter__number' );

		if ( ! counters.length ) {
			return;
		}

		if ( ! ( 'IntersectionObserver' in window ) ) {
			// Fallback for very old browsers: animate immediately.
			counters.forEach( animateCounter );
			return;
		}

		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						animateCounter( entry.target );
						observer.unobserve( entry.target );
					}
				} );
			},
			{ threshold: 0.4 }
		);

		counters.forEach( function ( counter ) {
			observer.observe( counter );
		} );
	}

	// Elementor editor + frontend: initialize scoped to the widget instance.
	if ( window.elementorFrontend ) {
		window.elementorFrontend.hooks.addAction(
			'frontend/element_ready/itzone360_counter.default',
			function ( $scope ) {
				observeCounters( $scope[0] );
			}
		);
	} else {
		// Non-Elementor context fallback (e.g. shortcode reuse elsewhere).
		document.addEventListener( 'DOMContentLoaded', function () {
			observeCounters( document );
		} );
	}
})();