<?php
/**
 * TZCCP Color Variables Class
 *
 * @package Custom Color Palette
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * TZCCP Color Variables Class
 */
class TZCCP_Color_Variables {

	/**
	 * Setup the Color Variables class
	 *
	 * @return void
	 */
	static function setup() {

		// Add Custom Fonts CSS code to frontend.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_custom_colors_in_frontend' ), 11 );

		// Add Custom Fonts CSS code to editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'add_custom_colors_in_editor' ), 11 );
	}

	/**
	 * Add Font Family CSS styles in the head area of the theme.
	 */
	static function add_custom_colors_in_frontend() {
		wp_add_inline_style( 'themezee-custom-color-palette', self::get_custom_colors_css() );
	}

	/**
	 * Add Font Family CSS styles in the head area of the Gutenberg editor.
	 */
	static function add_custom_colors_in_editor() {
		wp_add_inline_style( 'themezee-custom-color-palette-editor', self::get_custom_colors_css() );
	}

	/**
	 * Generate Color CSS styles to override default colors.
	 *
	 * @return string CSS code
	 */
	static function get_custom_colors_css() {

		// Get plugin options from database.
		$plugin_options  = TZCCP_Customizer::get_options();
		$default_options = TZCCP_Customizer::get_default_options();

		// Color Variables.
		$color_variables = '';

		// Generate Color Variables.
		foreach ( TZCCP_Color_Palette::get_color_palette() as $color ) {
			$color_setting = $color['slug'] . '_color';

			if ( $plugin_options[ $color_setting ] !== $default_options[ $color_setting ] ) {
				$color_variables .= '--' . $color['class'] . '-color: ' . $plugin_options[ $color_setting ] . ';';
			}
		}

		// Return if no color variables were defined.
		if ( '' === $color_variables ) {
			return;
		}

		// Sanitize CSS Code.
		$custom_css .= ':root {' . $color_variables . '}';
		$custom_css  = wp_kses( $custom_css, array( '\'', '\"' ) );
		$custom_css  = str_replace( '&gt;', '>', $custom_css );
		$custom_css  = preg_replace( '/\n/', '', $custom_css );
		$custom_css  = preg_replace( '/\t/', '', $custom_css );

		return $custom_css;
	}
}

// Run TZCCP Color Variables Class.
TZCCP_Color_Variables::setup();
