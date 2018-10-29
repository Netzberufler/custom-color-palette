/**
 * Customizer Live Preview
 *
 * Reloads changes on Customizer Preview asynchronously for better usability
 *
 * @package Custom Color Palette
 */

( function( $ ) {

	// Primary Dark Color.
	wp.customize( 'tzccp_options[primary_dark_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--ccp-primary-dark-color', newval );
		} );
	} );

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

	// Secondary Dark Color.
	wp.customize( 'tzccp_options[secondary_dark_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--ccp-secondary-dark-color', newval );
		} );
	} );

	// Secondary Color.
	wp.customize( 'tzccp_options[secondary_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--ccp-secondary-color', newval );
		} );
	} );

	// Secondary Light Color.
	wp.customize( 'tzccp_options[secondary_light_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--ccp-secondary-light-color', newval );
		} );
	} );

	// Accent Color.
	wp.customize( 'tzccp_options[accent_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--ccp-accent-color', newval );
		} );
	} );

} )( jQuery );
