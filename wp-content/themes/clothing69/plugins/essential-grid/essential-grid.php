<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('clothing69_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'clothing69_essential_grid_theme_setup9', 9 );
	function clothing69_essential_grid_theme_setup9() {
		if (clothing69_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'clothing69_essential_grid_frontend_scripts', 1100 );
			add_filter( 'clothing69_filter_merge_styles',					'clothing69_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'clothing69_filter_tgmpa_required_plugins',		'clothing69_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'clothing69_exists_essential_grid' ) ) {
	function clothing69_exists_essential_grid() {
        return defined('EG_PLUGIN_PATH') || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'clothing69_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('clothing69_filter_tgmpa_required_plugins',	'clothing69_essential_grid_tgmpa_required_plugins');
	function clothing69_essential_grid_tgmpa_required_plugins($list=array()) {
		if (in_array('essential-grid', clothing69_storage_get('required_plugins'))) {
			$path = clothing69_get_file_dir('plugins/essential-grid/essential-grid.zip');
			$list[] = array(
						'name' 		=> esc_html__('Essential Grid', 'clothing69'),
						'slug' 		=> 'essential-grid',
						'version'	=> '3.0.16',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'clothing69_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'clothing69_essential_grid_frontend_scripts', 1100 );
	function clothing69_essential_grid_frontend_scripts() {
		if (clothing69_is_on(clothing69_get_theme_option('debug_mode')) && clothing69_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'clothing69-essential-grid',  clothing69_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'clothing69_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('clothing69_filter_merge_styles', 'clothing69_essential_grid_merge_styles');
	function clothing69_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>