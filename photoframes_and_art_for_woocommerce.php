<?php

/**
 *
 * @link              https://www.narolainfotech.com
 * @since             1.0.0
 * @package           Photoframes_and_art_for_woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Photoframes and art for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/search/narolainfotech/
 * Description:       Photoframes and art for WooCommerce is more than just a plugin; it lets your customers upload their own original works of art and frame them using a variety of framing choices. Customers will be able to see how their frame will look on a wall (a picture of the location where they plan to hang the frame) and purchase it in just a few easy steps if they are provided with the option to upload their own layout.
 * Version:           1.0.0
 * Author:            Narola Infotech
 * Author URI:        https://www.narolainfotech.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       photoframes-and-art-for-woocommerce
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
define( 'PHOTOFRAMES_AND_ART_FOR_WOOCOMMERCE_VERSION', '1.0.0' );
define( 'PHOTOART_PLUGIN_NAME', 'Framed Art for WooCommerce' );
define( 'PHOTOART_TBL_PREFIX', 'photoart_' );
define( 'PHOTOART_BASE_IMAGE', plugin_dir_url( __FILE__ ) . 'public/img/baseimage.jpg' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-photoframes_and_art_for_woocommerce-activator.php
 */
function photoframes_and_art_for_woocommerce_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-photoframes_and_art_for_woocommerce-activator.php';
	Photoframes_and_art_for_woocommerce_Activator::activate();
	
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-photoframes_and_art_for_woocommerce-deactivator.php
 */
function photoframes_and_art_for_woocommerce_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-photoframes_and_art_for_woocommerce-deactivator.php';
	Photoframes_and_art_for_woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'photoframes_and_art_for_woocommerce_activate' );
register_deactivation_hook( __FILE__, 'photoframes_and_art_for_woocommerce_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-photoframes_and_art_for_woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function photoframes_and_art_for_woocommerce_run() {

	$plugin = new Photoframes_and_art_for_woocommerce();
	$plugin->run();

}
photoframes_and_art_for_woocommerce_run();


$plugin = plugin_basename(__FILE__);

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	add_filter("plugin_action_links_$plugin", 'photoart_settings_link' );	
} else {
	add_action( 'admin_notices', 'photoart_admin_notice_error' );
}

function photoart_admin_notice_error() {
 	?>
 	<div class="notice notice-error"><p><?php esc_html_e('To use features of "Photoframes and art for WooCommerce" plugin please check, WooCommerce plugin must be installed and activated in this site.','photoframes-and-art-for-woocommerce'); ?></p></div>
 	<?php  
}

function photoart_settings_link($links) { 
  	$settings_link = '<a href="admin.php?page=photoandart-settings">Settings</a>'; 
  	array_unshift($links, $settings_link);
  	return $links; 
}