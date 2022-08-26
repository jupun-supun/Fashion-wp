<?php
/* TRX Updater support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('clothing69_trx_updater_theme_setup9')) {
	add_action( 'after_setup_theme', 'clothing69_trx_updater_theme_setup9', 9 );
	function clothing69_trx_updater_theme_setup9() {

		if (is_admin()) {
			add_filter( 'clothing69_filter_tgmpa_required_plugins',			'clothing69_trx_updater_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'clothing69_trx_updater_tgmpa_required_plugins' ) ) {
	function clothing69_trx_updater_tgmpa_required_plugins($list=array()) {
		if (in_array('trx_updater', clothing69_storage_get('required_plugins'))) {
			$path = clothing69_get_file_dir('plugins/trx_updater/trx_updater.zip');
			$list[] = array(
				'name' 		=> esc_html__('Themerex Updater', 'clothing69'),
				'slug' 		=> 'trx_updater',
				'version'	=> '1.9.9',
				'source'	=> !empty($path) ? $path : 'upload://trx_updater.zip',
				'required' 	=> false
			);
		}
		return $list;
	}
}


// Check if this plugin installed and activated
if ( !function_exists( 'clothing69_exists_trx_updater' ) ) {
	function clothing69_exists_trx_updater() {
		return function_exists( 'trx_updater_load_plugin_textdomain' );
	}
}
