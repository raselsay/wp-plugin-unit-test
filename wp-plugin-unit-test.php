<?php // phpcs:ignore WordPress.Files.FileName
/**
 * WP Plugin Unit Test
 *
 * @package Wp_Plugin_Unit_Test
 *
 * Plugin Name:       WP Plugin Unit Test
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       WordPress plugin unit testing basics.
 * Version:           1.0.0
 * Requires at least: 4.6
 * Requires PHP:      5.6
 * Author:            Sourov Roy
 * Author URI:        https://sourov.im/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Starting point of the plugin
 */
final class Wp_Plugin_Unit_Test {

	/**
	 * The single instance of the class.
	 *
	 * @var WPpluginUnitTest|null
	 */
	protected static $instance = null;

	/**
	 * Initializes the class WPpluginUnitTest()
	 *
	 * Checks for an existing WPpluginUnitTest() instance
	 * and if it doesn't find one, creates it.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor for the AppSero_Helper class
	 */
	private function __construct() {
		$this->require_files();

		$this->load_classes();
	}

	/**
	 * Include all files that need to run initially.
	 *
	 * @return void
	 */
	private function require_files() {
		require_once __DIR__ . '/includes/functions.php';
	}

	/**
	 * Require and initiate classes
	 *
	 * @return void
	 */
	private function load_classes() {
		// Post type class.
		require_once __DIR__ . '/includes/class-ut-post-type.php';

		new UT_Post_Type();

		// Ajax class.
		require_once __DIR__ . '/includes/class-ut-ajax.php';

		new UT_Ajax();

		// API class.
		require_once __DIR__ . '/includes/class-ut-api.php';

		new UT_API();
	}
}

// Run plugin functionality.
Wp_Plugin_Unit_Test::instance();
