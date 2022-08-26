<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.10
 */

$clothing69_footer_scheme =  clothing69_is_inherit(clothing69_get_theme_option('footer_scheme')) ? clothing69_get_theme_option('color_scheme') : clothing69_get_theme_option('footer_scheme');
$clothing69_footer_id = str_replace('footer-custom-', '', clothing69_get_theme_option("footer_style"));
if ((int) $clothing69_footer_id == 0) {
	$clothing69_footer_id = clothing69_get_post_id(array(
			'name' => $clothing69_footer_id,
			'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
		)
	);
} else {
	$clothing69_footer_id = apply_filters('trx_addons_filter_get_translated_layout', $clothing69_footer_id);
}

$clothing69_footer_meta = get_post_meta($clothing69_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($clothing69_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($clothing69_footer_id))); 
						if (!empty($clothing69_footer_meta['margin']) != '') 
							echo ' '.esc_attr(clothing69_add_inline_css_class('margin-top: '.esc_attr(clothing69_prepare_css_value($clothing69_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($clothing69_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('clothing69_action_show_layout', $clothing69_footer_id);
	?>
</footer><!-- /.footer_wrap -->
