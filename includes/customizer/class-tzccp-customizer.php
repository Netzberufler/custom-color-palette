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
		require_once TZCCP_PLUGIN_DIR . '/includes/customizer/class-tzccp-customize-header-control.php';

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
	 * @return array $default_options
	 */
	static function get_default_options() {

		$default_options = array(
			'primary_dark'          => true,
			'primary'               => true,
			'primary_light'         => true,
			'secondary_dark'        => false,
			'secondary'             => false,
			'secondary_light'       => false,
			'accent'                => true,
			'white'                 => true,
			'light_gray'            => true,
			'dark_gray'             => true,
			'black'                 => true,
			'red'                   => true,
			'green'                 => true,
			'blue'                  => true,
			'yellow'                => false,
			'orange'                => false,
			'purple'                => false,
			'brown'                 => false,
			'pink'                  => false,
			'primary_dark_color'    => '#b7400d',
			'primary_color'         => '#dd6633',
			'primary_light_color'   => '#ff8c59',
			'secondary_dark_color'  => '#730db7',
			'secondary_color'       => '#9933dd',
			'secondary_light_color' => '#bf59ff',
			'accent_color'          => '#33bbdd',
			'white_color'           => '#ffffff',
			'light_gray_color'      => '#eeeeee',
			'dark_gray_color'       => '#666666',
			'black_color'           => '#151515',
			'red_color'             => '#dd3333',
			'green_color'           => '#81d742',
			'blue_color'            => '#1e73be',
			'yellow_color'          => '#eeee22',
			'orange_color'          => '#dd9933',
			'purple_color'          => '#8224e3',
			'brown_color'           => '#825b00',
			'pink_color'            => '#e500e5',
		);

		return $default_options;
	}

	/**
	 * Register plugin settings in Customizer.
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function customize_register_options( $wp_customize ) {
		// Get Default Colors from settings.
		$default_options = TZCCP_Customizer::get_default_options();

		// Add Color Palette Panel.
		$wp_customize->add_panel( 'tzccp_options_panel', array(
			'priority'   => 500,
			'capability' => 'edit_theme_options',
			'title'      => esc_html__( 'Custom Color Palette', 'custom-color-palette' ),
		) );

		// Add Color Palette Sections.
		$wp_customize->add_section( 'tzccp_main_colors_section', array(
			'title'    => esc_html__( 'Main Colors', 'custom-color-palette' ),
			'priority' => 10,
			'panel'    => 'tzccp_options_panel',
		) );

		$wp_customize->add_section( 'tzccp_grayscale_colors_section', array(
			'title'    => esc_html__( 'Grayscale Colors', 'custom-color-palette' ),
			'priority' => 20,
			'panel'    => 'tzccp_options_panel',
		) );

		$wp_customize->add_section( 'tzccp_primary_colors_section', array(
			'title'    => esc_html__( 'Primary Colors', 'custom-color-palette' ),
			'priority' => 30,
			'panel'    => 'tzccp_options_panel',
		) );

		// Add Enable Colors Headlines.
		$wp_customize->add_control( new TZCCP_Customize_Header_Control(
			$wp_customize, 'tzccp_options[enable_main_colors]', array(
				'label'    => esc_html__( 'Enable Colors', 'custom-color-palette' ),
				'section'  => 'tzccp_main_colors_section',
				'settings' => array(),
				'priority' => 5,
			)
		) );

		$wp_customize->add_control( new TZCCP_Customize_Header_Control(
			$wp_customize, 'tzccp_options[enable_grayscale_colors]', array(
				'label'    => esc_html__( 'Enable Colors', 'custom-color-palette' ),
				'section'  => 'tzccp_grayscale_colors_section',
				'settings' => array(),
				'priority' => 5,
			)
		) );

		$wp_customize->add_control( new TZCCP_Customize_Header_Control(
			$wp_customize, 'tzccp_options[enable_primary_colors]', array(
				'label'    => esc_html__( 'Enable Colors', 'custom-color-palette' ),
				'section'  => 'tzccp_primary_colors_section',
				'settings' => array(),
				'priority' => 5,
			)
		) );

		// Generate Color Settings.
		$priority = 0;
		foreach ( TZCCP_Color_Palette::get_color_palette() as $color ) {

			// Variables.
			$checkbox_setting = $color['slug'];
			$color_setting    = $color['slug'] . '_color';

			// Controls.
			$checkbox_control = 'tzccp_options[' . $checkbox_setting . ']';
			$color_control    = 'tzccp_options[' . $color_setting . ']';
			$section          = 'tzccp_' . $color['section'] . '_section';
			$priority        += 10;

			// Checkbox setting.
			$wp_customize->add_setting( $checkbox_control, array(
				'default'           => $default_options[ $checkbox_setting ],
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => array( 'TZCCP_Customizer', 'sanitize_checkbox' ),
			) );

			$wp_customize->add_control( $checkbox_control, array(
				'label'    => $color['name'],
				'section'  => $section,
				'settings' => $checkbox_control,
				'type'     => 'checkbox',
				'priority' => $priority,
			) );

			// Color setting.
			$wp_customize->add_setting( $color_control, array(
				'default'           => $default_options[ $color_setting ],
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
				$color_control, array(
					'label'    => $color['name'],
					'section'  => $section,
					'settings' => $color_control,
					'priority' => $priority + 100,
				)
			) );
		}

		// Adjust Checkbox order.
		$wp_customize->get_control( 'tzccp_options[secondary_dark]' )->priority  = 15;
		$wp_customize->get_control( 'tzccp_options[secondary]' )->priority       = 25;
		$wp_customize->get_control( 'tzccp_options[secondary_light]' )->priority = 35;
		$wp_customize->get_control( 'tzccp_options[black]' )->priority           = 95;
		$wp_customize->get_control( 'tzccp_options[orange]' )->priority          = 125;
		$wp_customize->get_control( 'tzccp_options[purple]' )->priority          = 135;
		$wp_customize->get_control( 'tzccp_options[brown]' )->priority           = 145;
		$wp_customize->get_control( 'tzccp_options[pink]' )->priority            = 155;
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
