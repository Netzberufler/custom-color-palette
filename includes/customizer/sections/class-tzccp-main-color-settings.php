<?php
/**
 * TZCCP Main Color Settings Class
 *
 * @package Custom Color Palette
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

		// Primary Dark checkbox.
		$wp_customize->add_setting( 'tzccp_options[primary_dark]', array(
			'default'           => true,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'TZCCP_Customizer', 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'tzccp_options[primary_dark]', array(
			'label'    => esc_html__( 'Primary Dark', 'custom-color-palette' ),
			'section'  => 'tzccp_main_colors_section',
			'settings' => 'tzccp_options[primary_dark]',
			'type'     => 'checkbox',
			'priority' => 10,
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
			'priority' => 20,
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
			'priority' => 30,
		) );

		// Secondary Dark checkbox.
		$wp_customize->add_setting( 'tzccp_options[secondary_dark]', array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'TZCCP_Customizer', 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'tzccp_options[secondary_dark]', array(
			'label'    => esc_html__( 'Secondary Dark', 'custom-color-palette' ),
			'section'  => 'tzccp_main_colors_section',
			'settings' => 'tzccp_options[secondary_dark]',
			'type'     => 'checkbox',
			'priority' => 40,
		) );

		// Secondary checkbox.
		$wp_customize->add_setting( 'tzccp_options[secondary]', array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'TZCCP_Customizer', 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'tzccp_options[secondary]', array(
			'label'    => esc_html__( 'Secondary', 'custom-color-palette' ),
			'section'  => 'tzccp_main_colors_section',
			'settings' => 'tzccp_options[secondary]',
			'type'     => 'checkbox',
			'priority' => 50,
		) );

		// Secondary Light checkbox.
		$wp_customize->add_setting( 'tzccp_options[secondary_light]', array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'TZCCP_Customizer', 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'tzccp_options[secondary_light]', array(
			'label'    => esc_html__( 'Secondary Light', 'custom-color-palette' ),
			'section'  => 'tzccp_main_colors_section',
			'settings' => 'tzccp_options[secondary_light]',
			'type'     => 'checkbox',
			'priority' => 60,
		) );

		// Accent checkbox.
		$wp_customize->add_setting( 'tzccp_options[accent]', array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'TZCCP_Customizer', 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'tzccp_options[accent]', array(
			'label'    => esc_html__( 'Accent', 'custom-color-palette' ),
			'section'  => 'tzccp_main_colors_section',
			'settings' => 'tzccp_options[accent]',
			'type'     => 'checkbox',
			'priority' => 70,
		) );

		// Primary Dark Color setting.
		$wp_customize->add_setting( 'tzccp_options[primary_dark_color]', array(
			'default'           => $default_options['primary_dark_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'tzccp_options[primary_dark_color]', array(
				'label'    => esc_html__( 'Primary Dark', 'custom-color-palette' ),
				'section'  => 'tzccp_main_colors_section',
				'settings' => 'tzccp_options[primary_dark_color]',
				'priority' => 110,
			)
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
				'priority' => 120,
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
				'priority' => 130,
			)
		) );

		// Secondary Dark Color setting.
		$wp_customize->add_setting( 'tzccp_options[secondary_dark_color]', array(
			'default'           => $default_options['secondary_dark_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'tzccp_options[secondary_dark_color]', array(
				'label'    => esc_html__( 'Secondary Dark', 'custom-color-palette' ),
				'section'  => 'tzccp_main_colors_section',
				'settings' => 'tzccp_options[secondary_dark_color]',
				'priority' => 140,
			)
		) );

		// Secondary Color setting.
		$wp_customize->add_setting( 'tzccp_options[secondary_color]', array(
			'default'           => $default_options['secondary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'tzccp_options[secondary_color]', array(
				'label'    => esc_html__( 'Secondary', 'custom-color-palette' ),
				'section'  => 'tzccp_main_colors_section',
				'settings' => 'tzccp_options[secondary_color]',
				'priority' => 150,
			)
		) );

		// Secondary Light Color setting.
		$wp_customize->add_setting( 'tzccp_options[secondary_light_color]', array(
			'default'           => $default_options['secondary_light_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'tzccp_options[secondary_light_color]', array(
				'label'    => esc_html__( 'Secondary Light', 'custom-color-palette' ),
				'section'  => 'tzccp_main_colors_section',
				'settings' => 'tzccp_options[secondary_light_color]',
				'priority' => 160,
			)
		) );

		// Accent Color setting.
		$wp_customize->add_setting( 'tzccp_options[accent_color]', array(
			'default'           => $default_options['accent_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'tzccp_options[accent_color]', array(
				'label'    => esc_html__( 'Accent', 'custom-color-palette' ),
				'section'  => 'tzccp_main_colors_section',
				'settings' => 'tzccp_options[accent_color]',
				'priority' => 170,
			)
		) );
	}
}

// Run TZCCP Main Color Settings Class.
add_action( 'init', array( 'TZCCP_Main_Color_Settings', 'setup' ) );
