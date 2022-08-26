<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('clothing69_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'clothing69_mailchimp_theme_setup9', 9 );
	function clothing69_mailchimp_theme_setup9() {
		if (clothing69_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'clothing69_mailchimp_frontend_scripts', 1100 );
			add_filter( 'clothing69_filter_merge_styles',					'clothing69_mailchimp_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'clothing69_filter_tgmpa_required_plugins',		'clothing69_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'clothing69_exists_mailchimp' ) ) {
	function clothing69_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'clothing69_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('clothing69_filter_tgmpa_required_plugins',	'clothing69_mailchimp_tgmpa_required_plugins');
	function clothing69_mailchimp_tgmpa_required_plugins($list=array()) {
		if (in_array('mailchimp-for-wp', clothing69_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'clothing69'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'clothing69_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'clothing69_mailchimp_frontend_scripts', 1100 );
	function clothing69_mailchimp_frontend_scripts() {
		if (clothing69_exists_mailchimp()) {
			if (clothing69_is_on(clothing69_get_theme_option('debug_mode')) && clothing69_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'clothing69-mailchimp-for-wp',  clothing69_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'clothing69_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'clothing69_filter_merge_styles', 'clothing69_mailchimp_merge_styles');
	function clothing69_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (clothing69_exists_mailchimp()) { require_once CLOTHING69_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp.styles.php'; }
?>