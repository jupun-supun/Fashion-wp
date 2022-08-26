<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('clothing69_yith_wcwl_wishlist_theme_setup9')) {
	add_action( 'after_setup_theme', 'clothing69_yith_wcwl_wishlist_theme_setup9', 9 );
	function clothing69_yith_wcwl_wishlist_theme_setup9() {

		if (is_admin()) {
			add_filter( 'clothing69_filter_tgmpa_required_plugins',			'clothing69_yith_wcwl_wishlist_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'clothing69_yith_wcwl_wishlist_tgmpa_required_plugins' ) ) {
	
	function clothing69_yith_wcwl_wishlist_tgmpa_required_plugins($list=array()) {
		if (in_array('yith-woocommerce-wishlist', clothing69_storage_get('required_plugins'))) {
			// YITH WooCommerce Wishlist
			$list[] = array(
				'name' 		=> esc_html__('YITH WooCommerce Wishlist', 'clothing69'),
				'slug' 		=> 'yith-woocommerce-wishlist',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if YITH WooCommerce Wishlist installed and activated
if ( !function_exists( 'clothing69_exists_yith_wcwl_wishlist' ) ) {
	function clothing69_exists_yith_wcwl_wishlist() {
		return class_exists('YITH_WCWL');
	}
}

// Set plugin's specific importer options
if ( !function_exists( 'clothing69_yith_wcwl_wishlist_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options',    'clothing69_yith_wcwl_wishlist_importer_set_options' );
    function clothing69_yith_wcwl_wishlist_importer_set_options($options=array()) {   
        if ( clothing69_exists_yith_wcwl_wishlist() && in_array('yith-woocommerce-wishlist', clothing69_storage_get('required_plugins')) ) {
            $options['additional_options'][]    = 'yith_wcwl_%';                    // Add slugs to export options for this plugin
        }
        return $options;
    }
}
?>