<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/gmarokov
 * @since             1.0.0
 * @package           Mvp_Widgets
 *
 * @wordpress-plugin
 * Plugin Name:       MVP Widgets
 * Plugin URI:        https://github.com/gmarokov
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Georgi
 * Author URI:        https://github.com/gmarokov
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mvp-widgets
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mvp-widgets-activator.php
 */
function activate_mvp_widgets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mvp-widgets-activator.php';
	Mvp_Widgets_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mvp-widgets-deactivator.php
 */
function deactivate_mvp_widgets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mvp-widgets-deactivator.php';
	Mvp_Widgets_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mvp_widgets' );
register_deactivation_hook( __FILE__, 'deactivate_mvp_widgets' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mvp-widgets.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mvp_widgets() {

	$plugin = new Mvp_Widgets();
	$plugin->run();

}
run_mvp_widgets();
