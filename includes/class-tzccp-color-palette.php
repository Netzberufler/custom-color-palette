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
		$plugin_options = TZCCP_Customizer::get_options();
		$color_palette  = array();

		foreach ( self::get_color_palette() as $color ) {
			if ( true === $plugin_options[ $color['slug'] ] ) {
				$color_palette[] = array(
					'name'  => $color['name'],
					'slug'  => $color['class'],
					'color' => esc_html( $plugin_options[ $color['slug'] . '_color' ] ),
				);
			}
		}

		$editor_settings['colors'] = $color_palette;

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
				'name'    => esc_html__( 'Primary Dark', 'custom-color-palette' ),
				'slug'    => 'primary_dark',
				'class'   => 'ccp-primary-dark',
				'section' => 'main_colors',
			),
			array(
				'name'    => esc_html__( 'Primary Color', 'custom-color-palette' ),
				'slug'    => 'primary',
				'class'   => 'ccp-primary',
				'section' => 'main_colors',
			),
			array(
				'name'    => esc_html__( 'Primary Light', 'custom-color-palette' ),
				'slug'    => 'primary_light',
				'class'   => 'ccp-primary-light',
				'section' => 'main_colors',
			),
			array(
				'name'    => esc_html__( 'Secondary Dark', 'custom-color-palette' ),
				'slug'    => 'secondary_dark',
				'class'   => 'ccp-secondary-dark',
				'section' => 'main_colors',
			),
			array(
				'name'    => esc_html__( 'Secondary Color', 'custom-color-palette' ),
				'slug'    => 'secondary',
				'class'   => 'ccp-secondary',
				'section' => 'main_colors',
			),
			array(
				'name'    => esc_html__( 'Secondary Light', 'custom-color-palette' ),
				'slug'    => 'secondary_light',
				'class'   => 'ccp-secondary-light',
				'section' => 'main_colors',
			),
			array(
				'name'    => esc_html__( 'Accent Color', 'custom-color-palette' ),
				'slug'    => 'accent',
				'class'   => 'ccp-accent',
				'section' => 'main_colors',
			),
		);

		return $color_palette;
	}
}

// Run TZCCP Color Palette Class.
TZCCP_Color_Palette::setup();
