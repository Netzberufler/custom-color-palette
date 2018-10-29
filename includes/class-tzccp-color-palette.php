<?php
/**
 * TZCCP Color Palette Class
 *
 * Adds a new tab on the themezee plugins page and displays the settings page.
 *
 * @package ThemeZee Custom Archive Titles
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * TZCCP Color Palette Class
 */
class TZCCP_Color_Palette {

	/**
	 * Setup the Color Palette class
	 *
	 * @return void
	 */
	static function setup() {

		// Add new color palette to Gutenberg.
		add_filter( 'block_editor_settings', array( __CLASS__, 'add_color_palette' ) );

	}

	/**
	 * Add color palette to editor settings.
	 *
	 * @return array $editor_settings
	 */
	static function add_color_palette( $editor_settings ) {
		$editor_settings['colors'] = self::get_color_palette();
		return $editor_settings;
	}

	/**
	 * Return Color Palette array.
	 *
	 * @return array $color_palette
	 */
	static function get_color_palette() {

		$color_palette = array(
			array(
				'name'  => esc_html__( 'Primary', 'custom-color-palette' ),
				'slug'  => 'ccp-primary',
				'color' => '#ee0000',
			),
			array(
				'name'  => esc_html__( 'Primary Light', 'custom-color-palette' ),
				'slug'  => 'ccp-primary-light',
				'color' => '#33ff33',
			),
		);

		return $color_palette;
	}
}

// Run TZCCP Color Palette Class.
TZCCP_Color_Palette::setup();
