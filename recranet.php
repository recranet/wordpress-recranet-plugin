<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://recranet.com/
 * @since             1.0.0
 * @package           Recranet
 *
 * @wordpress-plugin
 * Plugin Name:       Recranet
 * Plugin URI:        https://docs.recranet.com/
 * Description:       Recranet online boeken op uw website
 * Version:           1.4.5
 * Author:            Recranet
 * Author URI:        https://recranet.com/
 * Text Domain:       recranet
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-recranet-activator.php
 */
function activate_recranet() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-recranet-activator.php';
	Recranet_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-recranet-deactivator.php
 */
function deactivate_recranet() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-recranet-deactivator.php';
	Recranet_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_recranet' );
register_deactivation_hook( __FILE__, 'deactivate_recranet' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-recranet.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_recranet() {

	$plugin = new Recranet();
	$plugin->run();

}
run_recranet();
