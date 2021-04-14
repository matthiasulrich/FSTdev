<?php
/**
 * Plugin Name: ulrich.digital - Block Expander
 * Plugin URI: https://github.com/ahmadawais/create-guten-block/
 * Description: ulrich.digital - Block Expander is a Gutenberg plugin created via create-guten-block.
 * Author: matthiasulrich, mrahmadawais, maedahbatool
 * Author URI: https://ulrich.digital
 * Version: 1.0.0
 * License: MIT
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
