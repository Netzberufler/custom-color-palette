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
		$plugin_options = TZCCP_Customizer::get_options();
		$color_palette  = array();

		if ( true === $plugin_options['primary_dark'] ) {
			$color_palette[] = array(
				'name'  => esc_html__( 'Primary Dark', 'custom-color-palette' ),
				'slug'  => 'ccp-primary-dark',
				'color' => esc_html( $plugin_options['primary_dark_color'] ),
			);
		}

		if ( true === $plugin_options['primary'] ) {
			$color_palette[] = array(
				'name'  => esc_html__( 'Primary', 'custom-color-palette' ),
				'slug'  => 'ccp-primary',
				'color' => esc_html( $plugin_options['primary_color'] ),
			);
		}

		if ( true === $plugin_options['primary_light'] ) {
			$color_palette[] = array(
				'name'  => esc_html__( 'Primary Light', 'custom-color-palette' ),
				'slug'  => 'ccp-primary-light',
				'color' => esc_html( $plugin_options['primary_light_color'] ),
			);
		}

		if ( true === $plugin_options['secondary_dark'] ) {
			$color_palette[] = array(
				'name'  => esc_html__( 'Secondary Dark', 'custom-color-palette' ),
				'slug'  => 'ccp-secondary-dark',
				'color' => esc_html( $plugin_options['secondary_dark_color'] ),
			);
		}

		if ( true === $plugin_options['secondary'] ) {
			$color_palette[] = array(
				'name'  => esc_html__( 'Secondary', 'custom-color-palette' ),
				'slug'  => 'ccp-secondary',
				'color' => esc_html( $plugin_options['secondary_color'] ),
			);
		}

		if ( true === $plugin_options['secondary_light'] ) {
			$color_palette[] = array(
				'name'  => esc_html__( 'Secondary Light', 'custom-color-palette' ),
				'slug'  => 'ccp-secondary-light',
				'color' => esc_html( $plugin_options['secondary_light_color'] ),
			);
		}

		if ( true === $plugin_options['accent'] ) {
			$color_palette[] = array(
				'name'  => esc_html__( 'Accent', 'custom-color-palette' ),
				'slug'  => 'ccp-accent',
				'color' => esc_html( $plugin_options['accent_color'] ),
			);
		}

		return $color_palette;
	}
}

// Run TZCCP Color Palette Class.
TZCCP_Color_Palette::setup();
