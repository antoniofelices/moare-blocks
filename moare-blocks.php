<?php
/**
 * Plugin Name:       Moare Blocks
 * Description:       Custom Blocks like load custom fields.
 * Version:           0.0.1
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            antonio
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       moare-blocks
 *
 * @package Moare
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function moare_blocks_block_init() {
	register_block_type( __DIR__ . '/build/publications' );
}
add_action( 'init', 'moare_blocks_block_init' );
