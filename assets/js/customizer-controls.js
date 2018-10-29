/**
 * Customizer Controls JS
 *
 * Adds Javascript for Customizer Controls.
 *
 * @package Custom Color Palette
 */

// Based on https://make.xwp.co/2016/07/24/dependently-contextual-customizer-controls/
( function( wp, $ ) {

	var colors = [ 
		'primary_dark', 'primary', 'primary_light', 'secondary_dark', 'secondary', 'secondary_light', 'accent',
		'red', 'green', 'blue', 'yellow', 'orange', 'purple', 'brown', 'pink',
	];

	jQuery.each( colors, function( index, color ) {
		// Show Color Control.
		wp.customize( 'tzccp_options[' + color + ']', function( setting ) {
			var showControl = function( control ) {
				setupControl( setting, control );
			}
			wp.customize.control( 'tzccp_options[' + color + '_color]', showControl );
		} );
	});

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
