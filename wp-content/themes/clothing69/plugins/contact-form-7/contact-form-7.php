<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('clothing69_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'clothing69_cf7_theme_setup9', 9 );
	function clothing69_cf7_theme_setup9() {

		if (is_admin()) {
			add_filter( 'clothing69_filter_tgmpa_required_plugins',			'clothing69_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'clothing69_cf7_tgmpa_required_plugins' ) ) {
	
	function clothing69_cf7_tgmpa_required_plugins($list=array()) {
		if (in_array('contact-form-7', clothing69_storage_get('required_plugins'))) {
			// CF7 plugin
			$list[] = array(
				'name' 		=> esc_html__('Contact form 7', 'clothing69'),
				'slug' 		=> 'contact-form-7',
				'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'clothing69_exists_cf7' ) ) {
	function clothing69_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Merge custom styles
if ( !function_exists( 'clothing69_cf7_merge_styles' ) ) {
	
	function clothing69_cf7_merge_styles($list) {
		if (clothing69_exists_cf7()) {
			$list[] = 'plugins/contact-form-7/_contact-form-7.scss';
		}
		return $list;
	}
}
?>