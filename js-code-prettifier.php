<?php
/**
 * Plugin Name: JS Code Prettifier for WordPress
 * Description: More efficiently highlight code snippets on your WordPress blog.
 * GitHub Plugin URI: https://github.com/janboddez/js-code-prettifier
 * Author: Jan Boddez
 * Author URI: https://janboddez.be/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Version: 0.1.1
 *
 * @author Jan Boddez [jan@janboddez.be]
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/* Prevents this script from being loaded directly. */
defined( 'ABSPATH' ) or exit;

/**
 * Main plugin class.
 */
class JS_Code_Prettifier {
	/**
	 * Registers the necessary hooks.
	 *
	 * @since 0.1
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
	}

	/**
	 * On single posts and pages, loads Google's JS Code Prettifier script.
	 *
	 * @since 0.1
	 */
	public function load_scripts() {
		/* Load only for single posts and pages (and stop it from affecting tag archives). */
		if ( is_singular() ) {
			wp_enqueue_script( 'js-code-prettifier', plugin_dir_url( __FILE__ ) . 'assets/js/js-code-prettifier.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'code-prettify', 'https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js', array(), false, true );
		}
	}
}

new JS_Code_Prettifier();
