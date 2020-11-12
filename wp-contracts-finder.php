<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://twitter.com/Inu3219
 * @since             1.0.0
 * @package           Wp_Contracts_Finder
 *
 * @wordpress-plugin
 * Plugin Name:       WP Contracts Finder
 * Plugin URI:        https://github.com/Inayat-C/WP-Contracts-Finder
 * Description:       Creates a post for each contract pulled in from the Contracts Finder API.
 * Version:           1.0.0
 * Author:            Inayat Cassambai
 * Author URI:        https://twitter.com/Inu3219
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-contracts-finder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'WP_CONTRACTS_FINDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-contracts-finder-activator.php
 */
function activate_wp_contracts_finder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-contracts-finder-activator.php';
	Wp_Contracts_Finder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-contracts-finder-deactivator.php
 */
function deactivate_wp_contracts_finder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-contracts-finder-deactivator.php';
	Wp_Contracts_Finder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_contracts_finder' );
register_deactivation_hook( __FILE__, 'deactivate_wp_contracts_finder' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-contracts-finder.php';

/**
 * Helper function to easily print errors to the debug log. 
 * 
 * @since    1.0.0
 */
if (!function_exists('write_log')) {
    function write_log($log) {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_contracts_finder() {

	$plugin = new Wp_Contracts_Finder();
	$plugin->run();

}
run_wp_contracts_finder();
