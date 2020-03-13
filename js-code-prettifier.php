<?php
/**
 * Plugin Name:       JS Code Prettifier for WordPress
 * Description:       Highlight code snippets on your WordPress blog.
 * GitHub Plugin URI: https://github.com/janboddez/js-code-prettifier
 * Author:            Jan Boddez
 * Author URI:        https://janboddez.tech/
 * License:           GNU General Public License v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Version:           0.2
 *
 * @author  Jan Boddez <jan@janboddez.be>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 * @package JS_Code_Prettyfier
 */

// Prevent this script from being loaded directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main plugin class.
 */
class JS_Code_Prettifier {
	/**
	 * This plugin's single instance.
	 *
	 * @var JS_Code_Prettifier $instance Plugin instance.
	 *
	 * @since 0.2
	 */
	private static $instance;

	/**
	 * Returns the single instance of this class.
	 *
	 * @return JS_Code_Prettifier Single class instance.
	 *
	 * @since 0.2
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Registers the necessary hooks.
	 *
	 * @since 0.1
	 */
	private function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
	}

	/**
	 * On single posts and pages, loads Google's JS Code Prettifier script.
	 *
	 * @since 0.1
	 */
	public function load_scripts() {
		// Load only for single posts and pages (and prevent the script from affecting tag archives).
		if ( is_singular() ) {
			wp_enqueue_script( 'js-code-prettifier', plugin_dir_url( __FILE__ ) . 'assets/js/js-code-prettifier.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'code-prettify', 'https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js', array(), false, true );
		}
	}
}

JS_Code_Prettifier::get_instance();
