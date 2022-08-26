<?php
/* TRX Socials support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('clothing69_trx_socials_theme_setup9')) {
    add_action( 'after_setup_theme', 'clothing69_trx_socials_theme_setup9', 9 );
    function clothing69_trx_socials_theme_setup9() {

        if (is_admin()) {
            add_filter( 'clothing69_filter_tgmpa_required_plugins',			'clothing69_trx_socials_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'clothing69_trx_socials_tgmpa_required_plugins' ) ) {
    function clothing69_trx_socials_tgmpa_required_plugins($list=array()) {
        if (in_array('trx_socials', clothing69_storage_get('required_plugins'))) {
            $path = clothing69_get_file_dir('plugins/trx_socials/trx_socials.zip');
            $list[] = array(
                'name' 		=> esc_html__('Themerex Socials', 'clothing69'),
                'slug' 		=> 'trx_socials',
                'version'	=> '1.4.4',
                'source'	=> !empty($path) ? $path : 'upload://trx_socials.zip',
                'required' 	=> false
            );
        }
        return $list;
    }
}


// Check if this plugin installed and activated
if ( !function_exists( 'clothing69_exists_trx_socials' ) ) {
    function clothing69_exists_trx_socials() {
        return function_exists( 'trx_socials_load_plugin_textdomain' );
    }
}
