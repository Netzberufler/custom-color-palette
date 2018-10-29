<?php
/**
 * TZCCP Customizer Class
 *
 * @package Custom Color Palette
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * TZCCP Customizer Class
 */
class TZCCP_Customizer {

	/**
	 * Setup the Customizer class
	 *
	 * @return void
	 */
	static function setup() {

		// Include Headline Control.
		require_once TZCCP_PLUGIN_DIR . '/includes/customizer/controls/class-tzccp-customize-header-control.php';

		// Register Customizer options.
		add_action( 'customize_register', array( __CLASS__, 'customize_register_options' ) );

		// Enqueue Customizer Preview JS.
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );

		// Enqueue Customizer Controls JS.
		add_action( 'customize_controls_enqueue_scripts', array( __CLASS__, 'customizer_controls_js' ) );

		// Enqueue Customizer Controls CSS.
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customizer_controls_css' ) );
	}

	/**
	 * Get saved user settings from database or plugin defaults.
	 *
	 * @return array $plugin_options
	 */
	static function get_options() {

		// Merge plugin options array from database with default options array.
		$plugin_options = wp_parse_args( get_option( 'tzccp_options', array() ), self::get_default_options() );

		// Return theme options.
		return $plugin_options;
	}

	/**
	 * Returns the default settings.
	 *
	 * @return array
	 */
	static function get_default_options() {

		$default_options = array(
			'primary'             => true,
			'primary_light'       => true,
			'primary_color'       => '#ee0000',
			'primary_light_color' => '#33ff33',
		);

		return $default_options;
	}

	/**
	 * Register plugin settings in Customizer.
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function customize_register_options( $wp_customize ) {

		// Add Editor Colors Panel.
		$wp_customize->add_panel( 'tzccp_options_panel', array(
			'priority'   => 80,
			'capability' => 'edit_theme_options',
			'title'      => esc_html__( 'Custom Color Palette', 'custom-color-palette' ),
		) );

		// Add Color Sections.
		$wp_customize->add_section( 'tzccp_main_colors_section', array(
			'title'    => esc_html__( 'Main Colors', 'custom-color-palette' ),
			'priority' => 10,
			'panel'    => 'tzccp_options_panel',
		) );

		$wp_customize->add_section( 'tzccp_primary_colors_section', array(
			'title'    => esc_html__( 'Primary Colors', 'custom-color-palette' ),
			'priority' => 20,
			'panel'    => 'tzccp_options_panel',
		) );

		$wp_customize->add_section( 'tzccp_grayscale_colors_section', array(
			'title'    => esc_html__( 'Grayscale Colors', 'custom-color-palette' ),
			'priority' => 30,
			'panel'    => 'tzccp_options_panel',
		) );
	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 */
	static function customize_preview_js() {
		wp_enqueue_script( 'tzccp-customize-preview', TZCCP_PLUGIN_URL . 'assets/js/customize-preview.js', array( 'customize-preview' ), TZCCP_VERSION, true );
	}

	/**
	 * Embed JS for Customizer Controls.
	 */
	static function customizer_controls_js() {
		wp_enqueue_script( 'tzccp-customizer-controls', TZCCP_PLUGIN_URL . 'assets/js/customizer-controls.js', array(), TZCCP_VERSION, true );
	}

	/**
	 * Embed CSS styles Customizer Controls.
	 */
	static function customizer_controls_css() {
		wp_enqueue_style( 'tzccp-customizer-controls', TZCCP_PLUGIN_URL . 'assets/css/customizer-controls.css', array(), TZCCP_VERSION );
	}

	/**
	 * Checkbox sanitization callback
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	static function sanitize_checkbox( $checked ) {

		// Boolean check.
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}
}

// Run TZCCP Customizer Class.
add_action( 'init', array( 'TZCCP_Customizer', 'setup' ) );
