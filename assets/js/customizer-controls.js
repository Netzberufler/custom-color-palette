/**
 * Customizer Controls JS
 *
 * Adds Javascript for Customizer Controls.
 *
 * @package Custom Color Palette
 */

// Based on https://make.xwp.co/2016/07/24/dependently-contextual-customizer-controls/
( function( wp, $ ) {

	// Primary Dark Color.
	wp.customize( 'tzccp_options[primary_dark]', function( setting ) {
		var showControl = function( control ) {
			setupControl( setting, control );
		}
		wp.customize.control( 'tzccp_options[primary_dark_color]', showControl );
	} );

	// Primary Color.
	wp.customize( 'tzccp_options[primary]', function( setting ) {
		var showControl = function( control ) {
			setupControl( setting, control );
		}
		wp.customize.control( 'tzccp_options[primary_color]', showControl );
	} );

	// Primary Light Color.
	wp.customize( 'tzccp_options[primary_light]', function( setting ) {
		var showControl = function( control ) {
			setupControl( setting, control );
		}
		wp.customize.control( 'tzccp_options[primary_light_color]', showControl );
	} );

	// Secondary Dark Color.
	wp.customize( 'tzccp_options[secondary_dark]', function( setting ) {
		var showControl = function( control ) {
			setupControl( setting, control );
		}
		wp.customize.control( 'tzccp_options[secondary_dark_color]', showControl );
	} );

	// Secondary Color.
	wp.customize( 'tzccp_options[secondary]', function( setting ) {
		var showControl = function( control ) {
			setupControl( setting, control );
		}
		wp.customize.control( 'tzccp_options[secondary_color]', showControl );
	} );

	// Secondary Light Color.
	wp.customize( 'tzccp_options[secondary_light]', function( setting ) {
		var showControl = function( control ) {
			setupControl( setting, control );
		}
		wp.customize.control( 'tzccp_options[secondary_light_color]', showControl );
	} );

	// Accent Color.
	wp.customize( 'tzccp_options[accent]', function( setting ) {
		var showControl = function( control ) {
			setupControl( setting, control );
		}
		wp.customize.control( 'tzccp_options[accent_color]', showControl );
	} );

	function setupControl( setting, control ) {
		var setActiveState, isDisplayed;
		isDisplayed = function() {
			return setting.get();
		};
		setActiveState = function() {
			control.active.set( isDisplayed() );
		};
		setActiveState();
		setting.bind( setActiveState );
		control.active.validate = isDisplayed;
	}

})( this.wp, jQuery );
