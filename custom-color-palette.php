<?php
/*
Plugin Name: Custom Color Palette
Plugin URI: https://themezee.com/plugins/custom-color-palette/
Description: A small and simple plugin to adjust the default color palette of the new WordPress Gutenberg Editor.
Author: ThemeZee
Author URI: https://themezee.com/
Version: 1.0
Text Domain: custom-color-palette
Domain Path: /languages/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Custom Color Palette
Copyright(C) 2018, ThemeZee.com

*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main ThemeZee_Custom_Color_Palette Class
 *
 * @package Custom Color Palette
 */
class ThemeZee_Custom_Color_Palette {
	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses ThemeZee_Custom_Color_Palette::constants() Setup the constants needed
	 * @uses ThemeZee_Custom_Color_Palette::includes() Include the required files
	 * @uses ThemeZee_Custom_Color_Palette::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {

		// Setup Constants.
		self::constants();

		// Setup Translation.
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );

		// Include Files.
		self::includes();

		// Setup Action Hooks.
		self::setup_actions();
	}

	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	static function constants() {

		// Define Plugin Name.
		define( 'TZCCP_NAME', 'Custom Color Palette' );

		// Define Version Number.
		define( 'TZCCP_VERSION', '1.0' );

		// Plugin Folder Path.
		define( 'TZCCP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL.
		define( 'TZCCP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File.
		define( 'TZCCP_PLUGIN_FILE', __FILE__ );
	}

	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {
		load_plugin_textdomain( 'custom-color-palette', false, dirname( plugin_basename( TZCCP_PLUGIN_FILE ) ) . '/languages/' );
	}

	/**
	 * Include required files
	 *
	 * @return void
	 */
	static function includes() {

		// Include Customizer settings.
		require_once TZCCP_PLUGIN_DIR . '/includes/customizer/class-tzccp-customizer.php';

		// Include Color Classes.
		require_once TZCCP_PLUGIN_DIR . '/includes/class-tzccp-color-palette.php';
		require_once TZCCP_PLUGIN_DIR . '/includes/class-tzccp-color-variables.php';
	}

	/**
	 * Setup Action Hooks
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_action WordPress Codex
	 * @return void
	 */
	static function setup_actions() {

		// Enqueue Plugin Stylesheet.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ) );

		// Enqueue Editor Stylesheet.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'enqueue_editor_styles' ) );

		// Add Settings link to Plugin actions.
		add_filter( 'plugin_action_links_' . plugin_basename( TZCCP_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );
	}

	/**
	 * Enqueue Color Palette Stylesheet
	 *
	 * @return void
	 */
	static function enqueue_styles() {
		wp_enqueue_style( 'themezee-custom-color-palette', TZCCP_PLUGIN_URL . 'assets/css/custom-color-palette.css', array(), TZCCP_VERSION );
	}

	/**
	 * Enqueue Color Palette styles in Editor.
	 *
	 * @return void
	 */
	static function enqueue_editor_styles() {
		wp_enqueue_style( 'themezee-custom-color-palette-editor', TZCCP_PLUGIN_URL . 'assets/css/custom-color-palette.css', array(), TZCCP_VERSION );
	}

	/**
	 * Add Customizer link to the plugin actions
	 *
	 * @return array $actions Plugin action links
	 */
	static function plugin_action_links( $actions ) {
		$settings_link = array( 'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'customize.php?autofocus[panel]=tzccp_options_panel' ), esc_html__( 'Settings', 'custom-color-palette' ) ) );
		return array_merge( $settings_link, $actions );
	}
}

// Run Plugin.
ThemeZee_Custom_Color_Palette::setup();
