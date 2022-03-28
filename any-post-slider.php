<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.itpathsolutions.com/
 * @since             1.0.0
 * @package           Any_Post_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       Any Post Slider
 * Plugin URI:        https://www.itpathsolutions.com/
 * Description:       Responsive Slider Solution for Any Posts Of WordPress.
 * Version:           1.0.0
 * Author:            IT Path Solutions PVT LTD
 * Author URI:        https://www.itpathsolutions.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       any-post-slider
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ANY_POST_SLIDER_VERSION', '1.0.0' );

/**
 *  define ANY_POST_SLIDER_PLUGIN_DIR constant for global use
 */
if (!defined('ANY_POST_SLIDER_PLUGIN_DIR'))
	define('ANY_POST_SLIDER_PLUGIN_DIR', dirname(__FILE__));

/**
 * define ANY_POST_SLIDER_PLUGIN_URL constant for global use
 */
if (!defined('ANY_POST_SLIDER_PLUGIN_URL'))
    define('ANY_POST_SLIDER_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 *  define ANY_POST_SLIDER_LOG_DIR log file path
 */
if (!defined('ANY_POST_SLIDER_LOG_DIR')) {
    define('ANY_POST_SLIDER_LOG_DIR', ABSPATH . 'wp-content/uploads/any-post-slider-logs/');
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-any-post-slider-activator.php
 */
function activate_any_post_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-any-post-slider-activator.php';
	Any_Post_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-any-post-slider-deactivator.php
 */
function deactivate_any_post_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-any-post-slider-deactivator.php';
	Any_Post_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_any_post_slider' );
register_deactivation_hook( __FILE__, 'deactivate_any_post_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-any-post-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_any_post_slider() {

	$plugin = new Any_Post_Slider();
	$plugin->run();

}
run_any_post_slider();
