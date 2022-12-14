<?php
/**
 * ThemeREX Addons Custom post type: Post (add options to the standard WP Post)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.24
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// -----------------------------------------------------------------
// -- Post type setup
// -----------------------------------------------------------------

// Add options to the standard WP post
if (!function_exists('trx_addons_cpt_post_init')) {
	add_action( 'init', 'trx_addons_cpt_post_init' );
	function trx_addons_cpt_post_init() {
		
		// Add collection parameters to the Meta Box support
		global $TRX_ADDONS_STORAGE;
		$TRX_ADDONS_STORAGE['post_types'][] = 'post';
		$TRX_ADDONS_STORAGE['meta_box_post'] = array(
			"icon" => array(
				"title" => esc_html__("Item's icon", 'trx_addons'),
				"desc" => wp_kses_data( __('Select icon for the current post (used in some shortcodes)', 'trx_addons') ),
				"std" => '',
				"options" => array(),
				"style" => "icons",
				"type" => "icons"
			)
		);
	}
}
?>