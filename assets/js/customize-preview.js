/**
 * Customizer Live Preview
 *
 * Reloads changes on Customizer Preview asynchronously for better usability
 *
 * @package Custom Color Palette
 */

( function( $ ) {

	// Primary Color.
	wp.customize( 'tzccp_options[primary_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--ccp-primary-color', newval );
		} );
	} );

	// Primary Light Color.
	wp.customize( 'tzccp_options[primary_light_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--ccp-primary-light-color', newval );
		} );
	} );

} )( jQuery );
