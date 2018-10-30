/**
 * Customizer Live Preview
 *
 * Reloads changes on Customizer Preview asynchronously for better usability
 *
 * @package Custom Color Palette
 */

( function( $ ) {

	var colors = [ 
		'primary_dark', 'primary', 'primary_light', 'secondary_dark', 'secondary', 'secondary_light', 'accent',
		'red', 'green', 'blue', 'yellow', 'orange', 'purple', 'brown', 'pink',
		'white', 'light_gray', 'dark_gray', 'black',
	];

	// Change Color CSS variable for each color control in the live preview of the Customizer.
	jQuery.each( colors, function( index, color ) {
		// Preview Color.
		wp.customize( 'tzccp_options[' + color + '_color]', function( value ) {
			value.bind( function( newval ) {
				document.documentElement.style.setProperty( '--ccp-' + color.replace( '_', '-' ) + '-color', newval );
			} );
		} );
	});

} )( jQuery );
