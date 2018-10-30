<?php
/**
 * TZCCP Color Palette Class
 *
 * @package Custom Color Palette
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

		// Loop through colors and add them to color palette if enabled in Customizer.
		foreach ( self::get_color_palette() as $color ) {
			if ( true === $plugin_options[ $color['slug'] ] ) {
				$color_palette[] = array(
					'name'  => $color['name'],
					'slug'  => $color['class'],
					'color' => esc_html( $plugin_options[ $color['slug'] . '_color' ] ),
				);
			}
		}

		// Add color palette to editor settings.
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
			array(
				'name'    => esc_html__( 'White', 'custom-color-palette' ),
				'slug'    => 'white',
				'class'   => 'ccp-white',
				'section' => 'grayscale_colors',
			),
			array(
				'name'    => esc_html__( 'Light Gray', 'custom-color-palette' ),
				'slug'    => 'light_gray',
				'class'   => 'ccp-light-gray',
				'section' => 'grayscale_colors',
			),
			array(
				'name'    => esc_html__( 'Dark Gray', 'custom-color-palette' ),
				'slug'    => 'dark_gray',
				'class'   => 'ccp-dark-gray',
				'section' => 'grayscale_colors',
			),
			array(
				'name'    => esc_html__( 'Black', 'custom-color-palette' ),
				'slug'    => 'black',
				'class'   => 'ccp-black',
				'section' => 'grayscale_colors',
			),
			array(
				'name'    => esc_html__( 'Red', 'custom-color-palette' ),
				'slug'    => 'red',
				'class'   => 'ccp-red',
				'section' => 'primary_colors',
			),
			array(
				'name'    => esc_html__( 'Green', 'custom-color-palette' ),
				'slug'    => 'green',
				'class'   => 'ccp-green',
				'section' => 'primary_colors',
			),
			array(
				'name'    => esc_html__( 'Blue', 'custom-color-palette' ),
				'slug'    => 'blue',
				'class'   => 'ccp-blue',
				'section' => 'primary_colors',
			),
			array(
				'name'    => esc_html__( 'Yellow', 'custom-color-palette' ),
				'slug'    => 'yellow',
				'class'   => 'ccp-yellow',
				'section' => 'primary_colors',
			),
			array(
				'name'    => esc_html__( 'Orange', 'custom-color-palette' ),
				'slug'    => 'orange',
				'class'   => 'ccp-orange',
				'section' => 'primary_colors',
			),
			array(
				'name'    => esc_html__( 'Purple', 'custom-color-palette' ),
				'slug'    => 'purple',
				'class'   => 'ccp-purple',
				'section' => 'primary_colors',
			),
			array(
				'name'    => esc_html__( 'Brown', 'custom-color-palette' ),
				'slug'    => 'brown',
				'class'   => 'ccp-brown',
				'section' => 'primary_colors',
			),
			array(
				'name'    => esc_html__( 'Pink', 'custom-color-palette' ),
				'slug'    => 'pink',
				'class'   => 'ccp-pink',
				'section' => 'primary_colors',
			),
		);

		return $color_palette;
	}
}

// Run TZCCP Color Palette Class.
TZCCP_Color_Palette::setup();
