<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.06
 */

$clothing69_header_css = $clothing69_header_image = '';
$clothing69_header_video = clothing69_get_header_video();
if (true || empty($clothing69_header_video)) {
	$clothing69_header_image = get_header_image();
	if (clothing69_is_on(clothing69_get_theme_option('header_image_override')) && apply_filters('clothing69_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($clothing69_cat_img = clothing69_get_category_image()) != '')
				$clothing69_header_image = $clothing69_cat_img;
		} else if (is_singular() || clothing69_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$clothing69_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($clothing69_header_image)) $clothing69_header_image = $clothing69_header_image[0];
			} else
				$clothing69_header_image = '';
		}
	}
}

$clothing69_header_id = str_replace('header-custom-', '', clothing69_get_theme_option("header_style"));
if ((int) $clothing69_header_id == 0) {
	$clothing69_header_id = clothing69_get_post_id(array(
			'name' => $clothing69_header_id,
			'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
		)
	);
} else {
	$clothing69_header_id = apply_filters('trx_addons_filter_get_translated_layout', $clothing69_header_id);
}

$clothing69_header_meta = get_post_meta($clothing69_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($clothing69_header_id); 
						?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($clothing69_header_id)));
						echo !empty($clothing69_header_image) || !empty($clothing69_header_video) 
							? ' with_bg_image' 
							: ' without_bg_image';
						if ($clothing69_header_video!='') 
							echo ' with_bg_video';
						if ($clothing69_header_image!='') 
							echo ' '.esc_attr(clothing69_add_inline_css_class('background-image: url('.esc_url($clothing69_header_image).');'));
						if (!empty($clothing69_header_meta['margin']) != '') 
							echo ' '.esc_attr(clothing69_add_inline_css_class('margin-bottom: '.esc_attr(clothing69_prepare_css_value($clothing69_header_meta['margin'])).';'));
						if (is_single() && has_post_thumbnail()) 
							echo ' with_featured_image';
						if (clothing69_is_on(clothing69_get_theme_option('header_fullheight'))) 
							echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(clothing69_is_inherit(clothing69_get_theme_option('header_scheme')) 
														? clothing69_get_theme_option('color_scheme') 
														: clothing69_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($clothing69_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('clothing69_action_show_layout', $clothing69_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>