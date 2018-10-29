<?php
/**
 * TZCCP Main Color Settings Class
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
 * TZCCP Main Color Settings Class
 */
class TZCCP_Main_Color_Settings {

	/**
	 * Setup the Main Color Settings class
	 *
	 * @return void
	 */
	static function setup() {

		// Register Main Color options.
		add_action( 'customize_register', array( __CLASS__, 'customize_register_options' ) );

	}

	/**
	 * Register main color settings in Customizer.
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function customize_register_options( $wp_customize ) {

		// Get Default Colors from settings.
		$default_options = TZCCP_Customizer::get_default_options();

		// Add Enable Colors Headline.
		$wp_customize->add_control( new TZCCP_Customize_Header_Control(
			$wp_customize, 'tzccp_options[enable_main_colors]', array(
				'label'    => esc_html__( 'Enable Colors', 'custom-color-palette' ),
				'section'  => 'tzccp_main_colors_section',
				'settings' => array(),
				'priority' => 5,
			)
		) );

		// Primary checkbox.
		$wp_customize->add_setting( 'tzccp_options[primary]', array(
			'default'           => true,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'TZCCP_Customizer', 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'tzccp_options[primary]', array(
			'label'    => esc_html__( 'Primary', 'custom-color-palette' ),
			'section'  => 'tzccp_main_colors_section',
			'settings' => 'tzccp_options[primary]',
			'type'     => 'checkbox',
			'priority' => 10,
		) );

		// Primary Light checkbox.
		$wp_customize->add_setting( 'tzccp_options[primary_light]', array(
			'default'           => true,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'TZCCP_Customizer', 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'tzccp_options[primary_light]', array(
			'label'    => esc_html__( 'Primary Light', 'custom-color-palette' ),
			'section'  => 'tzccp_main_colors_section',
			'settings' => 'tzccp_options[primary_light]',
			'type'     => 'checkbox',
			'priority' => 20,
		) );

		// Primary Color setting.
		$wp_customize->add_setting( 'tzccp_options[primary_color]', array(
			'default'           => $default_options['primary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'tzccp_options[primary_color]', array(
				'label'    => esc_html__( 'Primary', 'custom-color-palette' ),
				'section'  => 'tzccp_main_colors_section',
				'settings' => 'tzccp_options[primary_color]',
				'priority' => 110,
			)
		) );

		// Primary Light Color setting.
		$wp_customize->add_setting( 'tzccp_options[primary_light_color]', array(
			'default'           => $default_options['primary_light_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'tzccp_options[primary_light_color]', array(
				'label'    => esc_html__( 'Primary Light', 'custom-color-palette' ),
				'section'  => 'tzccp_main_colors_section',
				'settings' => 'tzccp_options[primary_light_color]',
				'priority' => 120,
			)
		) );
	}
}

// Run TZCCP Main Color Settings Class.
add_action( 'init', array( 'TZCCP_Main_Color_Settings', 'setup' ) );
