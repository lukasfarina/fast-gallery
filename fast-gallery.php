<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.lucasfarina.com.br
 * @since             1.0.0
 * @package           Fast_Gallery
 *
 * @wordpress-plugin
 * Plugin Name:       Fast Gallery
 * Plugin URI:        https://github.com/lukasfarina/fast-gallery
 * Description:       Galeria de fácil instação e integração com wordpress.
 * Version:           1.0.0
 * Author:            Lucas Farina
 * Author URI:        http://www.lucasfarina.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fast-gallery
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-fast-gallery-activator.php
 */
function activate_fast_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fast-gallery-activator.php';
	Fast_Gallery_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-fast-gallery-deactivator.php
 */
function deactivate_fast_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fast-gallery-deactivator.php';
	Fast_Gallery_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fast_gallery' );
register_deactivation_hook( __FILE__, 'deactivate_fast_gallery' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-fast-gallery.php';

/**
 * Helpers
 *
 * Get Gallery Images
 *
 * @since	1.0.0
 * @throws	Exception	Se o objeto post não for encontrado.
 * @return	array
 */
function get_gallery() {
    global $post;

    if(!isset($post)) throw new Exception('Objeto post não encontrado.');

    $gallery = unserialize( get_post_meta($post->ID, 'gallery', true ) );
    $gallery = !empty($gallery) ? $gallery : array();

    return $gallery;
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
function run_fast_gallery() {
	$plugin = new Fast_Gallery();
	$plugin->run();
}
run_fast_gallery();
