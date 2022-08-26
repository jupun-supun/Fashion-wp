<?php
/* Elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'clothing69_elegro_payment_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'clothing69_elegro_payment_theme_setup9', 9 );
	function clothing69_elegro_payment_theme_setup9() {
		if (clothing69_exists_elegro_payment()) {
			add_filter( 'clothing69_filter_merge_styles',					'clothing69_elegro_payment_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'clothing69_filter_tgmpa_required_plugins', 'clothing69_elegro_payment_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'clothing69_elegro_payment_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('clothing69_filter_tgmpa_required_plugins',	'clothing69_elegro_payment_tgmpa_required_plugins');
	function clothing69_elegro_payment_tgmpa_required_plugins($list=array()) {
		if (in_array('elegro-payment', clothing69_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('elegro Crypto Payment', 'clothing69'),
				'slug' 		=> 'elegro-payment',
				'required' 	=> false
			);
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'clothing69_exists_elegro_payment' ) ) {
	function clothing69_exists_elegro_payment() {
		return class_exists( 'WC_Elegro_Payment' );
	}
}

// Merge custom styles
if ( !function_exists( 'clothing69_elegro_payment_merge_styles' ) ) {
	//Handler of the add_filter('clothing69_filter_merge_styles', 'clothing69_elegro_payment_merge_styles');
	function clothing69_elegro_payment_merge_styles($list) {
		$list[] = 'plugins/elegro-payment/elegro-payment.css';
		return $list;
	}
}

?>