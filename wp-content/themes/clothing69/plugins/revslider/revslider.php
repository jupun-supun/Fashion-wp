<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('clothing69_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'clothing69_revslider_theme_setup9', 9 );
	function clothing69_revslider_theme_setup9() {
		if (is_admin()) {
			add_filter( 'clothing69_filter_tgmpa_required_plugins',	'clothing69_revslider_tgmpa_required_plugins' );
		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'clothing69_exists_revslider' ) ) {
	function clothing69_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'clothing69_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('clothing69_filter_tgmpa_required_plugins',	'clothing69_revslider_tgmpa_required_plugins');
	function clothing69_revslider_tgmpa_required_plugins($list=array()) {
		if (in_array('revslider', clothing69_storage_get('required_plugins'))) {
			$path = clothing69_get_file_dir('plugins/revslider/revslider.zip');
			$list[] = array(
					'name' 		=> esc_html__('Revolution Slider', 'clothing69'),
					'slug' 		=> 'revslider',
					'version'	=> '6.5.25',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}
?>